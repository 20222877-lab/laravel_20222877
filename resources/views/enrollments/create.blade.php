@extends('layouts.master')

@section('content')

<h2>➕ Đăng ký khóa học</h2>

<form action="{{ route('enrollments.store') }}" method="POST">
    @csrf

    @include('enrollments.form')

    <button class="btn btn-success btn-submit">Đăng ký</button>
</form>

@endsection