@extends('layouts.master')

@section('content')

<h2 class="mb-4">📊 Dashboard Overview</h2>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card-stat bg1">
            <h6><i class="fa fa-book"></i> Khóa học</h6>
            <h2>{{ $totalCourses }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg2">
            <h6><i class="fa fa-users"></i> Học viên</h6>
            <h2>{{ $totalStudents }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg3">
            <h6><i class="fa fa-dollar-sign"></i> Doanh thu</h6>
            <h2>{{ number_format($totalRevenue) }} đ</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg4">
            <h6><i class="fa fa-star"></i> Top khóa học</h6>
            <h5>{{ $topCourse->name ?? 'N/A' }}</h5>
            <small>{{ $topCourse->enrollments_count ?? 0 }} học viên</small>
        </div>
    </div>

</div>

<hr class="my-4">

<h4 class="mb-3">🆕 Khóa học mới</h4>

<div class="row g-4">

    @foreach($newCourses as $course)
    <div class="col-md-3">
        <div class="card card-course shadow-sm">

            @if($course->image)
                <img src="{{ asset('storage/'.$course->image) }}" height="150" style="object-fit:cover;">
            @endif

            <div class="p-3">
                <h6>{{ $course->name }}</h6>

                <p class="text-muted mb-1">
                    {{ number_format($course->price) }} đ
                </p>

                <span class="badge badge-status 
                    {{ $course->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $course->status }}
                </span>
            </div>

        </div>
    </div>
    @endforeach

</div>

@endsection