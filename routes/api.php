<?php
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\store\cartController;
use App\Http\Controllers\api\store\GamesController;
use App\Http\Controllers\api\store\orderController;
use App\Http\Middleware\AdminMiddleware;
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