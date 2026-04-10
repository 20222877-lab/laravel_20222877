<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',

            'title' => 'required|string|max:255',

            'content' => 'nullable|string',

            'video_url' => 'nullable|url',

            'order' => 'nullable|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Phải chọn khóa học',
            'course_id.exists' => 'Khóa học không tồn tại',
            'title.required' => 'Tiêu đề không được để trống',
            'video_url.url' => 'Link video không hợp lệ'
        ];
    }
}