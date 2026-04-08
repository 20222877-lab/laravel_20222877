<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head> 
<body>

<h1>QUẢN LÝ NHÂN SỰ</h1>

<a href="/departments">Phòng ban</a> |
<a href="/employees">Nhân viên</a> |
<a href="/dashboard">Dashboard</a>

<hr>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if(session('error'))
    <x-alert type="error" :message="session('error')" />
@endif

@yield('content')

</body>
</html>