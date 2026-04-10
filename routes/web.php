<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ========================
// 📊 DASHBOARD
// ========================
Route::get('/', fn() => redirect()->route('dashboard'));
Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');


// ========================
// 📚 COURSES
// ========================
Route::resource('courses', CourseController::class);

// soft delete restore
Route::get('courses/{id}/restore', [CourseController::class, 'restore'])
    ->name('courses.restore');


// ========================
// 🎥 LESSONS
// ========================

// list lesson theo course
Route::get('courses/{course_id}/lessons', [LessonController::class, 'index'])
    ->name('lessons.index');

// CRUD lesson
Route::resource('lessons', LessonController::class)
    ->except(['index']);
    
Route::post('/api/update-order', function (\Illuminate\Http\Request $request) {
    foreach ($request->all() as $item) {
        \App\Models\Lesson::where('id', $item['id'])
            ->update(['order' => $item['order']]);
    }

    return response()->json(['success' => true]);
});

// ========================
// 🎓 ENROLLMENTS
// ========================

// list học viên theo course
Route::get('courses/{course_id}/enrollments', [EnrollmentController::class, 'index'])
    ->name('enrollments.index');

// CRUD enrollment
Route::resource('enrollments', EnrollmentController::class)
    ->except(['index']);