<?php

use App\Http\Controllers\Web\Auth\WebAuthSessionController;
use App\Http\Controllers\Web\Auth\WebPasswordController;
use App\Http\Controllers\Web\Auth\WebRegisterUserController;
use App\Http\Controllers\Web\Dashboard\WebDashboardController;
use App\Http\Controllers\Web\User\WebUserController;
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


Route::prefix('auth')->group(function () {

    Route::get('/login', [WebAuthSessionController::class, 'loginForm'])
        ->name('auth.login-form');

    Route::post('/login', [WebAuthSessionController::class, 'loginUser'])
        ->name('auth-web.login-user');

    Route::get('/register', [WebRegisterUserController::class, 'registerForm'])
        ->name('auth.register-form');

    Route::post('/register', [WebRegisterUserController::class, 'registerUser'])
        ->name('auth.web.register-user');

})->middleware('guest');

Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/view', [WebUserController::class, 'viewUserDetails'])
            ->name('web.view-user-details');

        Route::put('update', [WebUserController::class, 'updateUserDetails'])
            ->name('web.update-user-details');
    });

    Route::get('dashboard', [WebDashboardController::class, 'index'])
        ->name('web.dashboard.index');

    Route::get('auth/logout', [WebAuthSessionController::class, 'logoutUser'])
        ->name('auth-web.logout-user');

    Route::put('auth/update/password', [WebPasswordController::class, 'updatePassword'])
        ->name('auth.web.update.password');

});
