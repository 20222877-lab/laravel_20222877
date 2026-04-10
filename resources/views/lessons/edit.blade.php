@extends('layouts.master')

@section('content')

<h2>✏️ Cập nhật bài học</h2>

<form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
    @csrf @method('PUT')

    @include('lessons.form', ['lesson' => $lesson])

    <button class="btn btn-primary btn-submit">Cập nhật</button>
</form>

@endsection