@extends('layouts.master')
@section('content')
@php
    // Khai báo biến đếm để dùng cho SortableJS fallback
    $count = 0;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 fs-6">
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Khóa học</a></li>
                <li class="breadcrumb-item active">{{ $course->name }}</li>
            </ol>
        </nav>
        <h4 class="mb-0 fw-bold text-dark">Quản lý bài học</h4>
    </div>
    
    <a href="{{ route('lessons.create') }}" class="btn btn-primary shadow-sm px-4 py-2">
        <i class="bi bi-plus-lg me-1"></i> Thêm bài học
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th width="50" class="border-0 ps-4"></th> <!-- Drag Handle Column -->
                    <th class="border-0 ps-0">Tiêu đề bài học</th>
                    <th width="100" class="border-0 text-center">Video</th>
                    <th width="120" class="border-0 text-center pe-4">Thao tác</th>
                </tr>
            </thead>

            <tbody id="sortable" class="custom-sortable">
                @forelse($course->lessons->sortBy('order') as $lesson)
                <tr data-id="{{ $lesson->id }}" class="sort-item">
                    <td class="ps-4">
                        <div class="drag-handle text-secondary" title="Kéo để sắp xếp">
                            <i class="bi bi-grip-vertical fs-5"></i>
                        </div>
                    </td>

                    <td class="ps-0">
                        <span class="fw-semibold text-dark">{{ $lesson->title }}</span>
                    </td>

                    <td class="text-center">
                        @if($lesson->video_url)
                            <button class="btn btn-sm btn-outline-primary rounded-circle p-0 btn-preview d-inline-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;"
                                data-url="{{ $lesson->video_url }}" title="Xem trước video">
                                <i class="bi bi-play-fill fs-6"></i>
                            </button>
                        @else
                            <span class="text-muted small">Chưa có</span>
                        @endif
                    </td>

                    <td class="text-center pe-4">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('lessons.edit', $lesson->id) }}"
                               class="btn btn-sm btn-outline-secondary rounded-1 p-0 d-inline-flex align-items-center justify-content-center"
                               style="width: 32px; height: 32px;" title="Chỉnh sửa">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('lessons.destroy', $lesson->id) }}"
                                  method="POST" class="delete-form m-0">
                                @csrf @method('DELETE')
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-1 p-0 d-inline-flex align-items-center justify-content-center btn-delete"
                                    style="width: 32px; height: 32px;" title="Xóa bài học">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 border-0">
                        <div class="text-muted">
                            <i class="bi bi-camera-video-off fs-1 d-block mb-2"></i>
                            <p class="mb-0 fw-medium">Khóa học chưa có bài học nào.</p>
                            <a href="{{ route('lessons.create') }}" class="btn btn-link text-primary p-0 mt-1">Thêm bài học đầu tiên</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal preview --}}
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content overflow-hidden rounded-3 shadow">
            <div class="modal-header bg-dark text-white border-0 py-2">
                <h6 class="modal-title fw-semibold">Xem trước video</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-black">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS for UX --}}
<style>
    /* Style cho Drag Handle */
    .drag-handle {
        cursor: grab;
        opacity: 0.4;
        transition: all 0.2s ease;
    }
    .drag-handle:hover {
        opacity: 1;
        color: #0d6efd !important;
    }
    
    /* Chỉ số chuột khi đang kéo */
    .sortable-ghost .drag-handle {
        cursor: grabbing;
        opacity: 1;
    }
    
    /* Đổ bóng khi kéo thả */
    .sortable-ghost {
        background-color: #f8f9fa !important;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-left: 3px solid #0d6efd !important;
    }
    .sortable-chosen {
        background-color: #e9ecef !important;
    }

    /* Hiệu ứng hover cho dòng bảng */
    .sort-item {
        transition: all 0.15s ease-in-out;
    }
    .sort-item:hover {
        background-color: #f8f9fa !important;
    }

    /* Hover Effect cho Action Buttons */
    .btn-outline-secondary:hover, .btn-outline-danger:hover, .btn-outline-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>

{{-- JS & Libraries --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoModalEl = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    let videoModalInstance = new bootstrap.Modal(videoModalEl);

    // 1. Preview Video
    document.querySelectorAll('.btn-preview').forEach(btn => {
        btn.onclick = function() {
            videoFrame.src = this.dataset.url;
            videoModalInstance.show();
        }
    });

    // FIX UX: Dừng video khi đóng modal để tiếng không bị chạy ngầm
    videoModalEl.addEventListener('hidden.bs.modal', function () {
        videoFrame.src = '';
    });

    // 2. Confirm Delete
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.onclick = function() {
            let form = this.closest('.delete-form');
            Swal.fire({
                title: 'Xóa bài học này?',
                text: 'Hành động này không thể hoàn tác.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then(r => {
                if (r.isConfirmed) form.submit();
            });
        }
    });

    // 3. Drag Reorder (Thêm handle để không nhầm với click nút)
    const sortEl = document.getElementById('sortable');
    if (sortEl) {
        new Sortable(sortEl, {
            animation: 200,
            handle: '.drag-handle', // Rất quan trọng cho UX
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onEnd: function () {
                let ids = [];
                document.querySelectorAll('#sortable tr[data-id]').forEach((row, index) => {
                    ids.push({
                        id: row.dataset.id,
                        order: index + 1
                    });
                });

                // Gửi API cập nhật thứ tự
                fetch('/api/update-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(ids)
                }).then(res => {
                    if(res.ok) {
                        // Optional: Show small success toast ở đây nếu muốn
                    }
                });
            }
        });
    }
});
</script>

@endsection