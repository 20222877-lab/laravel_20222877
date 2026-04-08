@extends('layout.master')

@section('title','Dashboard')

@section('content')

<style>
    .dash-greeting {
        margin-bottom: 1.5rem;
    }

    .dash-greeting h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--green-700);
        margin: 0 0 3px;
        letter-spacing: -.02em;
    }

    .dash-greeting p {
        font-size: .85rem;
        color: var(--gray-400);
        margin: 0;
    }

    /* ── Stat cards ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--green-100);
        border-radius: var(--radius);
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: .9rem;
        box-shadow: var(--shadow-sm);
        transition: transform .15s, box-shadow .15s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 44px; height: 44px;
        border-radius: 11px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg { width:20px; height:20px; }

    .stat-icon.green { background: var(--green-50); color: var(--green-600); }
    .stat-icon.teal  { background: #f0fdfa; color: #0d9488; }
    .stat-icon.amber { background: #fffbeb; color: #d97706; }

    .stat-body { flex: 1; min-width: 0; }

    .stat-label {
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--gray-400);
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--green-700);
        line-height: 1;
        letter-spacing: -.03em;
    }

    .stat-sub {
        font-size: .72rem;
        color: var(--gray-400);
        margin-top: 4px;
    }

    /* ── Section header ── */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: .95rem;
        font-weight: 700;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: .45rem;
    }

    .section-title::before {
        content: '';
        display: inline-block;
        width: 4px; height: 1rem;
        background: linear-gradient(180deg, var(--green-400), var(--green-600));
        border-radius: 99px;
    }

    .section-link {
        font-size: .8rem;
        font-weight: 600;
        color: var(--green-500);
        text-decoration: none;
        display: flex; align-items: center; gap: .3rem;
        transition: color .15s;
    }

    .section-link:hover { color: var(--green-700); }
    .section-link svg { width:13px; height:13px; }

    /* ── Latest products table ── */
    .latest-table-wrap {
        border: 1px solid var(--green-100);
        border-radius: 10px;
        overflow: hidden;
    }

    .latest-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .855rem;
    }

    .latest-table thead {
        background: linear-gradient(90deg, var(--green-50), #fff);
        border-bottom: 1.5px solid var(--green-100);
    }

    .latest-table thead th {
        padding: .75rem 1rem;
        text-align: left;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--green-600);
        white-space: nowrap;
    }

    .latest-table tbody tr {
        border-bottom: 1px solid var(--gray-100);
        transition: background .12s;
    }

    .latest-table tbody tr:last-child { border-bottom: none; }
    .latest-table tbody tr:hover { background: var(--green-50); }

    .latest-table td {
        padding: .75rem 1rem;
        vertical-align: middle;
    }

    .prod-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px; height: 24px;
        border-radius: 6px;
        background: var(--green-100);
        color: var(--green-700);
        font-size: .72rem;
        font-weight: 700;
    }

    .prod-name {
        font-weight: 600;
        color: var(--gray-800);
    }

    .price-chip {
        background: var(--green-50);
        border: 1px solid var(--green-100);
        color: var(--green-600);
        border-radius: 99px;
        padding: .2rem .65rem;
        font-size: .78rem;
        font-weight: 700;
        display: inline-block;
    }

    /* ── Empty ── */
    .empty-row td {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--gray-400);
        font-size: .85rem;
    }
</style>

<!-- Greeting -->
<div class="dash-greeting">
    <h2>Tổng quan hệ thống 👋</h2>
    <p>Chào mừng trở lại — đây là tóm tắt hoạt động hiện tại.</p>
</div>

<!-- Stat cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </div>
        <div class="stat-body">
            <div class="stat-label">Sản phẩm</div>
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-sub">Tổng sản phẩm</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon teal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
        </div>
        <div class="stat-body">
            <div class="stat-label">Danh mục</div>
            <div class="stat-value">{{ $totalCategories }}</div>
            <div class="stat-sub">Tổng danh mục</div>
        </div>
    </div>
</div>

<!-- Latest products -->
<div class="section-header">
    <div class="section-title">5 Sản phẩm mới nhất</div>
    <a href="{{ route('products.index') }}" class="section-link">
        Xem tất cả
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
</div>

<div class="latest-table-wrap">
    <table class="latest-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latestProducts as $i => $p)
            <tr>
                <td><span class="prod-num">{{ $i + 1 }}</span></td>
                <td><span class="prod-name">{{ $p->name }}</span></td>
                <td><span class="price-chip">{{ number_format($p->price) }} đ</span></td>
            </tr>
            @empty
            <tr class="empty-row">
                <td colspan="3">Chưa có sản phẩm nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection