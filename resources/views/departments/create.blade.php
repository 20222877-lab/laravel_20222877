<h1>Thêm phòng ban</h1>

<form method="POST" action="{{ route('departments.store') }}">
    @csrf
    <input name="name" placeholder="Tên phòng ban">
    <textarea name="description"></textarea>
    <button type="submit">Save</button>
</form>