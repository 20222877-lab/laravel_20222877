<div class="mb-3">
    <label>Khóa học</label>
    <select name="course_id" class="form-control">
        @foreach($courses as $c)
        <option value="{{ $c->id }}"
            {{ old('course_id', $selectedCourse ?? '') == $c->id ? 'selected' : '' }}>
            {{ $c->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tên học viên</label>
    <input type="text" name="name" class="form-control"
        value="{{ old('name') }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
        value="{{ old('email') }}">
    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- Loading --}}
<script>
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function () {
        let btn = form.querySelector('.btn-submit');
        if (btn) {
            btn.innerHTML = 'Đang xử lý...';
            btn.disabled = true;
        }
    });
});
</script>