<?php

use App\Http\Controllers\admin\AdminTeacherController;
use App\Http\Controllers\admin\certificateController;
use App\Http\Controllers\admin\courseCategoreyController;
use App\Http\Controllers\admin\evaluationController;
use App\Http\Controllers\admin\feedbackController;
use App\Http\Controllers\admin\lessonController;
use App\Http\Controllers\admin\MyCoursesController;
use App\Http\Controllers\admin\parentController;
use App\Http\Controllers\admin\projectController;
use App\Http\Controllers\admin\reportController;
use App\Http\Controllers\admin\sessionTimeController;
use App\Http\Controllers\admin\studentController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\admin\trainerController;
use App\Http\Controllers\adminstrator\categoreyController;
use App\Http\Controllers\adminstrator\CoursesController;
use App\Http\Controllers\adminstrator\gamesController;
use App\Http\Controllers\adminstrator\settingsController;
use App\Http\Controllers\home\ClickPayController;
use App\Http\Controllers\home\CoursesWebController;
use App\Http\Controllers\home\gamePaymentController;
use App\Http\Controllers\home\GoogleAuthController;
use App\Http\Controllers\home\homeController;
use App\Http\Controllers\home\schoolController;
use App\Http\Middleware\parentMiddleware;
use App\Http\Middleware\superAdminMiddleware;
use App\Http\Middleware\trainerMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SuperAdminController;
use App\Http\Controllers\public\AuthController as PublicAuthController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\adminstrator\adminController as AdminstratorController;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::group([], function () {
    Route::get('/courses/all', [CoursesWebController::class, 'courses'])->name('web.courses');
    Route::get('/courses/{slug}/show', [CoursesWebController::class, 'show'])->name('web.courses.show');
    Route::get('/courses/enrolled/myCourses', [CoursesWebController::class, 'enrolledCourses'])->name('web.courses.enrolled');
    Route::get('/courses/enrolled/myCourses/{course}', [CoursesWebController::class, 'enrolledCourse'])->name('web.courses.enrolled.show');
    Route::post('/courses/enrolled/myCourses/{course}/upload', [CoursesWebController::class, 'uploadProject'])->name('uploadProject');
    Route::get('/courses/enrolled/myCourses/{course}/lesson', [CoursesWebController::class, 'showLesson'])->name('web.courses.enrolled.lesson');
    Route::get('/privacy-policy', [CoursesWebController::class, 'privacy'])->name('web.privacy');
    Route::get('/terms-and-conditions', [CoursesWebController::class, 'terms'])->name('web.terms');
});

Route::group([], function () {
    Route::get('/login', [PublicAuthController::class, 'login'])->name('login');
    Route::post('/login', [PublicAuthController::class, 'storeLogin'])->name('login.store');
    Route::get('/register', [PublicAuthController::class, 'register'])->name('register');
    Route::post('/register', [PublicAuthController::class, 'storeRegister'])->name('register.store');
    Route::post('/logout', [PublicAuthController::class, 'logout'])->name('logout');
});

Route::group([], function () {
    Route::get('/', [homeController::class, 'separate'])->name('choose');
    Route::get('/home/store', [homeController::class, 'index'])->name('home');
    Route::get('/home/store/categorey/{categorey}', [homeController::class, 'showCategorey'])->name('categorey.show');
    Route::get('/home/about-us', [homeController::class, 'about'])->name('about');
    Route::get('/home/contact', [homeController::class, 'contact'])->name('contact');
    Route::get('/home/profile', [homeController::class, 'profile'])->name('profile');
    Route::post('/home/profile', [homeController::class, 'UpdateProfile'])->name('profile.update');
    Route::post('/home/profile/password', [homeController::class, 'UpdatePassword'])->name('password.update');
    Route::get('/home/game/show/{game}/details', [homeController::class, 'showGame'])->name('game.show');
    Route::get('/home/games', [homeController::class, 'allGames'])->name('games.all');
    Route::get('/home/games/user/cart', [homeController::class, 'cart'])->name('cart')->middleware('auth');
    Route::delete('/home/games/cart/{id}', [homeController::class, 'deleteFromCart'])->name('game.removeFromCart')->middleware('auth');
    Route::post('/home/games/cart/checkout/done', [homeController::class, 'checkout'])->name('checkout')->middleware('auth');
    Route::post('/home/games/{game}/addToCart', [homeController::class, 'addToCart'])->name('game.AddToCart');
    Route::get('/home/schools', [schoolController::class, 'schools'])->name('schools');
    Route::get('/home/school/{slug}', [schoolController::class, 'showSchool'])->name('school.show');
    Route::get('/home/school/index/all', [schoolController::class, 'allSchools'])->name('school.all');
});

Route::group([
], function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('/school/register', 'schoolRegister')->name('school.register');
        Route::post('/school/register', 'registerSchool')->name('school.register.store');
        Route::get('/school/login', 'schoolLogin')->name('school.login');
        Route::post('/school/login', 'loginSchool')->name('school.login.store');
        Route::get('/school/logout', 'logout')->name('school.logout');
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
        Route::post('school/dashboard/reports/create/store/report', 'storeReport')->name('school.reports.store');
        Route::delete('school/dashboard/reports/create/store/report/{report}', 'deleteReport')->name('school.reports.destroy');
        Route::get('school/{slug}/dashboard/settings', 'schoolSettings')->name('school.settings');
        Route::get('school/{slug}/dashboard/pendings', 'schoolPendings')->name('school.pendings');
        Route::get('school/{slug}/dashboard/pendings/{name}/accept', 'accept')->name('school.pendings.accept');
        Route::get('school/{slug}/dashboard/pendings/{name}/reject', 'reject')->name('school.pendings.reject');
        Route::get('school/{slug}/dashboard/pendings/{name}/show', 'showPending')->name('school.pendings.show');
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
        Route::post('/trainer/courses/{project}/feedback', 'feedback')->name('trainer.feedback');
        Route::delete('/trainer/courses/{slug}/delete', 'deleteCourse')->name('trainer.courses.destroy');
        Route::get('/trainer/courses/{slug}/report/{user}', 'createReport')->name('trainer.report.create');
        Route::post('/trainer/courses/{slug}/report/{user}', 'storeReport')->name('trainer.report.store');
        Route::get('/trainer/course/{course}/lesson/create', 'createLesson')->name('trainer.lesson.create');
        Route::get('/trainer/course/{course}/lesson/show/lesson', 'showLesson')->name('trainer.lesson.show');
        Route::delete('/trainer/course/{course}/lesson/show/delete', 'destroyLesson')->name('trainer.lesson.destroy');
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
        Route::get('/trainer/students/all', 'allStudents')->name('teacher.students');
        Route::get('/trainer/student/create/form', 'createStudent')->name('teacher.student.create');
        Route::post('/trainer/student/create/form', 'storeStudent')->name('teacher.student.store');
        Route::get('/trainer/student/create/excel', 'ExcelStudent')->name('teacher.student.excel');
        Route::post('/trainer/student/create/excel', 'uploadExcel')->name('teacher.excel.upload');
        Route::get('/trainer/student/{student}/edit', 'editStudent')->name('teacher.student.edit');
        Route::post('/trainer/student/{student}/edit', 'updateStudent')->name('teacher.student.update');
        Route::get('/trainer/student/{student}/delete', 'deleteStudent')->name('teacher.student.delete');
        Route::get('/trainer/courses/assisnments/me', 'allProjects')->name('teacher.projects');
    });
});

Route::get('/google/auth', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');


Route::get('/pay/{cart}/form/store', [gamePaymentController::class, 'showPaymentForm'])->name('pay.form.store')->middleware('auth');
Route::post('/pay/{cart}/init/store', [gamePaymentController::class, 'initiatePayment'])->name('pay.initiate.store')->middleware('auth');
Route::get('/pay/callback/{cart}/store', [gamePaymentController::class, 'callback'])->name('pay.callback.store')->middleware('auth');
Route::match(['get', 'post'], '/pay/success/done/{cart}/store', [gamePaymentController::class, 'success'])
    ->name('pay.success.store')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
Route::match(['get', 'post'], '/pay/fail/done', function () {
    return view('payment.failed');
})->name('pay.fail.store')->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminstratorController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminstratorController::class, 'storeLogin'])->name('admin.login.store');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminstratorController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/courses', [CoursesController::class, 'courses'])->name('admin.courses');
    Route::post('/dashboard/courses/{course}/edit', [CoursesController::class, 'editCourse'])->name('admin.course.edit');
    Route::get('/dashboard/courses/me/all', [MyCoursesController::class, 'index'])->name('admin.courses.me');
    Route::get('/dashboard/courses/me/{course}/show', [MyCoursesController::class, 'show'])->name('admin.courses.me.show');
    Route::get('/dashboard/courses/me/create', [MyCoursesController::class, 'create'])->name('admin.courses.me.create');
    Route::post('/dashboard/courses/me/store', [MyCoursesController::class, 'store'])->name('admin.courses.me.store');
    Route::post('/dashboard/courses/me/edit', [MyCoursesController::class, 'edit'])->name('admin.courses.me.update');
    Route::delete('/dashboard/courses/me/delete', [MyCoursesController::class, 'delete'])->name('admin.courses.me.delete');
    Route::get('/categorey', [categoreyController::class, 'categorey'])->name('admin.categorey');
    Route::get('/categorey/create', [categoreyController::class, 'createCategorey'])->name('admin.create.Categorey');
    Route::post('/categorey/store', [categoreyController::class, 'storeCategorey'])->name('admin.store.Categorey');
    Route::get('/categorey/edit/{categorey}', [categoreyController::class, 'editCategorey'])->name('admin.edit.Categorey');
    Route::post('/categorey/update/{categorey}', [categoreyController::class, 'updateCategorey'])->name('admin.update.Categorey');
    Route::delete('/categorey/delete/{categorey}', [categoreyController::class, 'deleteCategorey'])->name('admin.delete.Categorey');
    Route::get('/games', [gamesController::class, 'games'])->name('admin.games.index');
    Route::get('/games/create', [gamesController::class, 'createGame'])->name('admin.games.create');
    Route::post('/games', [gamesController::class, 'storeGame'])->name('admin.games.store');
    Route::get('/games/{game}', [gamesController::class, 'showGame'])->name('admin.games.show');
    Route::delete('/games/{game}', [gamesController::class, 'deleteGame'])->name('admin.games.delete');
    Route::get('/schools', [\App\Http\Controllers\adminstrator\schoolController::class, 'schools'])->name('admin.schools.index');
    Route::get('/schools/create', [\App\Http\Controllers\adminstrator\schoolController::class, 'createSchool'])->name('admin.schools.create');
    Route::post('/schools', [\App\Http\Controllers\adminstrator\schoolController::class, 'storeSchool'])->name('admin.schools.store');
    Route::get('/schools/{school}/show', [\App\Http\Controllers\adminstrator\schoolController::class, 'showSchool'])->name('admin.schools.show');
    Route::get('/schools/{school}/show/{user}', [\App\Http\Controllers\adminstrator\schoolController::class, 'editUser'])->name('admin.schools.user.edit');
    Route::post('/schools/{school}/edit/{user}', [\App\Http\Controllers\adminstrator\schoolController::class, 'updateSchoolUser'])->name('admin.schools.user.update');
    Route::delete('/schools/{school}/delete/{user}', [\App\Http\Controllers\adminstrator\schoolController::class, 'deleteUser'])->name('admin.schools.user.delete');
    Route::get('/schools/{school}/edit', [\App\Http\Controllers\adminstrator\schoolController::class, 'editSchool'])->name('admin.schools.edit');
    Route::post('/schools/{school}/edit', [\App\Http\Controllers\adminstrator\schoolController::class, 'updateSchool'])->name('admin.schools.update');
    Route::delete('/schools/{school}/delete', [\App\Http\Controllers\adminstrator\schoolController::class, 'deleteSchool'])->name('admin.schools.destroy');
    Route::get('/schools/{school}/teachers', [\App\Http\Controllers\adminstrator\schoolController::class, 'SchoolTeachers'])->name('admin.schools.teachers');
    Route::get('/trainers', [\App\Http\Controllers\adminstrator\schoolController::class, 'trainers'])->name('admin.trainers.index');
    Route::get('/settings', [settingsController::class, 'settings'])->name('admin.settings.index');
    Route::post('/settings/user', [settingsController::class, 'updateUser'])->name('admin.settings.user.update');
    Route::post('/settings/password', [settingsController::class, 'updatePassword'])->name('admin.settings.password.update');
    Route::get('/courses/category', [courseCategoreyController::class, 'index'])->name('admin.courses.category');
    Route::post('/courses/category', [courseCategoreyController::class, 'store'])->name('admin.courses.category.store');
    Route::post('/courses/category/{category}', [courseCategoreyController::class, 'update'])->name('admin.courses.category.update');
    Route::delete('/courses/category/{category}', [courseCategoreyController::class, 'delete'])->name('admin.courses.category.delete');
    Route::post('/admin/courses/{project}/feedback', [feedbackController::class, 'feedback'])->name('admin.feedback');
    Route::get('/admin/courses/{slug}/report/{user}', [reportController::class, 'createReport'])->name('admin.report.create');
    Route::post('/admin/courses/{slug}/report/{user}', [reportController::class, 'storeReport'])->name('admin.report.store');
    Route::get('/admin/course/{course}/lesson/create', [lessonController::class, 'createLesson'])->name('admin.lesson.create');
    Route::get('/admin/course/{course}/lesson/show/lesson', [lessonController::class, 'showLesson'])->name('admin.lesson.show');
    Route::delete('/admin/course/{course}/lesson/show/delete', [lessonController::class, 'destroyLesson'])->name('admin.lesson.destroy');
    Route::post('/admin/course/{course}/lesson/store', [lessonController::class, 'storeLesson'])->name('admin.lesson.store');
    Route::delete('/admin/course/{course}/lesson/delete', [lessonController::class, 'deleteLesson'])->name('admin.lesson.delete');
    Route::get('/admin/course/{course}/project/create', [projectController::class, 'createProject'])->name('admin.project.create');
    Route::post('/admin/course/{course}/project/create', [projectController::class, 'storeProject'])->name('admin.project.store');
    Route::delete('/admin/course/project/delete/{graduationProject}', [projectController::class, 'deleteProject'])->name('admin.project.delete');
    Route::get('/admin/projects', [projectController::class, 'trainerProjects'])->name('admin.projects');
    Route::get('/admin/evaluations', [evaluationController::class, 'trainerEvaluations'])->name('admin.evaluations');
    Route::post('/admin/evaluations', [evaluationController::class, 'storeEvaluation'])->name('admin.evaluation.store');
    Route::get('/admin/schedules', [sessionTimeController::class, 'trainerSchedules'])->name('admin.schedules');
    Route::get('/admin/schedules/create', [sessionTimeController::class, 'createSessionTime'])->name('admin.schedules.create');
    Route::post('/admin/schedules/create', [sessionTimeController::class, 'storeSessionTime'])->name('admin.schedules.store');
    Route::get('/admin/schedules/{sessionTime}/edit', [sessionTimeController::class, 'editSessionTime'])->name('admin.schedules.edit');
    Route::post('/admin/schedules/{sessionTime}/edit', [sessionTimeController::class, 'updateSessionTime'])->name('admin.schedules.update');
    Route::delete('/admin/schedules/{sessionTime}', [sessionTimeController::class, 'deleteSessionTime'])->name('admin.schedules.destroy');
    Route::get('/admin/certificates', [certificateController::class, 'trainerCertificates'])->name('admin.certificates');
    Route::post('/admin/certificates', [certificateController::class, 'storeCertificate'])->name('admin.certificate.store');

    Route::get('/admin/teachers/all', [AdminTeacherController::class, 'index'])->name('admin.teachers');
    Route::get('/admin/teacher/create/form', [AdminTeacherController::class, 'create'])->name('admin.teacher.create');
    Route::post('/admin/teacher/create/form', [AdminTeacherController::class, 'store'])->name('admin.teacher.store');
    Route::get('/admin/teacher/{teacher}/edit', [AdminTeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::post('/admin/teacher/{teacher}/edit', [AdminTeacherController::class, 'update'])->name('admin.teacher.update');
    Route::get('/admin/teacher/{teacher}/delete', [AdminTeacherController::class, 'destroy'])->name('admin.teacher.delete');

    Route::get('/admin/students/all', [studentController::class, 'allStudents'])->name('admin.students');
    Route::get('/admin/courses/assisnments/me', [projectController::class, 'allProjects'])->name('admin.projects');
    Route::get('/admin/student/create/form', [studentController::class, 'createStudent'])->name('admin.student.create');
    Route::post('/admin/student/create/form', [studentController::class, 'storeStudent'])->name('admin.student.store');
    Route::get('/admin/student/create/excel', [studentController::class, 'ExcelStudent'])->name('admin.student.excel');
    Route::post('/admin/student/create/excel', [studentController::class, 'uploadExcel'])->name('admin.excel.upload');
    Route::get('admin/dashboard/student/{name}/linkParent', [studentController::class, 'linkParent'])->name('admin.student.linkParent');
    Route::post('admin/dashboard/student/{name}/linkParent/{parent}', [studentController::class, 'linkParentStore'])->name('admin.student.linkParent.store');
    Route::get('/admin/student/{student}/edit', [studentController::class, 'editStudent'])->name('admin.student.edit');
    Route::post('/admin/student/{student}/edit', [studentController::class, 'updateStudent'])->name('admin.student.update');
    Route::get('/admin/student/{student}/delete', [studentController::class, 'deleteStudent'])->name('admin.student.delete');

})->middleware(superAdminMiddleware::class);


Route::get('/pay/{course}/form', [ClickPayController::class, 'showPaymentForm'])->name('pay.form')->middleware('auth');
Route::post('/pay/{course}/init', [ClickPayController::class, 'initiatePayment'])->name('pay.initiate')->middleware('auth');
Route::get('/pay/callback/{course}', [ClickPayController::class, 'callback'])->name('pay.callback')->middleware('auth');
Route::match(['get', 'post'], '/pay/success/done/{course}/{user_id}', [ClickPayController::class, 'success'])
    ->name('pay.success')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
Route::match(['get', 'post'], '/pay/fail/done', function () {
    return view('payment.failed');
})->name('pay.fail')->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);