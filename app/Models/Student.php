<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];

    // 1 student có nhiều enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // many-to-many với course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}