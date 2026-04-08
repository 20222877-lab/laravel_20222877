@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<h2>Dashboard</h2>

<p>Tổng nhân viên: {{ $totalEmp }}</p>
<p>Tổng phòng ban: {{ $totalDep }}</p>

<h3>Nhân viên mới</h3>

@foreach($newEmp as $e)
    <p>{{ $e->name }}</p>
@endforeach

@endsection