<?php

namespace App\Http\Controllers;

trait ApiResponseTrait
{
    protected function responseSuccess($data = [], $message = null)
    {
        return response([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function responseFail($message = null)
    {
        return response([
            'status' => 200,
            'message' => $message,
        ]);
    }
}
