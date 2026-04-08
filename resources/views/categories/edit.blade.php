@extends('layout.master')

@section('title','Sửa danh mục')

@section('content')

<style>
    .form-header {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 1.5px solid var(--green-100);
    }

    .form-header-icon {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #92400e;
    }

    .form-header-icon svg { width:18px; height:18px; }

    .form-header h2 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--green-700);
        margin: 0;
        letter-spacing: -.01em;
    }

    .form-header p {
        font-size: .78rem;
        color: var(--gray-400);
        margin: 1px 0 0;
    }

    /* Current name display */
    .current-value {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: var(--green-50);
        border: 1px solid var(--green-100);
        border-radius: 7px;
        padding: .3rem .75rem;
        font-size: .8rem;
        color: var(--green-700);
        font-weight: 600;
        margin-bottom: 1.25rem;
    }

    .current-value svg { width:13px; height:13px; }

    .form-group { display: flex; flex-direction: column; gap: .35rem; margin-bottom: 1.1rem; }

    .form-label {
        font-size: .78rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .form-label span { color: #e53e3e; margin-left: 2px; }

    .form-input {
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: .875rem;
        color: var(--gray-800);
        background: var(--gray-50);
        border: 1.5px solid var(--gray-200);
        border-radius: 9px;
        padding: .7rem 1rem;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        width: 100%;
    }

    .form-input:focus {
        border-color: var(--green-400);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(61,184,112,.15);
    }

    .field-error {
        font-size: .75rem;
        color: #dc2626;
        margin-top: 2px;
    }

    .form-actions {
        display: flex;
        gap: .75rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--green-100);
    }

    .btn-cancel {
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: .875rem;
        font-weight: 600;
        color: var(--gray-600);
        background: var(--gray-100);
        border: 1.5px solid var(--gray-200);
        border-radius: 9px;
        padding: .65rem 1.4rem;
        cursor: pointer;
        text-decoration: none;
        transition: background .15s;
        display: inline-flex; align-items: center; gap: .4rem;
    }

    .btn-cancel:hover { background: var(--gray-200); }

    .btn-update {
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: .875rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 9px;
        padding: .65rem 1.75rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(245,158,11,.28);
        transition: transform .15s, box-shadow .15s;
        display: inline-flex; align-items: center; gap: .4rem;
    }

    .btn-update:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(245,158,11,.36);
    }

    .btn-update svg, .btn-cancel svg { width:15px; height:15px; }
</style>

<div class="form-header">
    <div class="form-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </div>
    <div>
        <h2>Sửa danh mục</h2>
        <p>Cập nhật thông tin danh mục</p>
    </div>
</div>

<div class="current-value">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
    Đang sửa: {{ $category->name }}
</div>

<form method="POST" action="{{ route('categories.update', $category->id) }}">
@csrf
@method('PUT')

    <div class="form-group">
        <label class="form-label">Tên danh mục <span>*</span></label>
        <input name="name" type="text" class="form-input"
               value="{{ old('name', $category->name) }}"
               placeholder="Nhập tên danh mục...">
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-actions">
        <a href="{{ route('categories.index') }}" class="btn-cancel">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Hủy
        </a>
        <button type="submit" class="btn-update">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Cập nhật danh mục
        </button>
    </div>

</form>

@endsection