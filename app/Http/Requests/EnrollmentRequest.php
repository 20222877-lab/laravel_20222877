<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Vui lòng chọn khóa học',
            'course_id.exists' => 'Khóa học không hợp lệ',
            'name.required' => 'Tên học viên không được để trống',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ'
        ];
    }
}