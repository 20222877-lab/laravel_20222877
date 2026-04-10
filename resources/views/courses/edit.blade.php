@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <!-- Hiển thị tên khóa học đang sửa để UX tốt hơn -->
                <h4 class="fw-bold mb-1 text-dark">Sửa: {{ $course->name }}</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Khóa học</a></li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">Chỉnh sửa</li>
                    </ol>
                </nav>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <div class="bg-white border rounded-3 p-4 shadow-sm">
                <!-- Lưu ý method('PUT') cho trang sửa -->
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @include('courses.form')

                    <div class="border-top mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a href="{{ route('courses.index') }}" class="btn btn-light border">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Cập nhật thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection