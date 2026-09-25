<?php

namespace Modules\Author\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username'          => ['required', 'string', 'max:100', 'unique:authors,username'],
            'full_name'         => ['required', 'string', 'max:200'],
            'bio'               => ['nullable', 'string'],
            'avatar'            => ['nullable', 'string', 'max:500'],
            'email'             => ['nullable', 'email', 'max:255'],
            'website_url'       => ['nullable', 'url', 'max:500'],
            'location'          => ['nullable', 'string', 'max:255'],
            'is_active'         => ['boolean'],
            'published_at'      => ['nullable', 'date'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string'],
            'author_type_ids'   => ['nullable', 'array'],
            'author_type_ids.*' => ['integer', 'exists:author_types,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique'         => 'Username này đã được sử dụng.',
            'author_type_ids.*.exists'=> 'Loại tác giả không hợp lệ.',
        ];
    }
}
