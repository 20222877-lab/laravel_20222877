@extends('layouts.master')

@section('title', 'Quản lý phòng ban')

@section('content')
<h2>Danh sách phòng ban</h2>

@forelse($departments as $d)
    <p>{{ $d->name }}</p>
@empty
    <p>Không có phòng ban nào.</p>
@endforelse

@endsection