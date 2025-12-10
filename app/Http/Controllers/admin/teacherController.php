<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminRequest;
use App\Http\Requests\evaluationRequest;
use App\Http\Requests\uploadProjectRequest;
use App\Interfaces\CourseInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Models\assignment_submission;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\report;
use App\Models\student;
use Illuminate\Support\Facades\Auth;

class teacherController extends Controller
{
    private $courseRepository;
    private $lessonRepository;
    private $graduationProjectRepository;
    /**
     * Create a new interface instance.
     *
     * @param CourseInterface $courseRepository
     * @param LessonInterface $lessonRepository
     */
    public function __construct(CourseInterface $courseRepository, LessonInterface $lessonRepository, GraduationProjectInterface $graduationProjectRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->graduationProjectRepository = $graduationProjectRepository;
    }
    public function dashboard()
    {
        $enrollments = Enrollments::where('user_id', Auth::user()->id)->get();
        $assignments = assignment_submission::where('user_id', Auth::user()->id)->count();
        return view('teacherDashboard.index', compact('enrollments', 'assignments'));
    }

    public function allCourses()
    {
        $courses = Courses::get();
        return view('teacherDashboard.courses.index', compact('courses'));
    }

    public function freeCourse()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        Enrollments::create([
            'user_id' => auth()->id(),
            'courses_id' => $course->id,
            'enrolled' => 'yes',
            'price' => 0
        ]);
        return redirect()->back()->with('success', 'Course enrolled successfully.');
    }

    public function myCourses()
    {
        $enrollments = Enrollments::where('user_id', auth()->id())->where('enrolled', 'yes')->pluck('courses_id');
        $courses = Courses::whereIn('id', $enrollments)->get();
        return view('teacherDashboard.courses.EnrolledCourses', compact('courses'));
    }

    public function myCourse(Courses $course)
    {
        return view('teacherDashboard.courses.EnrolledCourse', compact('course'));
    }

    public function showCourse()
    {
        $course = Courses::where('slug', request('slug'))->first();
        $enrollments = Enrollments::where('courses_id', $course->id)->count();
        $price = $enrollments * $course->price;
        return view('teacherDashboard.courses.showCourse', compact('course', 'enrollments', 'price'));
    }

    public function certificates()
    {
        $certificates = certificate::where('teacher_id', auth()->id())->get();
        return view('teacherDashboard.certificates.index', compact('certificates'));
    }

    public function createLesson()
    {
        $course = $this->courseRepository->getCourseBySlug(request('slug'));
        return view('teacherDashboard.lessons.createLesson', compact('course'));
    }

    public function showLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        $course = $this->courseRepository->getCourse($lesson->courses_id);
        return view('teacherDashboard.lessons.showLesson', compact('lesson', 'course'));
    }


    public function evaluation()
    {
        $students = student::get();
        return view('teacherDashboard.evaluations.index', compact('students'));
    }

    public function storeEvaluation(evaluationRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('reports', 'public');
        }
        report::create($validated);
        return redirect()->back()->with('success', 'Evaluation submitted successfully.');
    }

    public function uploadProject(uploadProjectRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('Projects', 'public');
        }
        $validated['grade'] = 'not assigned yet';
        assignment_submission::create($validated);

        return redirect()->back()->with('success', 'Project uploaded successfully.');
    }
}
