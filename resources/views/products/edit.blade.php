@extends('layout.master')

@section('title','Sửa sản phẩm')

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

    /* Current image */
    .current-image-section {
        background: var(--green-50);
        border: 1px solid var(--green-100);
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .current-image-section img {
        width: 80px; height: 80px;
        object-fit: cover;
        border-radius: 9px;
        border: 2px solid var(--green-200);
        flex-shrink: 0;
    }

    .current-image-info { flex: 1; }

    .current-image-info p {
        font-size: .8rem;
        font-weight: 600;
        color: var(--green-700);
        margin: 0 0 3px;
    }

    .current-image-info span {
        font-size: .75rem;
        color: var(--gray-400);
    }

    /* File upload */
    .file-drop {
        border: 2px dashed var(--green-200);
        border-radius: 10px;
        background: var(--green-50);
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        position: relative;
    }

    .file-drop:hover { border-color: var(--green-400); background: var(--green-100); }

    .file-drop input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }

    .file-drop-icon { color: var(--green-400); margin-bottom: .4rem; }
    .file-drop-icon svg { width:28px; height:28px; }

    .file-drop-text { font-size: .83rem; color: var(--gray-600); font-weight: 500; }
    .file-drop-sub { font-size: .72rem; color: var(--gray-400); margin-top: 2px; }

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

    .field-error {
        font-size: .75rem;
        color: #dc2626;
        margin-top: 2px;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="form-header">
    <div class="form-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </div>
    <div>
        <h2>Sửa sản phẩm</h2>
        <p>Đang chỉnh sửa: <strong>{{ $product->name }}</strong></p>
    </div>
</div>

<form method="POST"
      action="{{ route('products.update', $product->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="form-grid">

    <!-- Tên -->
    <div class="form-group form-full">
        <label class="form-label">Tên sản phẩm <span>*</span></label>
        <input name="name" type="text" class="form-input"
               value="{{ old('name', $product->name) }}"
               placeholder="Nhập tên sản phẩm...">
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Giá -->
    <div class="form-group">
        <label class="form-label">Giá (đ) <span>*</span></label>
        <input name="price" type="number" class="form-input"
               value="{{ old('price', $product->price) }}"
               placeholder="0">
        @error('price')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Số lượng -->
    <div class="form-group">
        <label class="form-label">Số lượng <span>*</span></label>
        <input name="quantity" type="number" class="form-input"
               value="{{ old('quantity', $product->quantity) }}"
               placeholder="0">
        @error('quantity')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Danh mục -->
    <div class="form-group form-full">
        <label class="form-label">Danh mục <span>*</span></label>
        <select name="category_id" class="form-select">
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ (old('category_id', $product->category_id) == $c->id) ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <!-- Ảnh hiện tại -->
    @if($product->image)
    <div class="form-group form-full">
        <label class="form-label">Ảnh hiện tại</label>
        <div class="current-image-section">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            <div class="current-image-info">
                <p>Ảnh đang sử dụng</p>
                <span>Chọn file mới bên dưới để thay thế ảnh này</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Upload ảnh mới -->
    <div class="form-group form-full">
        <label class="form-label">{{ $product->image ? 'Thay ảnh mới (tùy chọn)' : 'Hình ảnh sản phẩm' }}</label>
        <div class="file-drop">
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
    <button type="submit" class="btn-update">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        Cập nhật sản phẩm
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