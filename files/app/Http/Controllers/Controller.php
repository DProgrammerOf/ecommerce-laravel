<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * Default format of response to requests
     * @param bool $status
     * @param $message
     * @param int $code
     * @param array|null $obj
     * @return JsonResponse
     */
    protected function to_response(bool $status, $message, int $code = 200, mixed $obj = null): JsonResponse
    {
        return response()->json([
            'success' => $status,
            'message' => $message,
            'data' => $obj
        ], $code);
    }
}
