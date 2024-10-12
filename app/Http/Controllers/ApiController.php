<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    public function respond($message, $code = 200, $data = []): JsonResponse
    {
        $response = [
            'message' => $message,
            'code' => $code,
        ];

        if ((bool) $data) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function success(array $data = [], int $code = 200, string $message = ''): JsonResponse
    {
        return $this->respond($message, $code, $data);
    }

    public function error($code = 422, $data = [], $message = 'Something went wrong! Please try again.'): JsonResponse
    {
        $response = [
            'message' => $message,
            'type' => 'error',
            'code' => $code,
        ];

        if ((bool) $data) {
            $response['errors'] = $data;
        }

        return response()->json($response, $code);
    }
}
