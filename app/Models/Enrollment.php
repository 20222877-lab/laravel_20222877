<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'course_id',
        'student_id'
    ];

    // thuộc course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // thuộc student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}