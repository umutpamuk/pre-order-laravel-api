<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
trait ApiResponder
{
    /**
     * @param array $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse(array $data, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param string $error
     * @param int $code
     * @param array $data
     * @return JsonResponse
     */
    public function sendError(string $error, int $code = Response::HTTP_NOT_FOUND, array $data = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendSuccess(string $message = 'success', int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

}
