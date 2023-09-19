<?php

namespace App\Http\Controllers;

const RESPONSE_STATUS_SUCCESS = 1;
const RESPONSE_STATUS_FAIL = 0;

const HTTP_CODE_SUCCESS = 200;
const HTTP_CODE_UNAUTHORIZED = 401;
const HTTP_CODE_UNPROCESSABLE = 422;

trait ApiResponseTrait
{
    protected function responseJsonSuccess($data = [], $message = null)
    {
        return response(
            [
                'status' => RESPONSE_STATUS_SUCCESS,
                'message' => $message,
                'data' => $data
            ]
        );
    }

    protected function responseJsonFail($message = '', $httpCode = HTTP_CODE_SUCCESS, $errors = [])
    {
        $this->transactionStop();
        return response(
            [
                'status' => RESPONSE_STATUS_FAIL,
                'message' => $message == false ? __("Error") : $message,
            ],
            $httpCode
        );
    }

    protected function responseJsonFailMultipleErrors($errors = [], $message = '', $httpCode = HTTP_CODE_UNPROCESSABLE)
    {
        $this->transactionStop();
        return response(
            [
                'status' => RESPONSE_STATUS_FAIL,
                'message' => $message,
                'errors' => $errors,
            ],
            $httpCode
        );
    }
}
