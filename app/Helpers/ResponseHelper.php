<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(bool $success = true, string $message = "Successful", array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json(
            ['success' => $success, 'message' => $message, 'data' => $data], $statusCode
        );
    }

    public static function error(bool $success = false, string $message = "Internal server error", int $statusCode = 500): JsonResponse
    {
        return response()->json(
            ['success' => $success, 'message' => $message], $statusCode
        );
    }
}
