<h1>Thêm nhân viên</h1>

<form method="POST" action="{{ route('employees.store') }}">
    @csrf

    <input name="name" placeholder="Tên">
    <input name="email" placeholder="Email">
    <input name="position" placeholder="Chức vụ">

    <select name="department_id">
        <option disable>-- Chọn phòng ban --</option>

        @forelse($departments as $d)
            <option value="{{ $d->id }}">{{ $d->name }}</option>
        @empty
            <option value="">Không có phòng ban nào</option>
        @endforelse
    </select>

    <button type="submit">Save</button>
</form>