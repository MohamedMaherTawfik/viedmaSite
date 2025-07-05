<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherAcceptedMail;
use App\Models\applyTeacher;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Http\Requests\adminRequest;
use App\Models\User;
use App\Http\Requests\updateRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Display the list of users.
     */
    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(adminRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function editUser()
    {
        // dd(request('id'));
        $user = User::findOrFail(request('id'));
        // dd($user);
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
        User::findOrFail(request('id'))->delete();
        return redirect()->back();
    }
    /**
     * Show the admin profile.
     */
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
    public function acceptApply()
    {
        $apply = applyTeacher::findOrFail(request('id'));
        $apply->status = 'accepted';
        $apply->save();

        $user = User::find($apply->user_id);
        $user->update(['role' => 'teacher']);

        // Send mail
        Mail::to($user->email)->send(new TeacherAcceptedMail($user));

        return redirect()->back()->with('success', 'Apply accepted and email sent successfully.');
    }

    /**
     * Reject the apply.
     */
    public function rejectApply()
    {
        $apply = applyTeacher::findOrFail(request('id'));
        $apply->status = 'rejected';
        $apply->save();
        return redirect()->back()->with('success', 'Apply rejected successfully.');
    }

    /**
     * Show the accepted applies.
     */
    public function accepted()
    {
        $applies = applyTeacher::with('user')->where('status', 'accepted')->get()->all();
        foreach ($applies as $apply) {
            $apply->user = User::find($apply->user_id);
        }
        return view('admin.applies.accepted', compact('applies'));
    }
    /**
     * Show the rejected applies.
     */
    public function rejected()
    {
        $applies = applyTeacher::with('user')->where('status', 'rejected')->get()->all();
        foreach ($applies as $apply) {
            $apply->user = User::find($apply->user_id);
        }
        return view('admin.applies.rejected', compact('applies'));
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
}