<?php

namespace Modules\Author\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('author_type');

        return [
            'name'        => ['required', 'string', 'max:100', "unique:author_types,name,{$id}"],
            'code'        => ['required', 'string', 'max:50', "unique:author_types,code,{$id}", 'alpha_dash'],
            'description' => ['nullable', 'string'],
            'color_hex'   => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'is_active'   => ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique'       => 'Tên loại tác giả đã tồn tại.',
            'code.unique'       => 'Mã loại tác giả đã tồn tại.',
            'code.alpha_dash'   => 'Mã chỉ được chứa chữ cái, số, gạch ngang và gạch dưới.',
            'color_hex.regex'   => 'Màu sắc phải theo định dạng hex (#RRGGBB).',
        ];
    }
}
