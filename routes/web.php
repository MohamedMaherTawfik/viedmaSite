<?php

use App\Http\Controllers\admin\parentController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\admin\trainerController;
use App\Http\Controllers\home\homeController;
use App\Http\Middleware\Teacher;
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
        Route::get('school/{slug}/dashboard/training', 'schoolTraining')->name('school.training');
        Route::get('school/{slug}/dashboard/projects', 'schoolProjects')->name('school.projects');
        Route::get('school/{slug}/dashboard/enrollments', 'schoolEnrollments')->name('school.enrollments');
        Route::get('school/{slug}/dashboard/reports', 'schoolReports')->name('school.reports');
        Route::get('school/{slug}/dashboard/reports/{name}', 'showReport')->name('school.reports.show');
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
    'middleware' => ['auth', Teacher::class],
], function () {
    Route::controller(teacherController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/dashboard/courses', 'allCourses')->name('teacher.courses');
        Route::get('/dashboard/courses/enrolled', 'myCourses')->name('teacher.myCourses');
        Route::post('/dashboard/course/{slug}/enroll/free', 'freeCourse')->name('teacher.course.enroll.free');
        Route::post('/dashboard/course/{slug}/enroll/paid', 'paidCourse')->name('teacher.course.subscribe');
        Route::get('/dashboard/courses/lessons/{slug}', 'showLesson')->name('teacher.lessons.show');
        Route::get('/dashboard/certificates', 'certificates')->name('teacher.certificates');
        Route::get('/dashboard/courses/assisnments/me', 'allProjects')->name('teacher.projects');
        Route::get('/dashboard/students/all', 'allStudents')->name('teacher.students');
        Route::get('/dashboard/student/create/form', 'createStudent')->name('teacher.student.create');
        Route::post('/dashboard/student/create/form', 'storeStudent')->name('teacher.student.store');
        Route::get('/dashboard/student/create/excel', 'ExcelStudent')->name('teacher.student.excel');
        Route::post('/dashboard/student/create/excel', 'uploadExcel')->name('teacher.excel.upload');
        Route::get('/dashboard/student/{name}/edit', 'editStudent')->name('teacher.student.edit');
        Route::post('/dashboard/student/{name}/edit', 'updateStudent')->name('teacher.student.update');
        Route::get('/dashboard/student/{name}/delete', 'deleteStudent')->name('teacher.student.delete');
        Route::get('/dashboard/evaluations', 'evaluation')->name('teacher.evaluations');
    });
});

Route::group([
], function () {
    Route::controller(parentController::class)->group(function () {
        Route::get('parent/register', 'registerParent')->name('parent.register');
        Route::post('parent/register', 'parentRegister')->name('parent.register.store');
        Route::get('parent/login', 'loginParent')->name('parent.login');
        Route::post('parent/login', 'parentLogin')->name('parent.login.store');
        Route::get('parent/logout', 'logout')->name('parent.logout');
    });
});


Route::group([], function () {
    Route::controller(trainerController::class)->group(function () {
        Route::get('/trainer/signin', 'loginTrainer')->name('trainer.login.form');
        Route::get('/trainer/register', 'signUpTrainer')->name('trainer.register.form');
        Route::post('/trainer/login', 'signinTrainer')->name('trainer.login');
        Route::post('/trainer/register', 'registerTrainer')->name('trainer.register');
        Route::post('/trainer/logout', 'logout')->name('trainer.logout');
        Route::get('/trainer/dashbaord', 'trainerDashboard')->name('trainerDashboard');
        Route::get('/trainer/courses', 'trainerCourses')->name('trainer.courses');
        Route::get('/trainer/courses/create', 'createCourse')->name('trainer.courses.create');
        Route::post('/trainer/courses/create', 'storeCourse')->name('trainer.courses.store');
        Route::get('/trainer/courses/{slug}', 'showCourse')->name('trainer.courses.show');
        Route::get('/trainer/course/{course}/lesson/create', 'createLesson')->name('trainer.lesson.create');
        Route::post('/trainer/course/{course}/lesson/store', 'storeLesson')->name('trainer.lesson.store');
        Route::delete('/trainer/course/{course}/lesson/delete', 'deleteLesson')->name('trainer.lesson.lesson');
        Route::get('/trainer/projects', 'trainerProjects')->name('trainer.projects');
        Route::get('/trainer/evaluations', 'trainerEvaluations')->name('trainer.evaluations');
        Route::get('/trainer/schedules', 'trainerSchedules')->name('trainer.schedules');
        Route::get('/trainer/schedules/create', 'createSessionTime')->name('trainer.schedules.create');
        Route::post('/trainer/schedules', 'storeSessionTime')->name('trainer.schedules.store');
        Route::get('/trainer/schedules/{sessionTime}/edit', 'editSessionTime')->name('trainer.schedules.edit');
        Route::post('/trainer/schedules/{sessionTime}/edit', 'updateSessionTime')->name('trainer.schedules.update');
        Route::delete('/trainer/schedules/{sessionTime}', 'deleteSessionTime')->name('trainer.schedules.destroy');
        Route::get('/trainer/certificates', 'trainerCertificates')->name('trainer.certificates');
    });
});
