@extends('layout.master')

@section('title','Products')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');

    :root {
        --green-50:  #f0faf4;
        --green-100: #d9f2e3;
        --green-200: #b3e5c8;
        --green-300: #6ecf9a;
        --green-400: #3db870;
        --green-500: #22a05b;
        --green-600: #178247;
        --green-700: #115e34;
        --gray-50:   #f8faf9;
        --gray-100:  #eef1ee;
        --gray-200:  #dde3dd;
        --gray-400:  #8fa894;
        --gray-600:  #4a5e50;
        --gray-800:  #1e2d23;
        --shadow-sm: 0 1px 3px rgba(34,160,91,.08), 0 1px 2px rgba(0,0,0,.04);
        --shadow-md: 0 4px 16px rgba(34,160,91,.10), 0 2px 6px rgba(0,0,0,.06);
        --radius:    12px;
    }

    .products-page {
        font-family: 'Be Vietnam Pro', sans-serif;
        color: var(--gray-800);
        background: var(--gray-50);
        min-height: 100vh;
        padding: 2rem 1.5rem;
    }

    /* ── Header ── */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--green-700);
        letter-spacing: -.02em;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .page-title::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 1.5rem;
        background: linear-gradient(180deg, var(--green-400), var(--green-600));
        border-radius: 99px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: linear-gradient(135deg, var(--green-400), var(--green-600));
        color: #fff;
        font-family: inherit;
        font-weight: 600;
        font-size: .875rem;
        padding: .6rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(34,160,91,.30);
        transition: transform .15s, box-shadow .15s, opacity .15s;
    }

    .btn-add:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(34,160,91,.38);
        opacity: .93;
    }

    .btn-add svg { width:16px; height:16px; }

    /* ── Search bar ── */
    .search-bar {
        background: #fff;
        border: 1px solid var(--green-100);
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        display: flex;
        gap: .75rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .search-bar input,
    .search-bar select {
        font-family: inherit;
        font-size: .875rem;
        border: 1.5px solid var(--gray-200);
        border-radius: 8px;
        padding: .55rem .9rem;
        color: var(--gray-800);
        background: var(--gray-50);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .search-bar input { flex: 1; min-width: 180px; }
    .search-bar select { min-width: 150px; }

    .search-bar input:focus,
    .search-bar select:focus {
        border-color: var(--green-400);
        box-shadow: 0 0 0 3px rgba(61,184,112,.15);
    }

    .btn-search {
        font-family: inherit;
        font-weight: 600;
        font-size: .875rem;
        background: var(--green-500);
        color: #fff;
        border: none;
        padding: .55rem 1.25rem;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        transition: background .2s, transform .15s;
    }

    .btn-search:hover { background: var(--green-600); transform: translateY(-1px); }
    .btn-search svg { width:15px; height:15px; }

    /* ── Table card ── */
    .table-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--green-100);
        overflow: hidden;
    }

    .table-card table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }

    .table-card thead {
        background: linear-gradient(90deg, var(--green-50), #fff);
        border-bottom: 2px solid var(--green-100);
    }

    .table-card thead th {
        padding: .9rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--green-600);
        white-space: nowrap;
    }

    .table-card tbody tr {
        border-bottom: 1px solid var(--gray-100);
        transition: background .15s;
    }

    .table-card tbody tr:last-child { border-bottom: none; }
    .table-card tbody tr:hover { background: var(--green-50); }

    .table-card td {
        padding: .85rem 1rem;
        vertical-align: middle;
        color: var(--gray-800);
    }

    /* product image */
    .product-img {
        width: 54px;
        height: 54px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--green-100);
    }

    .img-placeholder {
        width: 54px;
        height: 54px;
        border-radius: 8px;
        background: var(--green-50);
        border: 2px dashed var(--green-200);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--green-300);
    }

    /* product name */
    .product-name {
        font-weight: 600;
        color: var(--gray-800);
    }

    /* price */
    .price-tag {
        font-weight: 700;
        color: var(--green-600);
        background: var(--green-50);
        border: 1px solid var(--green-100);
        border-radius: 99px;
        padding: .2rem .7rem;
        display: inline-block;
        font-size: .8rem;
    }

    /* category badge */
    .category-badge {
        background: var(--gray-100);
        color: var(--gray-600);
        border-radius: 99px;
        padding: .18rem .65rem;
        font-size: .78rem;
        font-weight: 500;
    }

    /* action buttons */
    .actions { display: flex; gap: .5rem; align-items: center; }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        background: #fffbeb;
        color: #92400e;
        border: 1.5px solid #fcd34d;
        border-radius: 7px;
        padding: .38rem .8rem;
        font-size: .8rem;
        font-weight: 600;
        font-family: inherit;
        text-decoration: none;
        transition: background .15s, transform .15s;
    }

    .btn-edit:hover { background: #fef3c7; transform: translateY(-1px); }
    .btn-edit svg { width:13px; height:13px; }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        background: #fff1f2;
        color: #9f1239;
        border: 1.5px solid #fca5a5;
        border-radius: 7px;
        padding: .38rem .8rem;
        font-size: .8rem;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s, transform .15s;
    }

    .btn-delete:hover { background: #ffe4e6; transform: translateY(-1px); }
    .btn-delete svg { width:13px; height:13px; }

    /* ── Empty state ── */
    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: var(--gray-400);
    }

    .empty-state svg { width:52px; height:52px; margin: 0 auto 1rem; opacity:.5; }
    .empty-state p { font-size: .9rem; }

    /* ── Pagination ── */
    .pagination-wrap { padding: 1rem 1.25rem; border-top: 1px solid var(--green-100); }

    /* Override default Laravel pagination styles */
    .pagination-wrap nav svg { color: var(--green-500); }
    .pagination-wrap nav span[aria-current] span,
    .pagination-wrap nav a:hover {
        background: var(--green-500) !important;
        border-color: var(--green-500) !important;
        color: #fff !important;
    }

    @media (max-width: 640px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .table-card thead th:nth-child(3),
        .table-card td:nth-child(3) { display: none; }
    }
</style>

<div class="products-page">

    <!-- Header -->
    <div class="page-header">
        <h2 class="page-title">Danh sách sản phẩm</h2>
        <a href="{{ route('products.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Thêm sản phẩm
        </a>
    </div>

    <!-- Search + Sort -->
    <form class="search-bar" method="GET">
        <input name="keyword" value="{{ request('keyword') }}" placeholder="🔍  Tìm sản phẩm...">

        <select name="sort">
            <option value="">Sắp xếp theo giá</option>
            <option value="asc"  {{ request('sort')=='asc'  ? 'selected' : '' }}>↑ Giá tăng dần</option>
            <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>↓ Giá giảm dần</option>
        </select>

        <button type="submit" class="btn-search">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Tìm kiếm
        </button>
    </form>

    <!-- Table -->
    <div class="table-card">
        <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td>
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}" class="product-img" alt="{{ $p->name }}">
                        @else
                            <div class="img-placeholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="22" height="22"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                    </td>

                    <td><span class="product-name">{{ $p->name }}</span></td>

                    <td><span class="price-tag">{{ number_format($p->price) }} đ</span></td>

                    <td><span class="category-badge">{{ $p->category->name }}</span></td>

                    <td>
                        <div class="actions">
                            <a href="{{ route('products.edit', $p->id) }}" class="btn-edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Sửa
                            </a>

                            <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                            <p>Không tìm thấy sản phẩm nào.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="pagination-wrap">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>

@endsection