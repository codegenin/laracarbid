<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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
            'data' => ''
        ], $status);
    }

    /**
     * General success response
     *
     * @param $message
     * @return mixed
     */
    public function responseWithSuccess($data = '', $message = 'success',  $status = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $status);
    }
}
