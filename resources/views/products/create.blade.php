@extends('layout.master')

@section('title','Thêm sản phẩm')

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
        background: linear-gradient(135deg, var(--green-100), var(--green-200));
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--green-600);
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

    /* Form grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.1rem;
    }

    .form-full { grid-column: 1 / -1; }

    .form-group { display: flex; flex-direction: column; gap: .35rem; }

    .form-label {
        font-size: .78rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .form-label span { color: #e53e3e; margin-left: 2px; }

    .form-input,
    .form-select {
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: .875rem;
        color: var(--gray-800);
        background: var(--gray-50);
        border: 1.5px solid var(--gray-200);
        border-radius: 9px;
        padding: .65rem 1rem;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        width: 100%;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--green-400);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(61,184,112,.15);
    }

    .form-input::placeholder { color: var(--gray-400); }

    /* File upload */
    .file-drop {
        border: 2px dashed var(--green-200);
        border-radius: 10px;
        background: var(--green-50);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        position: relative;
    }

    .file-drop:hover { border-color: var(--green-400); background: var(--green-100); }

    .file-drop input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }

    .file-drop-icon { color: var(--green-400); margin-bottom: .5rem; }
    .file-drop-icon svg { width:32px; height:32px; }

    .file-drop-text {
        font-size: .85rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    .file-drop-sub {
        font-size: .75rem;
        color: var(--gray-400);
        margin-top: 3px;
    }

    /* Actions */
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

    .btn-save {
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: .875rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, var(--green-400), var(--green-600));
        border: none;
        border-radius: 9px;
        padding: .65rem 1.75rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(34,160,91,.30);
        transition: transform .15s, box-shadow .15s, opacity .15s;
        display: inline-flex; align-items: center; gap: .4rem;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(34,160,91,.38);
    }

    .btn-save svg, .btn-cancel svg { width:15px; height:15px; }

    /* Validation errors */
    .field-error {
        font-size: .75rem;
        color: #dc2626;
        margin-top: 2px;
        display: flex; align-items: center; gap: 4px;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="form-header">
    <div class="form-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    </div>
    <div>
        <h2>Thêm sản phẩm mới</h2>
        <p>Điền thông tin chi tiết để tạo sản phẩm</p>
    </div>
</div>

<form method="POST" action="{{ route('products.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="form-grid">

    <!-- Tên -->
    <div class="form-group form-full">
        <label class="form-label">Tên sản phẩm <span>*</span></label>
        <input name="name" type="text" class="form-input"
               placeholder="Nhập tên sản phẩm..."
               value="{{ old('name') }}">
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Giá -->
    <div class="form-group">
        <label class="form-label">Giá (đ) <span>*</span></label>
        <input name="price" type="number" class="form-input"
               placeholder="0"
               value="{{ old('price') }}">
        @error('price')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Số lượng -->
    <div class="form-group">
        <label class="form-label">Số lượng <span>*</span></label>
        <input name="quantity" type="number" class="form-input"
               placeholder="0"
               value="{{ old('quantity') }}">
        @error('quantity')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Danh mục -->
    <div class="form-group form-full">
        <label class="form-label">Danh mục <span>*</span></label>
        <select name="category_id" class="form-select">
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Upload ảnh -->
    <div class="form-group form-full">
        <label class="form-label">Hình ảnh sản phẩm</label>
        <div class="file-drop" id="fileDrop">
            <input type="file" name="image" accept="image/*"
                   onchange="previewFile(this)">
            <div class="file-drop-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
            </div>
            <div class="file-drop-text" id="fileLabel">Kéo thả hoặc nhấn để chọn ảnh</div>
            <div class="file-drop-sub">PNG, JPG, WEBP — Tối đa 2MB</div>
        </div>
        <div id="imgPreviewWrap" style="display:none;margin-top:.75rem;">
            <img id="imgPreview" style="height:100px;border-radius:8px;border:2px solid var(--green-200);object-fit:cover;">
        </div>
        @error('image')<div class="field-error">{{ $message }}</div>@enderror
    </div>

</div>

<div class="form-actions">
    <a href="{{ route('products.index') }}" class="btn-cancel">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        Hủy
    </a>
    <button type="submit" class="btn-save">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        Lưu sản phẩm
    </button>
</div>

</form>

<script>
function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById('fileLabel').textContent = file.name;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('imgPreview').src = e.target.result;
        document.getElementById('imgPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(file);
}
</script>

@endsection