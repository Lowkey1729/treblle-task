<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\AuthError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Contracts\Auth\AuthInterface;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthAPISessionController extends Controller
{
    public function __construct(protected readonly AuthInterface $auth)
    {
    }

    public function loginUser(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->auth->authenticateUser($request->validated());
        } catch (AuthError $error) {
            return ApiResponse::failed($error->getMessage(), httpStatusCode: $error->getCode());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered.', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }

    public function logoutUser(): JsonResponse
    {
        try {
            $this->auth->logoutUser();
        } catch (\Exception $exception) {
            Log::error($exception);
            return ApiResponse::failed('An unexpected error was encountered.', httpStatusCode: 500);
        }

        return ApiResponse::success([]);
    }
}
