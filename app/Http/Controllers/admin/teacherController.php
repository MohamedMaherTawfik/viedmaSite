<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminRequest;
use App\Interfaces\CourseInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Models\assignment_submission;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\school;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;

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
        $courses = Courses::with('lessons')->where('user_id', auth()->user()->id)->get();
        return view('teacherDashboard.index', compact('courses'));
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
        return redirect()->back();
    }

    public function myCourses()
    {
        $enrollments = Enrollments::where('user_id', auth()->id())->where('enrolled', 'yes')->get();
        return view('teacherDashboard.courses.EnrolledCourses', compact('enrollments'));

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
        $certificates = certificate::where('user_id', auth()->id())->get();
        return view('teacherDashboard.certificates.index', compact('certificates'));
    }

    public function allProjects()
    {
        $assignments = assignment_submission::where('user_id', auth()->id())->with('notes')->get();
        return view('teacherDashboard.projects.index', compact('assignments'));
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

    public function allStudents()
    {
        $students = student::get();
        return view('teacherDashboard.student.index', compact('students'));
    }

    public function createStudent()
    {
        return view('teacherDashboard.student.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeStudent(adminRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $user = student::create($validatedData);
        return redirect()->route('teacher.students')->with('success', 'Student created successfully.');
    }

    public function ExcelStudent()
    {
        return view('teacherDashboard.student.excel');
    }
    /**
     * Upload Excel file and process it.
     */

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);
        $school = School::where('id', Auth::user()->school->id)->firstOrFail();

        // احفظ الملف يدويًا
        $file = $request->file('excel_file');
        $savePath = storage_path('app/temp/students.xlsx');
        $file->move(storage_path('app/temp'), 'students.xlsx');

        $realPath = realpath($savePath); // Get absolute path

        if (!file_exists($realPath)) {
            return back()->withErrors(['msg' => 'الملف لم يتم حفظه بشكل صحيح.']);
        }

        SimpleExcelReader::create($realPath)
            ->getRows()
            ->each(function (array $row) use ($school) {
                Student::create([
                    'name' => $row['name'],
                    'school_id' => $school->id,
                    'national_id' => $row['national_id'],
                    'nationallity' => $row['nationallity'],
                    'Academic_stage' => $row['Academic_stage'],
                    'slug' => Str::slug($row['name']) . '-' . time(),
                ]);
            });

        // unlink($realPath);

        return redirect()->route('teacher.students')->with('success', 'Excel file uploaded and students created successfully.');
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
}
