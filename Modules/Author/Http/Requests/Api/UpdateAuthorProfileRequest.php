<?php

namespace Modules\Author\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAuthorProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $authorId = auth('author')->id();

        return [
            'full_name'        => ['sometimes', 'required', 'string', 'max:200'],
            'username'         => ['sometimes', 'required', 'string', 'max:100', "unique:authors,username,{$authorId}"],
            'bio'              => ['nullable', 'string'],
            'avatar'           => ['nullable', 'string', 'max:500'],
            'email'            => ['nullable', 'email', 'max:255'],
            'website_url'      => ['nullable', 'url', 'max:500'],
            'location'         => ['nullable', 'string', 'max:255'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'password'         => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique'      => 'Username đã được sử dụng.',
            'password.confirmed'   => 'Xác nhận mật khẩu không khớp.',
            'password.min'         => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
        ];
    }

    /**
     * Return JSON error response instead of redirect for API requests.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => false,
                'code'    => 422,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
