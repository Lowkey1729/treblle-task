<?php

use App\Http\Controllers\API\Auth\APIAuthSessionController;
use App\Http\Controllers\API\Auth\APIPasswordController;
use App\Http\Controllers\API\Auth\APIRegisterUserController;
use App\Http\Controllers\API\User\APIUserController;
use App\Services\Helpers\ApiResponse;
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
    Route::post('/login', [APIAuthSessionController::class, 'loginUser'])
        ->name('auth.login-user');

    Route::post('/register', APIRegisterUserController::class)
        ->name('auth.register-user');

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/view', [APIUserController::class, 'viewUserDetails'])
            ->name('view-user-details');

        Route::put('update', [APIUserController::class, 'updateUserDetails'])
            ->name('update-user-details');
    });

    Route::get('auth/logout', [APIAuthSessionController::class, 'logoutUser'])
        ->name('auth.logout-user');

    Route::put('auth/update/password', [APIPasswordController::class, 'updatePassword'])
        ->name('auth.update.password');
});


Route::fallback(function (){
   return ApiResponse::failed('Resource not found.', httpStatusCode: 404);
});
