@extends('layout.master')

@section('title','Trang chủ')

@section('content')

<h2>Chào mừng đến hệ thống quản lý sản phẩm</h2>

<p>
    Đây là project Laravel sử dụng:
</p>

<ul>
    <li>Eloquent ORM</li>
    <li>MVC</li>
    <li>CRUD</li>
    <li>Blade Template</li>
</ul>

<a href="{{ route('products.index') }}">Đi tới danh sách sản phẩm</a>

@endsection