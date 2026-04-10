<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    // 📌 Danh sách + search + filter + N+1 fix
    public function index(Request $request)
    {
        $query = Course::with('lessons', 'enrollments')
                        ->withCount(['lessons', 'enrollments']);

        // search theo tên
        if ($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        // lọc trạng thái
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // lọc giá
        if ($request->min_price && $request->max_price) {
            $query->priceBetween($request->min_price, $request->max_price);
        }

        // sort
        if ($request->sort == 'price') {
            $query->orderBy('price');
        } elseif ($request->sort == 'students') {
            $query->orderByDesc('enrollments_count');
        } else {
            $query->latest();
        }

        $courses = $query->paginate(10);

        return view('courses.index', compact('courses'));
    }

    // 📌 Form create
    public function create()
    {
        return view('courses.create');
    }

    // 📌 Store

    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = \Str::slug($data['name']);

        // upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Thêm thành công');
    }

    // 📌 Edit
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    // 📌 Update
    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = \Str::slug($data['name']);

        if ($request->hasFile('image')) {

            // xóa ảnh cũ
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            // lưu ảnh mới
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Cập nhật thành công');
    }

    // 📌 Soft delete
    public function destroy($id)
    {
        Course::findOrFail($id)->delete();

        return back()->with('success', 'Đã xóa (soft delete)');
    }

    // 📌 Khôi phục
    public function restore($id)
    {
        Course::withTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'Khôi phục thành công');
    }

    // 📌 Dashboard
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = \App\Models\Student::count();
        $totalRevenue = Course::sum('price');

        $topCourse = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->first();

        $newCourses = Course::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalCourses',
            'totalStudents',
            'totalRevenue',
            'topCourse',
            'newCourses'
        ));
    }
}