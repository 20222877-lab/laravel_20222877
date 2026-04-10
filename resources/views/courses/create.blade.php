@extends('layouts.master')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <!-- Tiêu đề trang & Nút quay lại -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-plus-circle me-2 text-primary"></i>Thêm khóa học
                </h2>
                <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>

            <!-- Form Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
                        @csrf
                        
                        <!-- Gọi partial form của bạn -->
                        @include('courses.form')

                        <!-- Dấu ngăn cách -->
                        <hr class="my-4">

                        <!-- Khu vực nút bấm -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('courses.index') }}" class="btn btn-light border text-secondary">
                                Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check2-circle me-1"></i> Lưu khóa học
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Tùy chỉnh nhẹ cho các input bên trong courses.form để đồng bộ với Card */
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
        border-color: #0d6efd;
    }
</style>
@endsection