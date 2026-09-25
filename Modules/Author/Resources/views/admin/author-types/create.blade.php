@extends('core::layouts.master')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-tag-plus"></i>
        </span> Thêm loại tác giả
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.author-types.index') }}">Loại tác giả</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thông tin loại tác giả</h4>

                <form action="{{ route('admin.author-types.store') }}" method="POST" id="author-type-form">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Tên <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="VD: Biên tập viên"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="code">Mã (Code) <span class="text-danger">*</span></label>
                        <input type="text"
                               id="code"
                               name="code"
                               class="form-control @error('code') is-invalid @enderror"
                               value="{{ old('code') }}"
                               placeholder="VD: editor"
                               required>
                        <small class="text-muted">Chỉ chứa chữ thường, số và dấu gạch ngang/dưới.</small>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea id="description"
                                  name="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Mô tả về loại tác giả...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="color_hex">Màu sắc</label>
                            <div class="input-group">
                                <input type="color"
                                       id="color_picker"
                                       class="form-control form-control-color"
                                       value="{{ old('color_hex', '#6c757d') }}"
                                       style="max-width:50px;">
                                <input type="text"
                                       id="color_hex"
                                       name="color_hex"
                                       class="form-control @error('color_hex') is-invalid @enderror"
                                       value="{{ old('color_hex') }}"
                                       placeholder="#RRGGBB"
                                       maxlength="7">
                                @error('color_hex')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="sort_order">Thứ tự hiển thị</label>
                            <input type="number"
                                   id="sort_order"
                                   name="sort_order"
                                   class="form-control @error('sort_order') is-invalid @enderror"
                                   value="{{ old('sort_order', 0) }}"
                                   min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="is_active"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Kích hoạt</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i> Lưu
                        </button>
                        <a href="{{ route('admin.author-types.index') }}" class="btn btn-light">
                            Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sync color picker <-> text input
    const colorPicker = document.getElementById('color_picker');
    const colorHex    = document.getElementById('color_hex');

    colorPicker.addEventListener('input', () => { colorHex.value = colorPicker.value; });
    colorHex.addEventListener('input', () => {
        if (/^#[0-9A-Fa-f]{6}$/.test(colorHex.value)) {
            colorPicker.value = colorHex.value;
        }
    });

    // Auto-generate code from name
    const nameInput = document.getElementById('name');
    const codeInput = document.getElementById('code');
    nameInput.addEventListener('input', function() {
        if (!codeInput.dataset.manual) {
            codeInput.value = this.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    });
    codeInput.addEventListener('input', function() {
        this.dataset.manual = 'true';
    });
</script>
@endpush
