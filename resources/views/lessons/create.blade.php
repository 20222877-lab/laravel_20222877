@extends('layouts.master')

@section('content')

<h2>➕ Thêm bài học</h2>

<form action="{{ route('lessons.store') }}" method="POST">
    @csrf

    @include('lessons.form')

    <button class="btn btn-success btn-submit">Lưu</button>
</form>

@endsection