@extends('layouts.master')

@section('content')

<!-- Thêm FontAwesome cho icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Tùy chỉnh thêm để UI đẹp hơn */
    .course-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        transition: all 0.2s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    /* Card cho bảng */
    .main-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .card-header-custom {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 1.5rem;
    }
</style>

<div class="container-fluid px-4">
    
    <!-- Header & Action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">📚 Quản lý khóa học</h2>
            <p class="text-muted mb-0 small">Danh sách tất cả các khóa học và bài học</p>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Thêm mới
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card main-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control bg-light border-start-0" placeholder="Tìm kiếm tên khóa học...">
                    </div>
                </div>

                <div class="col-md-3 col-lg-2">
                    <select name="status" class="form-select bg-light">
                        <option value="">-- Trạng thái --</option>
                        <option value="draft" {{ request('status')=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ request('status')=='published'?'selected':'' }}>Published</option>
                    </select>
                </div>

                <div class="col-md-2 col-lg-2">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control bg-light" placeholder="Giá từ">
                </div>

                <div class="col-md-2 col-lg-2">
                    <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control bg-light" placeholder="Đến">
                </div>

                <div class="col-md-12 col-lg-3 d-flex gap-2">
                    <button class="btn btn-dark flex-grow-1"><i class="fas fa-filter me-1"></i> Lọc</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary" title="Reset">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card main-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Khóa học</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th class="text-center"><i class="fas fa-book-open text-muted"></i> Bài học</th>
                        <th class="text-center"><i class="fas fa-users text-muted"></i> Học viên</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    @if($course->image)
                                        <img src="{{ asset('storage/'.$course->image) }}" class="course-img" alt="Course">
                                    @else
                                        <div class="course-img bg-secondary d-flex align-items-center justify-content-center text-white">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold text-primary">{{ Str::limit($course->name, 40) }}</h6>
                                    <small class="text-muted">ID: #{{ $course->id }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="fw-bold text-dark">{{ number_format($course->price) }} đ</span>
                        </td>

                        <td>
                            @if($course->status == 'published')
                                <span class="badge bg-light-success text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                                    <i class="fas fa-check-circle me-1"></i> Published
                                </span>
                            @else
                                <span class="badge bg-light-secondary text-secondary border border-secondary border-opacity-25 px-3 py-2 rounded-pill">
                                    <i class="fas fa-pen me-1"></i> Draft
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <span class="badge bg-light-info text-info px-2 py-1 rounded">{{ $course->lessons_count }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light-primary text-primary px-2 py-1 rounded">{{ $course->enrollments_count }}</span>
                        </td>

                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center align-items-center gap-2">

                                <!-- Sửa -->
                                <a href="{{ route('courses.edit', $course->id) }}" 
                                class="btn btn-sm btn-light text-warning action-btn" title="Sửa khóa học">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Xóa -->
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light text-danger action-btn" 
                                            onclick="return confirm('Xóa khóa học này?')" 
                                            title="Xóa khóa học">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <!-- Thêm bài học -->
                                <a href="{{ route('lessons.create', ['course_id' => $course->id]) }}" 
                                class="btn btn-sm btn-light text-success action-btn" title="Thêm bài học">
                                    <i class="fas fa-plus"></i>
                                </a>

                                <!-- Ghi danh -->
                                <a href="{{ route('enrollments.create', ['course_id' => $course->id]) }}" 
                                class="btn btn-sm btn-light text-primary action-btn" title="Ghi danh học viên">
                                    <i class="fas fa-user-plus"></i>
                                </a>

                                <!-- DS bài học -->
                                <a href="{{ route('lessons.index', $course->id) }}" 
                                class="btn btn-sm btn-light text-info action-btn" title="Danh sách bài học">
                                    <i class="fas fa-book"></i>
                                </a>

                                <!-- DS học viên -->
                                <a href="{{ route('enrollments.index', $course->id) }}" 
                                class="btn btn-sm btn-light text-dark action-btn" title="Danh sách học viên">
                                    <i class="fas fa-users"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-box-open fa-3x mb-3"></i>
                                <p>Không tìm thấy khóa học nào.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <span class="text-muted small">Showing {{ $courses->count() }} results</span>
            {{ $courses->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- SweetAlert2 Confirm Delete --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Xóa khóa học này?',
            text: "Hành động này không thể hoàn tác. Dữ liệu bài học và học viên có thể bị ảnh hưởng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Vâng, xóa nó!',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
}); 
</script>

@endsection