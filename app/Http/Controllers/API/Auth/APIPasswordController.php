<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\PasswordError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Services\Contracts\Auth\PasswordInterface;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIPasswordController extends Controller
{
    public function __construct(protected readonly PasswordInterface $password)
    {
    }

    public function updatePassword(PasswordRequest $request): JsonResponse
    {
        try {
            $this->password->updatePassword(\request()->user(), $request->validated());
        } catch (PasswordError $error) {
            return ApiResponse::failed($error->getMessage());
        } catch (\Exception $exception) {
            return ApiResponse::failed('An unexpected error was encountered.', httpStatusCode: 500);
        }

        return ApiResponse::success([]);
    }
}
