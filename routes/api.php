<?php

use App\Http\Controllers\API\Auth\AuthAPISessionController;
use App\Http\Controllers\API\Auth\RegisterUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthAPISessionController::class, 'loginUser'])
        ->name('auth.login-user');

    Route::post('/register', RegisterUserController::class)
        ->name('auth.register-user');

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('auth/logout', [AuthAPISessionController::class, 'logoutUser'])
        ->name('auth.logout-user');
});
