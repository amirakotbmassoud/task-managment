<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;



trait ResponseTrait{
    public static function success($status = 'success', $message = null, $data = [], $statusCode = 200)
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message, //ResponseHelper:: get($message,'en'),
                'data' => $data,
            ],
            $statusCode
        );
    }

    public static function error($status = 'error', $message = null, $statusCode = 400): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => $status,
                'message' => $message,
            ],
            $statusCode
        );
    }
}
