<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\certificateRequest;
use App\Http\Requests\courseRequest;
use App\Http\Requests\lessonRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\noteRequest;
use App\Http\Requests\projectRequest;
use App\Http\Requests\reportRequest;
use App\Http\Requests\userRequest;
use App\Models\applyTeacher;
use App\Models\assignment_submission;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\graduationNotes;
use App\Models\graduationProject;
use App\Models\lesson;
use App\Models\report;
use App\Models\sessionTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class trainerController extends Controller
{
    public function signUpTrainer()
    {
        return view('trainerDashboard.auth.register');
    }
    public function registerTrainer(userRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'trainer';
        $user = User::create([
            'school_id' => $validatedData['school_id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'phone' => $validatedData['phone'],
            'role' => $validatedData['role'],
        ]);
        $apply = applyTeacher::create([
            'user_id' => $user->id,
            'cv' => $request->file('cv')->store('cv', 'public'),
            'certificate' => $request->file('certificate') ? $request->file('certificate')->store('certificates', 'public') : null,
            'phone' => $validatedData['phone'],
            'topic' => null,
            'status' => 'pending'
        ]);

        Auth::login($user);


        return view('trainerDashboard.auth.trainerApplied')->with('success', 'Registration successful! Please apply to become a teacher.');
    }

    public function loginTrainer()
    {
        return view('trainerDashboard.auth.login');
    }

    public function signinTrainer(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'trainer' && Auth::user()->applyTeacher->status == 'accepted') {
                request()->session()->regenerate();
                return redirect()->route('trainerDashboard');
            }
            request()->session()->regenerate();
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function trainerDashboard()
    {
        $courses = Courses::where('user_id', auth()->id())->get();
        $ids = $courses->pluck('id');
        $enrollments = Enrollments::whereIn('courses_id', $ids)->get();
        $graduationProject = graduationProject::where('teacher_id', auth()->id())->pluck('id');
        $assignments = assignment_submission::whereIn('graduation_project_id', $graduationProject)->get();
        $latestSessionTime = sessionTime::orderBy('id', 'desc')->first();
        return view('trainerDashboard.index', compact('courses', 'enrollments', 'assignments', 'latestSessionTime'));
    }

    public function trainerCourses()
    {
        $courses = Courses::where('user_id', Auth::user()->id)->get();
        return view('trainerDashboard.courses.index', compact('courses'));
    }

    // create - عرض نموذج إنشاء دورة جديدة
    public function createCourse()
    {
        return view('trainerDashboard.courses.create');
    }

    // store - حفظ الدورة الجديدة
    public function storeCourse(courseRequest $request)
    {
        // dd(request()->all());
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['slug'] = Str::slug($validatedData['title']) . '-' . time();
        $request->file('cover_photo')->store('public/coursesImages');
        Courses::create($validatedData);
        return redirect()->route('trainer.courses')->with('success', 'تم إضافة الدورة بنجاح');
    }

    // show - عرض تفاصيل دورة
    public function showCourse($slug)
    {
        $course = Courses::where('slug', $slug)->where('user_id', Auth::id())->firstOrFail();
        $ids = graduationProject::where('id', $course->id)->pluck('id');
        $uploads = assignment_submission::whereIn('graduation_project_id', $ids)->get();
        return view('trainerDashboard.courses.show', compact('course', 'uploads'));
    }

    public function trainerProjects()
    {
        $graduationProject = graduationProject::where('teacher_id', Auth::user()->id)->pluck('id');
        $assignments = assignment_submission::whereIn('graduation_project_id', $graduationProject)->get();
        return view('trainerDashboard.projects.index', compact('assignments'));
    }

    public function createProject(Courses $course)
    {
        return view('trainerDashboard.projects.create', compact('course'));
    }

    public function storeProject(projectRequest $request, Courses $course)
    {
        $validated = $request->validated();
        $validated['teacher_id'] = Auth::id();
        $validated['courses_id'] = $course->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('Projects', 'public');
        }
        graduationProject::create($validated);
        return redirect()->back()->with('Project Uploaded Successfully');
    }

    public function deleteProject(graduationProject $graduationProject)
    {
        $graduationProject->delete();
        return redirect()->back()->with('graduation project deleted');
    }
    public function trainerEvaluations()
    {
        $reports = graduationNotes::where('user_id', Auth::user()->id)->get();
        return view('trainerDashboard.evaluations.index', compact('reports'));
    }

    public function storeEvaluation(noteRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'accepted';
        graduationNotes::create($validated);
        return redirect()->back();
    }

    public function trainerSchedules()
    {
        $sessionTimes = sessionTime::where('user_id', Auth::user()->id)->get();
        return view('trainerDashboard.schedules.index', compact('sessionTimes'));
    }

    public function createSessionTime()
    {
        $courses = Courses::where('user_id', Auth::user()->id)->get();
        return view('trainerDashboard.schedules.create', compact('courses'));
    }

    public function storeSessionTime(Request $request, )
    {
        $validated = $request->validate([
            'courses_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
        $validated['user_id'] = Auth::user()->id;

        SessionTime::create($validated);

        return redirect()->route('trainer.schedules', )->with('success', 'تم إضافة الموعد بنجاح');
    }
    public function editSessionTime(SessionTime $sessionTime)
    {
        return view('trainerDashboard.schedules.edit', compact('sessionTime'));
    }

    public function updateSessionTime(Request $request, SessionTime $sessionTime)
    {
        $validated = $request->validate([
            'date' => 'nullable',
            'time' => 'nullable'
        ]);

        $sessionTime->update($validated);

        return redirect()->route('trainer.schedules')->with('success', 'تم تعديل الموعد بنجاح');
    }

    public function createLesson(Courses $course)
    {
        return view('trainerDashboard.lesson.create', compact('course'));
    }

    public function storeLesson(lessonRequest $request, Courses $course)
    {
        $validated = $request->validated();
        $validated['courses_id'] = $course->id;
        $validated['user_id'] = Auth::user()->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('Lessons', 'public');
        }

        lesson::create($validated);
        return redirect()->route('trainer.courses.show', $course->slug)->with('Lesson Created Successfully');
    }

    public function deleteSessionTime(SessionTime $sessionTime)
    {
        $sessionTime->delete();
        return redirect()->route('trainer.schedules')->with('success', 'تم حذف الموعد بنجاح');
    }
    public function trainerCertificates()
    {
        $courses = Auth::user()->course->pluck('id');
        $enrollments = Enrollments::whereIn('courses_id', $courses)->get();
        $certificates = certificate::where('user_id', Auth::user()->id)->get();
        return view('trainerDashboard.certificate.index', compact('certificates', 'enrollments'));
    }

    public function storeCertificate(certificateRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['certificate']) . '-' . time();
        $validated['description'] = 'no description';
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('certificates', 'public');
        }
        certificate::create($validated);
        return redirect()->back();

    }

    public function createReport($slug, User $user)
    {
        return view('trainerDashboard.reports.create', compact('user'));
    }

    public function storeReport(reportRequest $request)
    {
        $validated = $request->validated();
        report::create([
            'user_id' => Auth::user()->id,
            'report' => $validated['report'],
            'student_id' => $validated['user_id'],
        ]);

        return redirect()->back();
    }
}