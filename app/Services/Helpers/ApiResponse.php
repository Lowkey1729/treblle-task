<?php

namespace App\Services\Helpers;

use App\Services\Enums\ApiResponse as ApiResponseEnum;
use Illuminate\Http\JsonResponse;

final class ApiResponse
{
    /**
     * @param array<string, mixed>|object $data
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public static function success(
        array|object $data,
        int $httpStatusCode = 200
    ): JsonResponse {
        return response()->json([
            'status' => ApiResponseEnum::SUCCESS->value,
            'data' => $data,
            'errorMessage' => null,
            'errors' => [],
        ], $httpStatusCode);
    }

    /**
     * @param string $errorMessage
     * @param array<string, mixed> $data
     * @param array<string, mixed> $errors
     * @param array<string, mixed> $errorTrace
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public static function failed(
        string $errorMessage,
        array  $data = [],
        array  $errors = [],
        array  $errorTrace = [],
        int    $httpStatusCode = 200
    ): JsonResponse {
        return response()->json([
            'status' => ApiResponseEnum::FAILED->value,
            'data' => $data,
            'errorMessage' => $errorMessage,
            'errors' => $errors,
            'trace' => $errorTrace,
        ], $httpStatusCode);
    }
}
