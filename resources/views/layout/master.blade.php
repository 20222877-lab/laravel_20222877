<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-50:  #f0faf4;
            --green-100: #d9f2e3;
            --green-200: #b3e5c8;
            --green-300: #6ecf9a;
            --green-400: #3db870;
            --green-500: #22a05b;
            --green-600: #178247;
            --green-700: #115e34;
            --sidebar-bg: #0f2318;
            --sidebar-hover: #1a3828;
            --sidebar-active: #1e4a31;
            --gray-50:  #f8faf9;
            --gray-100: #eef1ee;
            --gray-200: #dde3dd;
            --gray-400: #8fa894;
            --gray-600: #4a5e50;
            --gray-800: #1e2d23;
            --shadow-sm: 0 1px 3px rgba(34,160,91,.08);
            --shadow-md: 0 4px 16px rgba(34,160,91,.10), 0 2px 6px rgba(0,0,0,.06);
            --radius: 12px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            margin: 0;
            min-height: 100vh;
        }

        /* ── Layout ── */
        .admin-layout { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            padding: 0;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0,0,0,.18);
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--green-400), var(--green-600));
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .brand-icon svg { width:18px; height:18px; color:#fff; }

        .brand-name {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.01em;
        }

        .brand-sub {
            font-size: .7rem;
            color: var(--green-300);
            font-weight: 400;
            margin-top: 1px;
        }

        .sidebar-nav {
            padding: 1rem .75rem;
            flex: 1;
        }

        .nav-section-label {
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255,255,255,.3);
            padding: .75rem .5rem .4rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .6rem .75rem;
            border-radius: 8px;
            color: rgba(255,255,255,.65);
            font-size: .875rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 2px;
            transition: background .15s, color .15s;
            position: relative;
        }

        .nav-link svg { width:16px; height:16px; flex-shrink:0; }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: var(--green-300);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--green-400);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-footer {
            padding: 1rem .75rem;
            border-top: 1px solid rgba(255,255,255,.07);
            font-size: .75rem;
            color: rgba(255,255,255,.3);
            text-align: center;
        }

        /* ── Main area ── */
        .main-area {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--green-100);
            padding: .875rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
            box-shadow: 0 1px 4px rgba(34,160,91,.06);
        }

        .topbar-title {
            font-size: .9rem;
            font-weight: 600;
            color: var(--gray-600);
        }

        .topbar-title span { color: var(--green-600); }

        .topbar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green-300), var(--green-500));
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
        }

        .content-wrap {
            padding: 1.75rem;
            flex: 1;
        }

        .content-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--green-100);
            box-shadow: var(--shadow-md);
            padding: 1.75rem;
        }

        /* ── Alert ── */
        .alert-success {
            background: var(--green-50);
            border: 1px solid var(--green-200);
            color: var(--green-700);
            border-radius: 9px;
            padding: .75rem 1rem;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fca5a5;
            color: #9f1239;
            border-radius: 9px;
            padding: .75rem 1rem;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }
    </style>
</head>

<body>
<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <div class="brand-name">AdminPanel</div>
                <div class="brand-sub">Quản lý hệ thống</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Tổng quan</div>
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <div class="nav-section-label">Quản lý</div>
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                Sản phẩm
            </a>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Danh mục
            </a>
        </nav>

        <div class="sidebar-footer">© {{ date('Y') }} Admin Panel</div>
    </aside>

    <!-- Main -->
    <div class="main-area">
        <div class="topbar">
            <div class="topbar-title">
                <span>@yield('title', 'Dashboard')</span>
            </div>
            <div class="topbar-avatar">A</div>
        </div>

        <div class="content-wrap">
            <div class="content-card">
                <x-alert />
                @yield('content')
            </div>
        </div>
    </div>

</div>
</body>
</html>