<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\schoolRequest;
use App\Interfaces\CourseInterface;
use App\Models\applyTeacher;
use App\Models\Courses;
use App\Models\school;
use App\Models\student;
use Illuminate\Http\Request;
use App\Http\Requests\adminRequest;
use App\Models\User;
use App\Http\Requests\updateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;




class SuperAdminController extends Controller
{

    private $courses;
    public function __construct(CourseInterface $courses)
    {
        $this->courses = $courses;
    }

    public function schoolRegister()
    {
        return view('schoolDashboard.auth.register');
    }

    public function registerSchool(schoolRequest $request)
    {
        // dd($request->all());
        $validtedData = $request->validated();
        // dd($validtedData);
        $validtedData['password'] = bcrypt($validtedData['password']);
        $validtedData['role'] = 'admin';
        $school = school::create([
            'name' => $validtedData['school_name'],
            'type' => $validtedData['type'],
            'License_number' => $validtedData['License_number'],
            'address' => $validtedData['address'],
            'city' => $validtedData['city'],
            'slug' => Str::slug($validtedData['school_name']),
        ]);
        $user = User::create([
            'name' => $validtedData['name'],
            'email' => $validtedData['email'],
            'password' => $validtedData['password'],
            'role' => $validtedData['role'],
            'school_id' => $school->id,
        ]);
        Auth::login($user);
        return redirect()->route('school.dashboard', ['slug' => $school->slug])->with('success', 'School registered successfully. Please login.');
    }

    public function schoolLogin()
    {
        return view('schoolDashboard.auth.login');
    }

    public function loginSchool(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('school.dashboard', ['slug' => $user->school->slug]);
            } else {
                return redirect()->route('schoolDashboard.index');
            }
        }
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('school.login')->with('success', 'Logged out successfully.');
    }

    public function schoolDashboard()
    {
        $courses = $this->courses->allCourses();
        $studentsCount = User::where('role', 'user')->count();
        $teachersCount = User::where('role', 'teacher')->count();
        return view('schoolDashboard.index', compact('courses', 'studentsCount', 'teachersCount'));
    }
    /**
     * Display the admin dashboard.
     */
    public function schoolTeachers()
    {
        $teachers = User::where('role', 'teacher')->get();
        $applies = applyTeacher::get();
        return view('schoolDashboard.teachers.index', compact('teachers', 'applies'));
    }

    public function showTeacher()
    {
        $teacher = User::where('name', request('name'))->get()->first();
        return view('schoolDashboard.teachers.show', compact('teacher', ));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        return view('schoolDashboard.teachers.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(adminRequest $request)
    {
        $slug = request('slug');
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
            'school_id' => $validatedData['school_id'],
        ]);
        applyTeacher::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'topic' => $validatedData['topic'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
        ]);
        return redirect()->route('school.teachers', $slug)->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function editUser()
    {
        $user = User::findOrFail(request('id'));
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function updateUser(updateRequest $request)
    {
        $validatedData = $request->validated();
        User::findOrFail(request('id'))->update($validatedData);
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function deleteUser()
    {
        // Logic to delete user
        $user = User::where('name', request('name'))->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->delete();
        return redirect()->back();
    }

    public function schoolStudents()
    {
        $school = school::where('slug', request('slug'))->firstOrFail();
        if (!$school) {
            return redirect()->back()->with('error', 'School not found.');
        }
        // Fetch students associated with the school
        $students = student::where('school_id', $school->id)->get();
        return view('schoolDashboard.students.index', compact('students'));
    }

    public function showStudent()
    {
        $student = student::where('name', request('name'))->get()->first();
        return view('schoolDashboard.students.show', compact('student'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function createStudent()
    {
        return view('schoolDashboard.students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function storeStudent(adminRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $user = student::create($validatedData);
        // dd($user);
        return redirect()->route('school.students', request('slug'))->with('success', 'Student created successfully.');
    }
    /**
     * Show the admin profile.
     */

    public function ExcelStudent()
    {
        return view('schoolDashboard.students.excel');
    }
    /**
     * Upload Excel file and process it.
     */

    public function uploadExcel(Request $request, $slug)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $school = School::where('slug', $slug)->firstOrFail();

        // احفظ الملف يدويًا
        $file = $request->file('excel_file');
        $savePath = storage_path('app/temp/students.xlsx');
        $file->move(storage_path('app/temp'), 'students.xlsx');

        $realPath = realpath($savePath); // Get absolute path

        if (!file_exists($realPath)) {
            return back()->withErrors(['msg' => 'الملف لم يتم حفظه بشكل صحيح.']);
        }

        // اقرأ الملف من المسار الحقيقي
        SimpleExcelReader::create($realPath)
            ->getRows()
            ->each(function (array $row) use ($school) {
                Student::create([
                    'name' => $row['name'],
                    // 'parent_phone' => $row['phone'],
                    'school_id' => $school->id,
                    'national_id' => $row['national_id'],
                    'nationallity' => $row['nationallity'],
                    'Academic_stage' => $row['Academic_stage'],
                    'slug' => Str::slug($row['name']) . '-' . time(),
                ]);
            });

        // unlink($realPath);

        return redirect()->route('school.students', ['slug' => $slug])->with('success', 'Excel file uploaded and students created successfully.');
    }


    public function deleteStudent()
    {
        $student = student::where('name', request('name'))->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
    public function profile()
    {
        return view('admin.profile');
    }
    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request)
    {
        // Logic to update profile
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the Applies.
     */
    public function pending()
    {
        $applies = applyTeacher::with('user')->where('status', 'pending')->get()->all();
        foreach ($applies as $apply) {
            $apply->user = User::find($apply->user_id);
        }
        return view('admin.applies.pending', compact('applies'));
    }

    /**
     * Accept the apply.
     */
    public function accept()
    {
        $user = User::where('name', request('name'))->get();
        $applyTeacher = applyTeacher::where('user_id', $user->first()->id)->firstOrFail();
        $applyTeacher->status = 'accepted';
        $applyTeacher->save();
        // Mail::to($user->first()->email)->send(new TeacherAcceptedMail($user->first()));

        return redirect()->back()->with('success', 'Apply accepted and email sent successfully.');
    }


    /**
     * Reject the apply.
     */
    public function reject()
    {
        $user = User::where('name', request('name'))->get();
        $applyTeacher = applyTeacher::where('user_id', $user->first()->id)->firstOrFail();
        $applyTeacher->status = 'rejected';
        $applyTeacher->save();
        $user->first()->role = 'user';
        $user->first()->save();
        // Optionally, you can send an email to the user notifying them of the rejection
        // Mail::to($user->first()->email)->send(new TeacherRejectedMail($user->first()));
        return redirect()->back()->with('success', 'Apply rejected.');
    }

    /**
     * Show all courses.
     */
    public function allCourses()
    {
        $courses = Courses::get();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('admin.courses.allCourses', compact('courses'));
    }

    /**
     * Delete a course.
     */
    public function deleteCourse()
    {
        Courses::findOrFail(request('id'))->delete();
        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    /**
     * Show the categories.
     */
    public function categories()
    {
        $categories = \App\Models\categories::get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function createCategory()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        \App\Models\categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function editCategory()
    {
        $category = \App\Models\categories::find(request('id'));
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = \App\Models\categories::findOrFail(request('id'));
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function deleteCategory()
    {
        $category = \App\Models\categories::findOrFail(request('id'));
        if ($category->courses()->count() > 0) {
            return redirect()->back()->with('error', 'Category cannot be deleted as it has associated courses.');
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function speakWithAi()
    {
        return view('admin.chat.sepakAi');
    }

    public function send(Request $request)
    {
        $apiKey = env('CHAT_KEY');

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->message]
                    ]
                ]
            ]
        ]);

        $data = $response->json();

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return response()->json([
                'reply' => $data['candidates'][0]['content']['parts'][0]['text']
            ]);
        }

        return response()->json([
            'error' => $data['error']['message'] ?? 'Unexpected error from Gemini'
        ], 500);
    }

    public function schoolPendings()
    {
        $applies = applyTeacher::where('status', 'pending')->get();

        return view('schoolDashboard.pendings.index', compact('applies'));

    }

    public function schoolTraining()
    {
        return view('schoolDashboard.training.index');
    }

    public function linkParent()
    {
        $school = school::where('slug', request('slug'))->firstOrFail();
        $parents = User::where('school_id', $school->id)->where('role', 'parent')->get();
        return view('schoolDashboard.students.linkParent', compact('parents'));
    }

    public function linkParentStore()
    {
        $user = User::where('name', request('parent'))->first();
        $student = student::where('name', request('name'))->first();
        if (!$user || !$student) {
            return redirect()->back()->with('error', 'User or Student not found.');
        }
        $student->user_id = $user->id;
        $student->save();
        return redirect()->back()->with('success', 'Parent linked to student successfully.');
    }
}