<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Log;

trait ApiResponseTrait
{
    /**
     * Wrap code in a try-catch and return JSON response.
     *
     * @param callable $callback
     * @param string $successMessage
     * @return JsonResponse
     */
    public function handleApi(callable $callback, string $successMessage = 'Operation successful'): JsonResponse
    {
        try {
            $data = $callback();

            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            Log::error('API error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Operation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
