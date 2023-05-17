<?php

use App\Http\Controllers\Web\Auth\WebAuthSessionController;
use App\Http\Controllers\Web\Auth\WebRegisterUserController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\User\UserController;
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
        ->name('auth.login-form')
        ->middleware('guest');;

    Route::post('/login', [WebAuthSessionController::class, 'loginUser'])
        ->name('auth-web.login-user')
        ->middleware('guest');;

    Route::post('/register', WebRegisterUserController::class)
        ->name('auth.web.register-user');

});

Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/view/{uuid}', [UserController::class, 'viewUserDetails'])
            ->name('web.view-user-details');

        Route::post('update/{uuid}', [UserController::class, 'updateUserDetails'])
            ->name('web.update-user-details');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('web.dashboard.index');

    Route::get('auth/logout', [WebAuthSessionController::class, 'logoutUser'])
        ->name('auth-web.logout-user');

});
