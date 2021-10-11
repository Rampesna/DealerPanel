<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Response
{
    /**
     * Core of response
     *
     * @param string $message
     * @param array|object $data
     * @param integer $statusCode
     * @param boolean $isSuccess
     */
    public function coreResponse($message, $statusCode, $data = null, $isSuccess = true)
    {
        // Check the params
        if (!$message) return response()->json(['message' => 'Message is required'], 500);

        return response()->json([
            'message' => $message,
            'error' => false,
            'code' => $statusCode,
            'response' => $data
        ], $statusCode);
    }

    /**
     * Send any success response
     *
     * @param string $message
     * @param array|object|int $data
     * @param integer $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $statusCode, $data);
    }

    /**
     * Send any error response
     *
     * @param string $message
     * @param integer $statusCode
     */
    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, $statusCode, null, false);
    }
}
