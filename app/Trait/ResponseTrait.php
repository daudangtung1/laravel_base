<?php

namespace App\Trait;

use Illuminate\Http\Response;

trait ResponseTrait
{
    public function responseSuccess($data = null, $message = null)
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function responseCreatedSuccess($data = null, $message = null)
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function responseFail($message = null)
    {
        return response()->json([
            'status' => false,
            'code' => Response::HTTP_FORBIDDEN,
            'data' => null,
            'message' => $message,
        ]);
    }
}
