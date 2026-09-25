@extends('core::layouts.master')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-plus"></i>
        </span> Thêm tác giả
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.authors.index') }}">Tác giả</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ul>
    </nav>
</div>

<form action="{{ route('admin.authors.store') }}" method="POST" id="author-form">
    @csrf

    <div class="row">
        {{-- Main info --}}
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin cơ bản</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="full_name">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text"
                                   id="full_name"
                                   name="full_name"
                                   class="form-control @error('full_name') is-invalid @enderror"
                                   value="{{ old('full_name') }}"
                                   placeholder="Nguyễn Văn A"
                                   required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username') }}"
                                   placeholder="nguyen-van-a"
                                   required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio">Tiểu sử</label>
                        <textarea id="bio"
                                  name="bio"
                                  rows="4"
                                  class="form-control @error('bio') is-invalid @enderror"
                                  placeholder="Giới thiệu về tác giả...">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="author@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="location">Địa điểm</label>
                            <input type="text"
                                   id="location"
                                   name="location"
                                   class="form-control @error('location') is-invalid @enderror"
                                   value="{{ old('location') }}"
                                   placeholder="Hà Nội, Việt Nam">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="website_url">Website</label>
                            <input type="url"
                                   id="website_url"
                                   name="website_url"
                                   class="form-control @error('website_url') is-invalid @enderror"
                                   value="{{ old('website_url') }}"
                                   placeholder="https://example.com">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="avatar">URL Ảnh đại diện</label>
                            <input type="text"
                                   id="avatar"
                                   name="avatar"
                                   class="form-control @error('avatar') is-invalid @enderror"
                                   value="{{ old('avatar') }}"
                                   placeholder="https://example.com/avatar.jpg">
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h4 class="card-title mt-4">SEO</h4>

                    <div class="form-group mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text"
                               id="meta_title"
                               name="meta_title"
                               class="form-control @error('meta_title') is-invalid @enderror"
                               value="{{ old('meta_title') }}"
                               placeholder="Tiêu đề SEO..."
                               maxlength="255">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea id="meta_description"
                                  name="meta_description"
                                  rows="2"
                                  class="form-control @error('meta_description') is-invalid @enderror"
                                  placeholder="Mô tả SEO...">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar settings --}}
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cài đặt</h4>

                    <div class="form-group mb-3">
                        <label for="author_type_ids">Loại tác giả</label>
                        <select id="author_type_ids"
                                name="author_type_ids[]"
                                class="form-select @error('author_type_ids') is-invalid @enderror"
                                multiple
                                size="6">
                            @foreach($authorTypes as $type)
                                <option value="{{ $type->id }}"
                                        {{ in_array($type->id, old('author_type_ids', [])) ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Giữ Ctrl/Cmd để chọn nhiều.</small>
                        @error('author_type_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="published_at">Ngày xuất bản</label>
                        <input type="datetime-local"
                               id="published_at"
                               name="published_at"
                               class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input"
                               type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Kích hoạt</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i> Lưu tác giả
                        </button>
                        <a href="{{ route('admin.authors.index') }}" class="btn btn-light">
                            Hủy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto-generate username from full_name
    const fullNameInput = document.getElementById('full_name');
    const usernameInput = document.getElementById('username');

    fullNameInput.addEventListener('input', function() {
        if (!usernameInput.dataset.manual) {
            usernameInput.value = this.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });
    usernameInput.addEventListener('input', function() {
        this.dataset.manual = 'true';
    });
</script>
@endpush
