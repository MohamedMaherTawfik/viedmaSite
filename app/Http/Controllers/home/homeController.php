<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use App\Interfaces\CourseInterface;
use App\Interfaces\EnrollmentInterface;
use App\Interfaces\GamesCategoriesInterface;
use App\Interfaces\GamesInterface;
use App\Interfaces\GraduationProjectInterface;
use App\Interfaces\LessonInterface;
use App\Interfaces\ReviewsInterface;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\quizes;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class homeController extends Controller
{
    private $coursesRepository;
    private $categoreyrepository;
    private $enrollmentRepository;
    private $lessonRepository;
    private $reviewRepository;
    private $projectRepository;
    private $gameCategoreyRepository;
    private $gameRepository;
    public function __construct(
        CourseInterface $coursesRepository,
        CategoryInterface $categoreyInterface,
        EnrollmentInterface $enrollmentInterface,
        LessonInterface $lessonInterface,
        ReviewsInterface $reviewsInterface,
        GraduationProjectInterface $graduationProject,
        GamesCategoriesInterface $gameCategoreyInterface,
        GamesInterface $gamesInterface,
    ) {

        $this->coursesRepository = $coursesRepository;
        $this->categoreyrepository = $categoreyInterface;
        $this->enrollmentRepository = $enrollmentInterface;
        $this->lessonRepository = $lessonInterface;
        $this->reviewRepository = $reviewsInterface;
        $this->projectRepository = $graduationProject;
        $this->gameCategoreyRepository = $gameCategoreyInterface;
        $this->gameRepository = $gamesInterface;
    }
    public function index()
    {
        $courses = $this->coursesRepository->allCourses();
        $categories = $this->categoreyrepository->getAllCategories();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('welcome', compact('courses', 'categories'));
    }

    public function showCourse()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $enrollmentUserIds = Enrollments::where('enrolled', 'yes')->where('courses_id', $course->id)->pluck('user_id');
        if ($enrollmentUserIds->contains(Auth::user()->id)) {
            return redirect()->route('myCourses');
        }
        $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
            ? asset('storage/' . $course->cover_photo)
            : asset('images/coursePlace.png');
        return view('home.courses.show', compact('course'));
    }

    public function showCategorey()
    {
        $category = $this->categoreyrepository->getCategoryBySlug(request('slug'));
        foreach ($category->courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('home.categorey.show', compact('category'));
    }

    public function profile()
    {
        $user = Auth::user()->load('applyTeacher', 'course');

        return view('home.profile', compact('user'));
    }

    public function enrollment()
    {

        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $this->enrollmentRepository->store($course->id, $course->price);
        return redirect('/');
    }

    public function enrolledCourses()
    {
        $courseIds = Enrollments::where('user_id', Auth::user()->id)->where('enrolled', 'yes')
            ->pluck('courses_id');
        $courses = Courses::whereIn('id', $courseIds)->get();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('home.myCourses', compact('courses'));
    }

    public function enrolledCourse()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $relatedCourses = Courses::where('categorey_id', $course->categorey_id)->take(3)->get();
        $projects = $this->projectRepository->getGraduationProjects($course->slug);
        $quizzes = quizes::where('courses_id', $course->id)->get();
        $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
            ? asset('storage/' . $course->cover_photo)
            : asset('images/coursePlace.png');

        foreach ($relatedCourses as $item) {
            $item->cover_photo_url = $item->cover_photo && Storage::disk('public')->exists($item->cover_photo)
                ? asset('storage/' . $item->cover_photo)
                : asset('images/coursePlace.png');
        }

        foreach ($course->lessons as $lesson) {
            $lesson->cover_photo_url = $lesson->cover_photo && Storage::disk('public')->exists($lesson->cover_photo)
                ? asset('storage/' . $lesson->image)
                : asset('images/lessonHolder.jpg');
        }
        return view('home.courses.enrolledCourse', compact('course', 'relatedCourses', 'projects', 'quizzes', ));
    }

    public function showLesson()
    {
        $lesson = $this->lessonRepository->getLessonBySlug(request('slug'));
        return view('home.courses.lessons.show', compact('lesson'));
    }

    public function courseReview()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        $this->reviewRepository->makeReview(request('rating'), $course->id);
        return redirect()->route('myCourse', ['slug' => $course->slug]);
    }

    public function allCourses()
    {
        $courses = $this->coursesRepository->allCourses();
        foreach ($courses as $course) {
            $course->cover_photo_url = $course->cover_photo && Storage::disk('public')->exists($course->cover_photo)
                ? asset('storage/' . $course->cover_photo)
                : asset('images/coursePlace.png');
        }
        return view('home.courses.allCourses', compact('courses'));
    }

    public function fromSearch()
    {
        $course = $this->coursesRepository->getCourseBySlug(request('slug'));
        if ($course) {

            return view('home.courses.show', compact('course'));
        }
        return view('home.courses.notFound');
    }

    public function about()
    {
        return view('home.inforamtions.aboutUs');
    }

    public function contact()
    {
        return view('home.inforamtions.contactUs');
    }

    public function start()
    {
        $quiz = quizes::where('slug', request('quiz'))->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug)
                ->with('error', 'You already attempted this quiz.');
        }

        $quiz->load('questions.options');

        return view('home.quiz.start', compact('quiz'));
    }


    public function submitQuiz(Request $request, $slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug)
                ->with('error', 'You already submitted this quiz.');
        }

        $answers = $request->input('answers', []);
        $score = 0;

        foreach ($quiz->questions as $question) {
            $correctOption = $question->options()->where('is_correct', true)->first();
            if (isset($answers[$question->id]) && $answers[$question->id] == $correctOption->id) {
                $score++;
            }
        }

        Result::create([
            'user_id' => auth()->id(),
            'quizes_id' => $quiz->id,
            'score' => $score,
        ]);

        return redirect()->route('student.quiz.result', $quiz->slug)->with('success', 'Quiz submitted successfully!');
    }


    public function exitQuiz($slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();

        $existing = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.quiz.result', $quiz->slug);
        }

        Result::create([
            'user_id' => auth()->id(),
            'quizes_id' => $quiz->id,
            'score' => 0,
        ]);

        return redirect()->route('student.quiz.result', $quiz->slug)
            ->with('error', 'You exited the quiz. Your score is 0.');
    }


    public function quizResult($slug)
    {
        $quiz = quizes::where('slug', $slug)->firstOrFail();
        $result = Result::where('user_id', auth()->id())
            ->where('quizes_id', $quiz->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('student.quiz.show', $quiz->slug)
                ->with('error', 'No result found for this quiz.');
        }

        return view('home.quiz.result', compact('quiz', 'result'));
    }

    public function getGames()
    {
        $categories = $this->gameCategoreyRepository->getAllCategories();
        $games = $this->gameRepository->allGames();
        foreach ($games as $game) {
            $game->cover_photo_url = $game->cover_photo && Storage::disk('public')->exists($game->cover_photo)
                ? asset('storage/' . $game->cover_image)
                : asset('images/placeholdergame.jpg');
        }
        return view('home.games.index', compact('categories', 'games'));
    }

    public function showGame()
    {
        $game = $this->gameRepository->getGameBySlug(request('slug'));
        return view('home.games.show', compact('game'));
    }

    public function showGameCategorey()
    {

    }
}