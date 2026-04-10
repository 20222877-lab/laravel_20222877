<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Http\Requests\EnrollmentRequest;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // danh sách học viên theo course
    public function index($course_id)
    {
        $course = Course::with(['enrollments.student'])
            ->withCount('enrollments')
            ->findOrFail($course_id);

        return view('enrollments.index', compact('course'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();

        $selectedCourse = $request->course_id;

        return view('enrollments.create', compact('courses', 'selectedCourse'));
    }

    public function store(EnrollmentRequest $request)
    {
        $data = $request->validated();

        // tránh trùng student
        $student = Student::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name']]
        );

        // tránh đăng ký trùng
        Enrollment::firstOrCreate([
            'course_id' => $data['course_id'],
            'student_id' => $student->id
        ]);

        return back()->with('success', 'Đăng ký thành công');
    }

    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();

        return back()->with('success', 'Đã xóa đăng ký');
    }
}