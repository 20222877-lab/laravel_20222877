<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Course Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f1f2f6;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #2f3640, #353b48);
            color: #fff;
            padding: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #dcdde1;
            display: block;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #40739e;
            transform: translateX(5px);
        }

        .main {
            margin-left: 260px;
            padding: 25px;
        }

        .card-stat {
            border: none;
            border-radius: 16px;
            color: #fff;
            padding: 20px;
            transition: 0.3s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .bg1 { background: linear-gradient(45deg, #4facfe, #00f2fe); }
        .bg2 { background: linear-gradient(45deg, #43e97b, #38f9d7); }
        .bg3 { background: linear-gradient(45deg, #fa709a, #fee140); }
        .bg4 { background: linear-gradient(45deg, #a18cd1, #fbc2eb); }

        .card-course {
            border-radius: 16px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card-course:hover {
            transform: scale(1.03);
        }

        .badge-status {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 20px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
    </script>
    @endif
</head>

<body>

<div class="sidebar">
    <h4>📘 CMS</h4>
    <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
    <a href="{{ route('courses.index') }}"><i class="fa fa-book"></i> Courses</a>
    <a href="{{ route('lessons.create') }}"><i class="fa fa-video"></i> Lessons</a>
    <a href="{{ route('enrollments.create') }}"><i class="fa fa-user"></i> Enrollments</a>
</div>

<div class="main">

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>