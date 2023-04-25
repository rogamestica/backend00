<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\CarouselItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public APIs
Route::controller(AuthController::class)->group(function () {
    Route::post('/login',    'login')->name('user.login');
    Route::post('/user',  'store')->name('user.store');
   
});

// // private api's
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//PRIVATE APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',  [AuthController::class,  'logout']);

    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',             'index');
        Route::get('/carousel/{id}',        'show');
        Route::post('/carousel',            'store');
        Route::put('/carousel/{id}',        'update');
        Route::delete('/carousel/{id}',     'destroy');
    });

     Route::controller(UserController::class)->group(function () {
        Route::get('/user',              'index');
        Route::get('/user/{id}',         'show');
        Route::put('/user/{id}',         'update')->name('user.update'); 
        Route::put('/user/{id}',         'email')->name('user.email'); //ing ani ako pero mugana
        //Route::put('/user/email/{id}', 'email')->name('user.email'); //kang sir pero mugana gihapon
        Route::put('/user/{id}',         'password')->name('user.password'); //ing ani ako pero mugana
        //Route::put('/user/password/{id}', 'password')->name('user.password'); //kang sir pero mugana gihapon
        Route::delete('/user/{id}',      'destroy');
    });
   

});

Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);
Route::put('/messages/{id}', [MessageController::class, 'update']);
