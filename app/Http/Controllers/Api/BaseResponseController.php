<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * Class BaseResponseController
 */
class BaseResponseController extends Controller
{
    /**
     * General error response
     *
     * @param $message
     * @return mixed
     */
    public function responseWithError($message = 'error', $status = 422)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
        ], $status);
    }

    /**
     * General success response
     *
     * @param $message
     * @return mixed
     */
    public function responseWithSuccess($message = 'success', $data = '',  $status = 200)
    {
        return response()->json([
            'data'    => $data,
            'status'  => true,
            'message' => $message
        ], $status);
    }
}
