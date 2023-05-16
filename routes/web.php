<?php

use App\Http\Controllers\Web\Auth\WebAuthSessionController;
use App\Http\Controllers\Web\Auth\WebRegisterUserController;
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
        Route::post('/login', [WebAuthSessionController::class, 'loginUser'])
            ->name('auth-web.login-user');

        Route::post('/register', WebRegisterUserController::class)
            ->name('auth.web.register-user');

    });

    Route::middleware(['auth:web', 'verified'])->group(function () {
        Route::get('auth/logout', [WebAuthSessionController::class, 'logoutUser'])
            ->name('auth-web.logout-user');
    });
});
