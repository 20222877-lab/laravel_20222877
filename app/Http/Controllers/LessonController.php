<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    // danh sách theo course
    public function index($course_id)
    {
        $course = Course::with(['lessons' => function ($q) {
            $q->orderBy('order');
        }])->findOrFail($course_id);

        return view('lessons.index', compact('course'));
    }

    public function create(Request $request)
    {
        $courses = \App\Models\Course::all();

        $selectedCourse = $request->course_id;

        return view('lessons.create', compact('courses', 'selectedCourse'));
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());

        return back()->with('success', 'Thêm bài học thành công');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all();

        return view('lessons.edit', compact('lesson', 'courses'));
    }

    public function update(LessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $lesson->update($request->validated());

        return back()->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();

        return back()->with('success', 'Đã xóa bài học');
    }
}