<?php
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\school\achievementController;
use App\Http\Controllers\api\school\ActivitesController;
use App\Http\Controllers\api\school\certificatesController;
use App\Http\Controllers\api\school\coursesController;
use App\Http\Controllers\api\school\projectsController;
use App\Http\Controllers\api\school\SchoolsController;
use App\Http\Controllers\api\school\TeacherController;
use App\Http\Controllers\api\store\cartController;
use App\Http\Controllers\api\store\GamesController;
use App\Http\Controllers\api\store\orderController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\teacherMiddelware;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-register', [AuthController::class, 'verifyOtpAfterRegister']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->middleware('jwt.auth');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'school'
], function () {
    Route::get('/allSchools', [SchoolsController::class, 'allSchools']);
    Route::get('/singleSchool/{id}', [SchoolsController::class, 'singleSchool']);
    Route::post('/createSchool', [SchoolsController::class, 'createSchool'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::post('/updateSchool/{id}', [SchoolsController::class, 'updateSchool'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::delete('/deleteSchool/{id}', [SchoolsController::class, 'deleteSchool'])->middleware('jwt.auth', AdminMiddleware::class);
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'games'
], function () {
    Route::get('/allGames', [GamesController::class, 'allGames']);
    Route::get('/showGame/{id}', [GamesController::class, 'showGame']);
    Route::post('/createGame', [GamesController::class, 'createGames'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::post('/updateGame/{id}', [GamesController::class, 'updateGame'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::delete('/deleteGame/{id}', [GamesController::class, 'deleteGame'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::post('/searchforGame', [GamesController::class, 'searchforGame']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'cart'
], function () {
    Route::post('/createCart', [cartController::class, 'createCart'])->middleware('jwt.auth');
    Route::post('/addToCart/{id}', [cartController::class, 'addToCart'])->middleware('jwt.auth');
    Route::post('/updateCart/{id}', [cartController::class, 'updateCart'])->middleware('jwt.auth');
    Route::get('/getCart', [cartController::class, 'getCart'])->middleware('jwt.auth');
    Route::delete('/removeFromCart/{id}', [cartController::class, 'removeFromCart'])->middleware('jwt.auth');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'orders'
], function () {
    Route::get('/allOrders', [orderController::class, 'allOrders'])->middleware('jwt.auth', AdminMiddleware::class);
    Route::post('/createOrder', [orderController::class, 'createOrder'])->middleware('jwt.auth');
    Route::get('/getOrders', [orderController::class, 'getOrders'])->middleware('jwt.auth');
    Route::get('/getOrder/{id}', [orderController::class, 'getOrder'])->middleware('jwt.auth');
    Route::delete('/deleteOrder/{id}', [orderController::class, 'deleteOrder'])->middleware('jwt.auth');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'Activites'
], function () {
    Route::post('/activity/all', [ActivitesController::class, 'getActivity']);
    Route::post('/activity/create', [ActivitesController::class, 'createActivity']);
    Route::post('/activity/update/{id}', [ActivitesController::class, 'updateActivity']);
    Route::delete('/activity/delete/{id}', [ActivitesController::class, 'deleteActivity']);

    Route::post('/behaviour/create', [ActivitesController::class, 'createbehaviour']);
    Route::post('/behaviour/update/{id}', [ActivitesController::class, 'updatebehaviour']);
    Route::delete('/behaviour/delete/{id}', [ActivitesController::class, 'deletebehaviour']);

    Route::post('/interaction/create', [ActivitesController::class, 'createinteraction']);
    Route::post('/interaction/update/{id}', [ActivitesController::class, 'updateinteraction']);
    Route::delete('/interaction/delete/{id}', [ActivitesController::class, 'deleteinteraction']);
});


Route::group([
    'middleware' => ['api', 'jwt.auth', teacherMiddelware::class],
    'prefix' => 'teacher'
], function () {
    Route::get('/user/all', [TeacherController::class, 'allUsers']);
    Route::get('/user/single/{id}', [TeacherController::class, 'getUser']);
    Route::post('/user/create', [TeacherController::class, 'createUser']);
    Route::post('/user/update/{id}', [TeacherController::class, 'updateUser']);
    Route::delete('/user/delete/{id}', [TeacherController::class, 'deleteUser']);
});




Route::group([
    'middleware' => ['api', 'jwt.auth', teacherMiddelware::class],
    'prefix' => 'achievement'
], function () {
    Route::get('/users/all', [achievementController::class, 'allUsers']);
    Route::get('/singleUser/{id}', [achievementController::class, 'singleUser']);
    Route::post('/addUser', [achievementController::class, 'addUser']);
    Route::delete('/deleteUser/{id}', [achievementController::class, 'deleteUser']);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'courses'
], function () {
    Route::get('/all', [coursesController::class, 'allCourses']);
    Route::get('/myCourses', [coursesController::class, 'myCourses'])->middleware('jwt.auth');
    Route::get('/single/{id}', [coursesController::class, 'singleCourse']);
    Route::post('/create', [coursesController::class, 'createCourse'])->middleware('jwt.auth');
    Route::delete('/delete/{id}', [coursesController::class, 'deleteCourse'])->middleware('jwt.auth');
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'projects'
], function () {
    Route::get('/allperCourse/{id}', [projectsController::class, 'allProjects'])->middleware('jwt.auth');
    Route::get('/singleProject/{id}', [projectsController::class, 'singleProject'])->middleware('jwt.auth');
    Route::post('/createProject/{id}', [projectsController::class, 'createProject'])->middleware('jwt.auth');
    Route::delete('/deleteProject/{id}', [projectsController::class, 'deleteProject'])->middleware('jwt.auth');
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'certificate'
], function () {
    Route::get('/allCertificatesPerTeacher/{id}', [certificatesController::class, 'allCertificates'])->middleware('jwt.auth');
    Route::get('/singleCertificate/{id}', [certificatesController::class, 'singleCertificate'])->middleware('jwt.auth');
    Route::post('/createCertificate/{id}', [certificatesController::class, 'createCertificate'])->middleware('jwt.auth');
    Route::delete('/deleteCertificate/{id}', [certificatesController::class, 'deleteCertificate'])->middleware('jwt.auth');
});