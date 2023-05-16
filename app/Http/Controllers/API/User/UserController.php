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

    public function viewUserDetails(string $uuid): JsonResponse
    {
        try {
            $user = $this->user->viewUserDetails($uuid);
        } catch (UserError $error) {
            return ApiResponse::failed($error->getMessage(), httpStatusCode: $error->getCode());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }

    public function updateUserDetails(string $uuid, UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->user->editUserDetails($uuid, $request->validated());
        } catch (UserError $error) {
            return ApiResponse::failed($error->getMessage(), httpStatusCode: $error->getCode());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered', httpStatusCode: 500);
        }

        return ApiResponse::success($user);
    }


}
