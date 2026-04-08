@extends('layouts.master')

@section('title', 'Quản lý nhân viên')

@section('content')
<h2>Danh sách nhân viên</h2>

@forelse($employees as $e)
    <p>
        {{ $e->name }} - {{ $e->email }} 
        ({{ $e->department->name ?? '' }})
    </p>
@empty
    <p>Không có nhân viên nào.</p>
@endforelse

@endsection 