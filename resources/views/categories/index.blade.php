@extends('layout.master')

@section('title','Categories')

@section('content')

<style>
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
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .07em;
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
    }

    /* ID badge */
    .id-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 24px;
        background: var(--green-50);
        border: 1px solid var(--green-100);
        color: var(--green-700);
        border-radius: 6px;
        font-size: .72rem;
        font-weight: 700;
        padding: 0 .4rem;
    }

    /* Category name */
    .cat-name {
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: .45rem;
    }

    .cat-name::before {
        content: '';
        width: 8px; height: 8px;
        background: var(--green-400);
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* Product count */
    .count-chip {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1d4ed8;
        border-radius: 99px;
        padding: .2rem .7rem;
        font-size: .78rem;
        font-weight: 700;
    }

    .count-chip svg { width:12px; height:12px; }

    /* Action buttons */
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

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: var(--gray-400);
    }

    .empty-state svg { width:48px; height:48px; margin: 0 auto .75rem; opacity:.45; }
    .empty-state p { font-size: .875rem; }

    /* Pagination */
    .pagination-wrap {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--green-100);
    }
</style>

<!-- Header -->
<div class="page-header">
    <h2 class="page-title">Danh mục danh mục</h2>
    <a href="{{ route('categories.create') }}" class="btn-add">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Thêm danh mục
    </a>
</div>

<!-- Table -->
<div class="table-card">
    <div style="overflow-x:auto;">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Số sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $c)
            <tr>
                <td><span class="id-badge">#{{ $c->id }}</span></td>

                <td><span class="cat-name">{{ $c->name }}</span></td>

                <td>
                    <span class="count-chip">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        {{ $c->products_count ?? 0 }} sản phẩm
                    </span>
                </td>

                <td>
                    <div class="actions">
                        <a href="{{ route('categories.edit', $c->id) }}" class="btn-edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Sửa
                        </a>

                        <form action="{{ route('categories.destroy', $c->id) }}"
                              method="POST" class="inline" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                    onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                Xóa
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        <p>Chưa có danh mục nào. Hãy thêm danh mục đầu tiên!</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    @if($categories->hasPages())
    <div class="pagination-wrap">
        {{ $categories->links() }}
    </div>
    @endif
</div>

@endsection