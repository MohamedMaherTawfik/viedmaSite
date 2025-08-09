<?php

use App\Http\Controllers\admin\parentController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\admin\trainerController;
use App\Http\Controllers\home\ClickPayController;
use App\Http\Controllers\home\homeController;
use App\Http\Middleware\parentMiddleware;
use App\Http\Middleware\Teacher;
use App\Http\Middleware\teacherMiddleware;
use App\Http\Middleware\trainerMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SuperAdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Middleware\CheckAdmin;


Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'signUp')->name('register');
    Route::post('/register', 'register')->name('signup');
    Route::get('/teacher', 'teacherRegister')->name('teacher');
    Route::post('/teacher', 'teacher')->name('teacher.info');
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
});

Route::group([
], function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('school/register', 'schoolRegister')->name('school.register');
        Route::post('school/register', 'registerSchool')->name('school.register.store');
        Route::get('school/login', 'schoolLogin')->name('school.login');
        Route::post('school/login', 'loginSchool')->name('school.login.store');
        Route::get('school/logout', 'logout')->name('school.logout');
    });
});

Route::group([
    'middleware' => ['auth', CheckAdmin::class]
], function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('school/{slug}/dashboard', 'schoolDashboard')->name('school.dashboard');
        Route::get('school/{slug}/dashboard/teachers', 'schoolTeachers')->name('school.teachers');
        Route::get('school/{slug}/dashboard/teachers/{name}', 'showTeacher')->name('school.teachers.show');
        Route::get('school/{slug}/dashboard/teachers/{teacher}/notify', 'notifyTeacher')->name('sendNotification');
        Route::get('school/{slug}/dashboard/teachers/create/form', 'createUser')->name('school.teachers.create');
        Route::post('school/{slug}/dashboard/teachers/create/form', 'storeUser')->name('school.teachers.store');
        Route::get('school/{slug}/dashboard/teachers/{name}/edit', 'editTeacher')->name('school.teachers.edit');
        Route::post('school/{slug}/dashboard/teachers/{name}/edit', 'editTeacher')->name('school.teachers.edit');
        Route::delete('school/{slug}/dashboard/teachers/{name}', 'deleteUser')->name('school.teachers.delete');
        Route::get('school/{slug}/dashboard/student/{name}', 'showStudent')->name('school.student.show');
        Route::get('school/{slug}/dashboard/student/create/form', 'createStudent')->name('school.student.create');
        Route::get('school/{slug}/dashboard/student/create/excel', 'ExcelStudent')->name('school.student.excel');
        Route::post('school/{slug}/dashboard/student/create/excel', 'uploadExcel')->name('excel.upload');
        Route::post('school/{slug}/dashboard/student/create/form', 'storeStudent')->name('school.student.store');
        Route::get('school/{slug}/dashboard/student/{name}/edit', 'editStudent')->name('school.student.edit');
        Route::post('school/{slug}/dashboard/student/{name}/edit', 'updateStudent')->name('school.student.update');
        Route::get('school/{slug}/dashboard/student/{name}/linkParent', 'linkParent')->name('school.student.linkParent');
        Route::post('school/{slug}/dashboard/student/{name}/linkParent/{parent}', 'linkParentStore')->name('school.student.linkParent.store');
        Route::get('school/{slug}/dashboard/student/{name}/delete', 'deleteStudent')->name('school.student.delete');
        Route::get('school/{slug}/dashboard/students', 'schoolStudents')->name('school.students');
        Route::get('school/{slug}/dashboard/projects', 'schoolProjects')->name('school.projects');
        Route::get('school/{slug}/dashboard/reports', 'schoolReports')->name('school.reports');
        Route::get('school/{slug}/dashboard/reports/{report}', 'showReport')->name('school.reports.show');
        Route::get('school/{slug}/dashboard/reports/create', 'createReport')->name('school.reports.create');
        Route::post('school/{slug}/dashboard/reports/create', 'storeReport')->name('school.reports.store');
        Route::get('school/{slug}/dashboard/settings', 'schoolSettings')->name('school.settings');
        Route::get('school/{slug}/dashboard/pendings', 'schoolPendings')->name('school.pendings');
        Route::get('school/{slug}/dashboard/pendings/{name}/accept', 'accept')->name('school.pendings.accept');
        Route::get('school/{slug}/dashboard/pendings/{name}/reject', 'reject')->name('school.pendings.reject');
        Route::get('school/{slug}/dashboard/pendings/{name}/show', 'showPending')->name('school.pendings.show');
    });
});

Route::group([
    'middleware' => ['auth', teacherMiddleware::class],
], function () {
    Route::controller(teacherController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/dashboard/courses', 'allCourses')->name('teacher.courses');
        Route::get('/dashboard/courses/enrolled', 'myCourses')->name('teacher.myCourses');
        Route::get('/dashboard/courses/enrolled/{course}', 'myCourse')->name('teacher.myCourse');
        Route::post('/dashboard/courses/enrolled/{course}/uploadProject', 'uploadProject')->name('teacher.project.upload');
        Route::post('/dashboard/course/{slug}/enroll/free', 'freeCourse')->name('teacher.course.enroll.free');
        Route::get('/dashboard/courses/lessons/{slug}', 'showLesson')->name('teacher.lessons.show');
        Route::get('/dashboard/certificates', 'certificates')->name('teacher.certificates');
        Route::get('/dashboard/courses/assisnments/me', 'allProjects')->name('teacher.projects');
        Route::get('/dashboard/students/all', 'allStudents')->name('teacher.students');
        Route::get('/dashboard/student/create/form', 'createStudent')->name('teacher.student.create');
        Route::post('/dashboard/student/create/form', 'storeStudent')->name('teacher.student.store');
        Route::get('/dashboard/student/create/excel', 'ExcelStudent')->name('teacher.student.excel');
        Route::post('/dashboard/student/create/excel', 'uploadExcel')->name('teacher.excel.upload');
        Route::get('/dashboard/student/{student}/edit', 'editStudent')->name('teacher.student.edit');
        Route::post('/dashboard/student/{student}/edit', 'updateStudent')->name('teacher.student.update');
        Route::get('/dashboard/student/{student}/delete', 'deleteStudent')->name('teacher.student.delete');
        Route::get('/dashboard/evaluations', 'evaluation')->name('teacher.evaluations');
        Route::post('/dashboard/evaluations', 'storeEvaluation')->name('teacher.evaluation.store');
    });
});

Route::group([
], function () {
    Route::controller(parentController::class)->group(function () {
        Route::get('/parent/register', 'registerParent')->name('parent.register');
        Route::post('/parent/register', 'parentRegister')->name('parent.register.store');
        Route::get('/parent/login', 'loginParent')->name('parent.login');
        Route::post('/parent/login', 'parentLogin')->name('parent.login.store');
    });
});

Route::group([
    'middleware' => ['auth', parentMiddleware::class],
], function () {
    Route::controller(parentController::class)->group(function () {
        Route::get('/parent/logout', 'logout')->name('parent.logout');
        Route::get('/parent/dashboard', 'dashboard')->name('parent.dashboard');
        Route::get('/parent/children', 'children')->name('parent.children');
        Route::get('/parent/games', 'games')->name('parent.games');
        Route::get('/parent/games/cart', 'parentCart')->name('parent.cart');
        Route::delete('/parent/games/cart/{game}', 'deleteFromCart')->name('parent.game.removeFromCart');
        Route::post('/parent/games/cart', 'checkout')->name('checkout');
        Route::post('/parent/games/{game}', 'addToCart')->name('parent.game.AddToCart');
        Route::get('/parent/reports', 'reports')->name('parent.reports');
        Route::get('/parent/settings', 'settings')->name('parent.settings');
        Route::get('/parent/order/{order}', 'myorder')->name('parent.order');
        Route::post('/parent/settings', 'storeSetting')->name('parent.setting.store');
        Route::post('/parent/settingsPassword', 'storeSettingPassword')->name('parent.setting.password');
    });
});

Route::group([
], function () {
    Route::controller(trainerController::class)->group(function () {
        Route::get('/trainer/signin', 'loginTrainer')->name('trainer.login.form');
        Route::get('/trainer/register', 'signUpTrainer')->name('trainer.register.form');
        Route::post('/trainer/login', 'signinTrainer')->name('trainer.login');
        Route::post('/trainer/register', 'registerTrainer')->name('trainer.register');
    });
});

Route::group([
    'middleware' => ['auth', trainerMiddleware::class],
], function () {
    Route::controller(trainerController::class)->group(function () {
        Route::post('/trainer/logout', 'logout')->name('trainer.logout');
        Route::get('/trainer/dashbaord', 'trainerDashboard')->name('trainerDashboard');
        Route::get('/trainer/courses', 'trainerCourses')->name('trainer.courses');
        Route::get('/trainer/courses/create', 'createCourse')->name('trainer.courses.create');
        Route::post('/trainer/courses/create', 'storeCourse')->name('trainer.courses.store');
        Route::get('/trainer/courses/{slug}', 'showCourse')->name('trainer.courses.show');
        Route::get('/trainer/courses/{slug}/report/{user}', 'createReport')->name('trainer.report.create');
        Route::post('/trainer/courses/{slug}/report/{user}', 'storeReport')->name('trainer.report.store');
        Route::get('/trainer/course/{course}/lesson/create', 'createLesson')->name('trainer.lesson.create');
        Route::post('/trainer/course/{course}/lesson/store', 'storeLesson')->name('trainer.lesson.store');
        Route::delete('/trainer/course/{course}/lesson/delete', 'deleteLesson')->name('trainer.lesson.delete');
        Route::get('/trainer/course/{course}/project/create', 'createProject')->name('trainer.project.create');
        Route::post('/trainer/course/{course}/project/create', 'storeProject')->name('trainer.project.store');
        Route::delete('/trainer/course/project/delete/{graduationProject}', 'deleteProject')->name('trainer.project.delete');
        Route::get('/trainer/projects', 'trainerProjects')->name('trainer.projects');
        Route::get('/trainer/evaluations', 'trainerEvaluations')->name('trainer.evaluations');
        Route::post('/trainer/evaluations', 'storeEvaluation')->name('trainer.evaluation.store');
        Route::get('/trainer/schedules', 'trainerSchedules')->name('trainer.schedules');
        Route::get('/trainer/schedules/create', 'createSessionTime')->name('trainer.schedules.create');
        Route::post('/trainer/schedules/create', 'storeSessionTime')->name('trainer.schedules.store');
        Route::get('/trainer/schedules/{sessionTime}/edit', 'editSessionTime')->name('trainer.schedules.edit');
        Route::post('/trainer/schedules/{sessionTime}/edit', 'updateSessionTime')->name('trainer.schedules.update');
        Route::delete('/trainer/schedules/{sessionTime}', 'deleteSessionTime')->name('trainer.schedules.destroy');
        Route::get('/trainer/certificates', 'trainerCertificates')->name('trainer.certificates');
        Route::post('/trainer/certificates', 'storeCertificate')->name('trainer.certificate.store');
    });
});


Route::get('/pay/{course}/form', [ClickPayController::class, 'showPaymentForm'])->name('pay.form')->middleware('auth');
Route::post('/pay/{course}/init', [ClickPayController::class, 'initiatePayment'])->name('pay.initiate')->middleware('auth');
Route::get('/pay/callback/{course}', [ClickPayController::class, 'callback'])->name('pay.callback')->middleware('auth');
Route::match(['get', 'post'], '/pay/success/done/{course}', [ClickPayController::class, 'success'])
    ->name('pay.success')
    ->middleware('auth');
Route::match(['get', 'post'], '/pay/fail/done', function () {
    request()->session()->regenerateToken();
    return view('payment.failed');
})->name('pay.fail');
