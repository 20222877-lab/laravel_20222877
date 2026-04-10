<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'status'
    ];

    // 1 course có nhiều lesson
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // 1 course có nhiều enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // many-to-many qua bảng enrollments
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    // 🔥 Scope published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // 🔥 Scope price between
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}