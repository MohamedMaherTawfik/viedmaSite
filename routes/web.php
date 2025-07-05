<?php

use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\home\GoogleAuthController;
use App\Http\Controllers\home\homeController;
use App\Http\Controllers\home\zoomController;
use App\Http\Controllers\admin\QuizController;
use App\Http\Middleware\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SuperAdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Middleware\CheckAdmin;


Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'signUp')->name('register');
    Route::post('/register', 'register')->name('signup');
    Route::get('/teacher', 'teacherRegister')->name('teacher');
    Route::post('/teacher', 'teacher')->name('teacher');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'signin')->name('signin');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/reset-password', 'resetPage')->name('reset.password')->middleware('auth');
    Route::post('/reset-password', 'updatePassword')->name('password.reset')->middleware('auth');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::group([], function () {
    Route::get('/', [homeController::class, 'index'])->name('home');
    Route::get('/profile', [homeController::class, 'profile'])->name('profile')->middleware('auth');
    Route::get('/about', [homeController::class, 'about'])->name('about');
    Route::get('/contact', [homeController::class, 'contact'])->name('contact');
    Route::get('/courses', [homeController::class, 'courses'])->name('courses');
    Route::get('/course/{slug}', [homeController::class, 'showCourse'])->name('course.show')->middleware('auth');
    Route::post('/course/{slug}', [homeController::class, 'enrollment'])->name('enrollment')->middleware('auth');
    Route::get('/categorey/{slug}', [homeController::class, 'showCategorey'])->name('categories.show');
    Route::get('/mycourses', [homeController::class, 'enrolledCourses'])->name('myCourses');
    Route::get('/mycourse/{slug}', [homeController::class, 'enrolledCourse'])->name('myCourse');
    Route::post('/mycourse/{slug}', [homeController::class, 'courseReview'])->name('course.review');
    Route::get('/mycourse/lesson/{slug}', [homeController::class, 'showLesson'])->name('lesson.show');
    Route::get('/allCourses', [homeController::class, 'allCourses'])->name('courses.all');
    Route::get('/student/quizzes/{quiz}/start', [homeController::class, 'start'])
        ->name('student.quiz.show');
    Route::post('/student/quizzes/{quiz}/submit', [homeController::class, 'submitQuiz'])
        ->name('student.quiz.submit')
        ->middleware('auth');
    Route::post('/student/quizzes/{quiz}/exit', [homeController::class, 'exitQuiz'])->name('student.quiz.exit')->middleware('auth');
    Route::get('/student/quizzes/{quiz}/result', [homeController::class, 'quizResult'])->name('student.quiz.result')->middleware('auth');
    Route::get('/games', [homeController::class, 'getGames'])->name('categorey.game');
    Route::get('/game/{slug}', [homeController::class, 'showGame'])->name('game.show');
    Route::get('/gameCategorey/{slug}', [homeController::class, 'showGameCategorey'])->name('game.categorey.show');
});

Route::group([
    'middleware' => ['auth', CheckAdmin::class],
], function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/admin/users', 'users')->name('admin.users');
        Route::get('/admin/teachers', 'teachers')->name('admin.teachers');
        Route::get('/admin/users/show/{id}', 'showUser')->name('admin.users.show');
        Route::get('/admin/users/create', 'createUser')->name('admin.users.create');
        Route::post('/admin/users/create', 'storeUser')->name('admin.users.store');
        Route::get('/admin/users/edit/{id}', 'editUser')->name('admin.users.edit');
        Route::post('/admin/users/edit/{id}', 'updateUser')->name('admin.users.update');
        Route::delete('/admin/users/delete/{id}', 'deleteUser')->name('admin.users.delete');
        Route::get('/admin/applies/pending', 'pending')->name('admin.applies');
        Route::get('/admin/applies/accepted', 'accepted')->name('admin.accepts');
        Route::get('/admin/applies/rejected', 'rejected')->name('admin.rejects');
        Route::get('/admin/applies/accept/{id}', 'acceptApply')->name('admin.applies.accept');
        Route::get('/admin/applies/reject/{id}', 'rejectApply')->name('admin.applies.reject');
        Route::get('/admin/courses/all', 'allCourses')->name('admin.courses.all');
        Route::delete('/admin/courses/delete', 'deleteCourse')->name('admin.courses.delete');
        Route::get('/admin/categories', 'categories')->name('admin.categories');
        Route::get('/admin/categories/create', 'createCategory')->name('admin.categories.create');
        Route::post('/admin/categories/create', 'storeCategory')->name('admin.categories.store');
        Route::get('/admin/categories/edit/{id}', 'editCategory')->name('admin.categories.edit');
        Route::post('/admin/categories/edit/{id}', 'updateCategory')->name('admin.categories.update');
        Route::delete('/admin/categories/delete/{id}', 'deleteCategory')->name('admin.categories.delete');
        Route::get('/admin/chat', 'speakWithAi')->name('admin.chat');
        Route::post('/chat/send', 'send')->name('admin.ai')->middleware('auth');
    });
});

Route::prefix('dashboard')->middleware(['auth', Teacher::class])->group(function () {
    Route::prefix('quizzes')->group(function () {
        Route::get('/{course}/all', [QuizController::class, 'index'])->name('teacherDashboard.quizzes.index');
        Route::get('/{course}/create', [QuizController::class, 'create'])->name('teacherDashboard.quizzes.create');
        Route::post('/{course}/', [QuizController::class, 'store'])->name('teacherDashboard.quizzes.store');
        Route::get('/{course}/{quiz}', [QuizController::class, 'show'])->name('teacherDashboard.quizzes.show');
        Route::get('/{course}/{quiz}/edit', [QuizController::class, 'edit'])->name('teacherDashboard.quizzes.edit');
        Route::put('/{course}/{quiz}', [QuizController::class, 'update'])->name('teacherDashboard.quizzes.update');
        Route::delete('/{course}/{quiz}', [QuizController::class, 'destroy'])->name('teacherDashboard.quizzes.destroy');
    });

    Route::prefix('')->group(function () {
        Route::get('/{course}/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/{course}/quizzes/{quiz}/questions/create', [QuestionController::class, 'store'])->name('questions.store');
        Route::delete('/{course}/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    });

});

Route::group([
    'middleware' => ['auth', Teacher::class],
], function () {
    Route::controller(teacherController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/dashboard/courses/create', 'createCourse')->name('teacher.courses.create');
        Route::post('/dashboard/courses/create', 'storeCourse')->name('teacher.courses.store');
        Route::get('/dashboard/courses/edit/{slug}', 'editCourse')->name('teacher.courses.edit');
        Route::post('/dashboard/courses/edit/{slug}', 'updateCourse')->name('teacher.courses.update');
        Route::delete('/dashboard/courses/delete/{id}', 'deleteCourse')->name('teacher.courses.delete');
        Route::get('/dashboard/courses/{slug}', 'showCourse')->name('teacher.courses.show');
        Route::get('/dashboard/courses/lessons/create/{slug}', 'createLesson')->name('teacher.lessons.create');
        Route::post('/dashboard/courses/lessons/create/{slug}', 'storeLesson')->name('teacher.lessons.store');
        Route::get('/dashboard/courses/lessons/edit/{slug}', 'editLesson')->name('teacher.lessons.edit');
        Route::post('/dashboard/courses/lessons/edit/{slug}', 'updateLesson')->name('teacher.lessons.update');
        Route::delete('/dashboard/courses/lessons/delete/{id}', 'deleteLesson')->name('teacher.lessons.delete');
        Route::get('/dashboard/courses/lessons/{slug}', 'showLesson')->name('teacher.lessons.show');
        Route::get('/dashboard/courses/lessons/quiz/create/{slug}', 'createQuiz')->name('teacher.quiz.create');
        Route::post('/dashboard/courses/quiz/create/{slug}', 'storeQuiz')->name('teacher.quiz.store');
        Route::post('/dashboard/courses/quiz/{id}', 'deleteQuiz')->name('teacher.quiz.delete');
        Route::get('/dashboard/courses/project/all/{slug}', 'allProjects')->name('teacher.project.all');
        Route::get('/dashboard/courses/project/create/{slug}', 'createProject')->name('teacher.project.create');
        Route::post('/dashboard/courses/project/create/{slug}', 'storeProject')->name('teacher.project.store');
        Route::get('/dashboard/courses/project/edit/{slug}', 'editProject')->name('teacher.project.edit');
        Route::post('/dashboard/courses/project/edit/{id}', 'updateProject')->name('teacher.project.update');
        Route::get('/dashboard/courses/project/show/{slug}', 'showProject')->name('teacher.project.show');
        Route::delete('/dashboard/courses/project/{id}', 'deleteProject')->name('teacher.project.delete');
    });
});

Route::get('/dashboard/courses/{slug}/zoom', [ZoomController::class, 'livePage'])->name('liveChat');
Route::get('/dashboard/courses/{slug}/zoom/connect', [ZoomController::class, 'redirectToZoom'])->name('zoom.redirect');
Route::get('/dashboard/courses/{slug}/zoom/callback', [ZoomController::class, 'handleCallback'])->name('zoom.callback');
Route::get('/dashboard/courses/{slug}/zoom/disconnect', [ZoomController::class, 'disconnectZoom'])->name('zoom.disconnect');
Route::get('/dashboard/courses/{slug}/zoom/create-meeting', [ZoomController::class, 'createMeeting'])->name('zoom.create');
Route::get('/dashboard/courses/{slug}/zoom/attend', [ZoomController::class, 'attendMeeting'])->name('zoom.attend');


Route::get('/google/auth', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');


Route::group([], function () {
    Route::get('/notFound/{slug}', [homeController::class, 'fromSearch'])->name('course.search')->middleware('auth');
});
