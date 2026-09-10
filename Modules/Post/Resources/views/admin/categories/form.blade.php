@extends('core::layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h3>{{ $category->exists ? 'Sửa danh mục' : 'Thêm danh mục' }}</h3><a href="{{ route('admin.post-categories.index') }}" class="btn btn-light">Quay lại</a></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ $category->exists ? route('admin.post-categories.update', $category) : route('admin.post-categories.store') }}">@csrf @if($category->exists) @method('PUT') @endif
<div class="form-group"><label>Tên *</label><input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name) }}">@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>Slug *</label><input class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $category->slug) }}">@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>Mô tả</label><textarea class="form-control" rows="4" name="description">{{ old('description', $category->description) }}</textarea></div>
<div class="row"><div class="col-md-3"><div class="form-group"><label>Thứ tự</label><input class="form-control" min="0" type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}"></div></div><div class="col-md-3"><div class="form-group"><label>Hiển thị</label><select class="form-control" name="is_active"><option value="1" @selected(old('is_active', (int) $category->is_active) == 1)>Có</option><option value="0" @selected(old('is_active', (int) $category->is_active) == 0)>Không</option></select></div></div></div>
<button class="btn btn-gradient-primary">Lưu danh mục</button></form></div></div>
@endsection
