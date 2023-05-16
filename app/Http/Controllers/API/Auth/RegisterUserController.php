<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Contracts\Auth\RegisterInterFace;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class RegisterUserController extends Controller
{
    public function __construct(protected readonly RegisterInterFace $register)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->register->registerUser($request->validated());
        } catch (\Exception $exception) {
            Log::error($exception);

            return ApiResponse::failed('An unexpected error was encountered', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }
}
