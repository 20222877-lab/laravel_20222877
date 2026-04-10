{{-- Input Tên khóa học --}}
<div class="mb-3">
    <label for="name" class="form-label fw-semibold">Tên khóa học <span class="text-danger">*</span></label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
           value="{{ old('name', $course->name ?? '') }}" placeholder="Nhập tên khóa học...">
    @error('name')
        <div class="invalid-feedback d-flex align-items-center">
            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Giá (Thêm input-group cho đẹp) --}}
<div class="mb-3">
    <label for="price" class="form-label fw-semibold">Giá khóa học</label>
    <div class="input-group">
        <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" 
               value="{{ old('price', $course->price ?? '') }}" placeholder="0" min="0">
        <span class="input-group-text bg-light fw-medium">VNĐ</span>
    </div>
    @error('price')
        <div class="text-danger small mt-1 d-flex align-items-center">
            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
        </div>
    @enderror
</div>

{{-- Textarea Mô tả (Fix chiều cao mặc định) --}}
<div class="mb-3">
    <label for="description" class="form-label fw-semibold">Mô tả</label>
    <textarea id="description" name="description" class="form-control" rows="4" 
              placeholder="Mô tả ngắn gọn về khóa học...">{{ old('description', $course->description ?? '') }}</textarea>
</div>

{{-- Upload Ảnh (Cải thiện vùng preview) --}}
<div class="mb-3">
    <label for="imageInput" class="form-label fw-semibold">Ảnh đại diện</label>
    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
    
    <div class="mt-3" id="previewWrapper" style="display: {{ !empty($course->image) ? 'block' : 'none' }};">
        <span class="small text-muted">Xem trước:</span>
        <div class="border rounded-3 p-2 d-inline-block bg-light mt-1">
            <img id="previewImage"
                 src="{{ !empty($course->image) ? asset('storage/'.$course->image) : '' }}"
                 class="img-fluid rounded"
                 style="width: 150px; height: 100px; object-fit: cover;">
        </div>
    </div>
</div>

{{-- Select Trạng thái --}}
<div class="mb-3">
    <label for="status" class="form-label fw-semibold">Trạng thái</label>
    <select id="status" name="status" class="form-select">
        <option value="draft" {{ (old('status', $course->status ?? '') == 'draft') ? 'selected' : '' }}>Draft (Nháp)</option>
        <option value="published" {{ (old('status', $course->status ?? '') == 'published') ? 'selected' : '' }}>Published (Công khai)</option>
    </select>
</div>

{{-- Scripts (Dùng @once để tránh trùng lặp code nếu form bị include nhiều lần) --}}
@once
<script>
    // 1. Xử lý Preview Ảnh
    document.getElementById('imageInput')?.addEventListener('change', function(e) {
        const wrapper = document.getElementById('previewWrapper');
        const preview = document.getElementById('previewImage');
        
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                wrapper.style.display = 'block'; // Hiện khung preview khi chọn ảnh mới
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            wrapper.style.display = 'none'; // Ẩn nếu người dùng bấm "xóa" trong input file
        }
    });

    // 2. Xử lý Loading Button (Tìm nút submit bất kỳ trong form)
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            // Tìm thẻ button có type="submit" (không dựa vào class cứng nữa)
            let btn = form.querySelector('button[type="submit"]');
            if (btn) {
                // Thêm Spinner của Bootstrap vào thay vì chỉ đổi text
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang lưu...';
                btn.disabled = true;
                btn.classList.add('disabled');
            }
        });
    });
</script>
@endonce