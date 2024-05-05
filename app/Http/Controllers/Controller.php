<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function sendResponse($result, $message)
    {
        $response = [
            'error' => false,
            'code' => 200,
            'message' => $message,
            'requestedAt' => date('Y-m-d H:i:s'),
            'responseAt' => date('Y-m-d H:i:s'),
            'data'    => $result,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'error' => false,
            'code' => $code,
            'message' => $error,
            'requestedAt' => date('Y-m-d H:i:s'),
            'responseAt' => date('Y-m-d H:i:s'),
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
