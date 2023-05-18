<?php

namespace App\Http\Controllers\API\User;

use App\Exceptions\UserError;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contracts\User\UserInterface;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected readonly UserInterface $user)
    {
    }

    public function viewUserDetails(): JsonResponse
    {
        try {
            $user = $this->user->viewUserDetails(\request()->user());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }

    public function updateUserDetails(UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->user->editUserDetails(\request()->user(), $request->validated());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }


}
