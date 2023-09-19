<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\AppMain\Config\AppConst;

class CreateFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $data = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json([
            'data' => false,
            'message' => $data,
            'status' => AppConst::RESPONSE_STATUS_FAIL,
        ]));
    }
}
