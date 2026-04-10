<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'price' => 'required|numeric|min:1',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'status' => 'required|in:draft,published'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khóa học không được bỏ trống',
            'price.required' => 'Giá là bắt buộc',
            'price.min' => 'Giá phải lớn hơn 0',
            'image.image' => 'File phải là hình ảnh',
            'status.in' => 'Trạng thái không hợp lệ'
        ];
    }
}