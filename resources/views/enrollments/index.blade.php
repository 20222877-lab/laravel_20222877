@extends('layouts.master')

@section('content')

<h2 class="mb-3">🎓 Học viên - {{ $course->name }}</h2>

<a href="{{ route('enrollments.create') }}" class="btn btn-success mb-3">
    + Đăng ký học
</a>

<div class="mb-2">
    <strong>Tổng học viên:</strong> {{ $course->enrollments_count }}
</div>

<table class="table table-hover shadow-sm align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Email</th>
            <th width="150">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($course->enrollments as $enrollment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $enrollment->student->name }}</td>
            <td>{{ $enrollment->student->email }}</td>

            <td>
                <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                      method="POST" class="d-inline delete-form">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm btn-delete">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Confirm delete --}}
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.onclick = function () {
        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Xóa đăng ký?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa'
        }).then(r => {
            if (r.isConfirmed) form.submit();
        });
    }
});
</script>

@endsection