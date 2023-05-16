<?php

use App\Http\Controllers\Web\Auth\AuthWebSessionController;
use App\Http\Controllers\Web\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('web')->group(function () {

    Route::prefix('auth')->group(function () {
        //        Route::post('/login', [AuthWebSessionController::class, 'loginUser'])
        //            ->name('auth-web.');

        Route::post('/register', RegisterUserController::class)
            ->name('auth.web.register-user');

    });
});
