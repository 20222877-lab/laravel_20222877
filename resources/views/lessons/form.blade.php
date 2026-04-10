{{-- Bọc lại bằng thẻ Form (thay action/function tương ứng của bạn) --}}
<form method="POST" action="{{ isset($lesson) ? route('lessons.update', $lesson->id) : route('lessons.store') }}" class="mt-4">
    @csrf
    @method(isset($lesson) ? 'PUT' : 'POST')

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-journal-text me-2 text-primary"></i>
                {{ isset($lesson) ? 'Chỉnh sửa bài học' : 'Thêm bài học mới' }}
            </h5>
            <p class="text-muted small mb-0">Điền thông tin chi tiết cho bài học của bạn.</p>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Cột trái: Thông tin chính --}}
                <div class="col-lg-6">
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Thuộc khóa học <span class="text-danger">*</span></label>
                        <select name="course_id" class="form-select py-2 border-0 bg-light shadow-none" required>
                            <option value="" disabled selected>--- Chọn khóa học ---</option>
                            @foreach($courses as $c) 
                            <option value="{{ $c->id }}"
                                {{ old('course_id', $lesson->course_id ?? $selectedCourse ?? '') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Tiêu đề bài học <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control py-2 border-0 bg-light shadow-none"
                            value="{{ old('title', $lesson->title ?? '') }}" 
                            placeholder="Ví dụ: Giới thiệu khóa học" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark">Thứ tự hiển thị</label>
                        <div class="input-group input-group-sm" style="max-width: 150px;">
                            <input type="number" name="order" class="form-control border-0 bg-light shadow-none text-center" min="0"
                                value="{{ old('order', $lesson->order ?? 0) }}">
                        </div>
                        <div class="form-text">Để trống hoặc nhập 0 sẽ tự động thêm vào cuối danh sách.</div>
                    </div>

                </div>

                {{-- Cột phải: Media (Video) --}}
                <div class="col-lg-6">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Video URL (YouTube, Vimeo...)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-primary">
                                <i class="bi bi-link-45deg"></i>
                            </span>
                            <input type="url" id="videoInput" name="video_url" 
                                class="form-control py-2 border-0 bg-light shadow-none"
                                value="{{ old('video_url', $lesson->video_url ?? '') }}"
                                placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>

                    {{-- Khu vực Preview Video được làm lại hoàn toàn --}}
                    <div id="previewContainer" class="position-relative rounded-3 overflow-hidden bg-dark" style="height: 220px;">
                        
                        <!-- Trạng thái Placeholder khi chưa có video -->
                        <div id="videoPlaceholder" class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white-50">
                            <i class="bi bi-camera-video-off fs-1 mb-2"></i>
                            <span class="small">Nhập URL video để xem trước</span>
                        </div>

                        <!-- Iframe ẩn ban đầu, chỉ hiện khi có URL hợp lệ -->
                        <iframe id="videoPreview"
                            class="w-100 h-100 position-absolute top-0 start-0"
                            src=""
                            style="display: none; border: none;"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-top-0 px-4 py-3 d-flex justify-content-end gap-2">
            <a href="{{ isset($lesson) ? route('lessons.index') : back()->getTargetUrl() }}" class="btn btn-light border px-4">
                Hủy
            </a>
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-check-lg me-1"></i> 
                {{ isset($lesson) ? 'Cập nhật' : 'Tạo bài học' }}
            </button>
        </div>
    </div>
</form>

{{-- Custom Style cho Input Focus --}}
<style>
    /* Hiệu ứng viền sáng khi focus vào input (thay viền xanh mặc định) */
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
        background-color: #fff !important;
    }
    /* Hiệu ứng fade mượt mà cho iframe */
    #videoPreview {
        transition: opacity 0.3s ease-in-out;
    }
</style>

{{-- JS xử lý Video Preview --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoInput = document.getElementById('videoInput');
    const videoPreview = document.getElementById('videoPreview');
    const videoPlaceholder = document.getElementById('videoPlaceholder');
    
    // Biến lưu trữ hàm timeout để chống spam request (Debounce)
    let typingTimer;                
    const doneTypingInterval = 800; // Thời gian chờ (ms) sau khi người dùng ngừng gõ

    if (videoInput) {
        videoInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            const url = this.value.trim();

            if (!url) {
                // Nếu xóa hết URL -> hiện lại Placeholder, ẩn iframe
                videoPreview.style.display = 'none';
                videoPreview.src = '';
                videoPlaceholder.style.display = 'flex';
            } else {
                // Nếu đang gõ -> hiện trạng thái "Đang tải..."
                videoPlaceholder.innerHTML = `
                    <div class="spinner-border text-primary" role="status" style="width: 2rem; height: 2rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="small mt-2">Đang tải video...</span>
                `;
                
                // Chờ người dùng ngừng gõ 800ms rồi mới set src cho iframe
                typingTimer = setTimeout(() => {
                    videoPreview.src = url;
                    videoPreview.style.display = 'block';
                    videoPlaceholder.style.display = 'none';
                }, doneTypingInterval);
            }
        });

        // Trigger lần đầu khi mở form sửa (nếu đã có video_url)
        const initialUrl = videoInput.value.trim();
        if (initialUrl) {
            videoPreview.src = initialUrl;
            videoPreview.style.display = 'block';
            videoPlaceholder.style.display = 'none';
        }
    }
});
</script>