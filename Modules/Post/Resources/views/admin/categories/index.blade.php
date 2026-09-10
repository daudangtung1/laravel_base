@extends('core::layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h3 class="mb-0">Danh mục bài viết</h3><a class="btn btn-gradient-primary" href="{{ route('admin.post-categories.create') }}">Thêm danh mục</a></div>
@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card"><div class="card-body table-responsive"><table class="table"><thead><tr><th>Tên</th><th>Slug</th><th>Thứ tự</th><th>Bài viết</th><th>Hiển thị</th><th></th></tr></thead><tbody>
@forelse($categories as $category)<tr><td>{{ $category->name }}</td><td>{{ $category->slug }}</td><td>{{ $category->sort_order }}</td><td>{{ $category->posts_count }}</td><td>{{ $category->is_active ? 'Có' : 'Không' }}</td><td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.post-categories.edit', $category) }}">Sửa</a><form class="d-inline" method="POST" action="{{ route('admin.post-categories.destroy', $category) }}" onsubmit="return confirm('Xóa danh mục này? Bài viết sẽ không còn danh mục.')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Xóa</button></form></td></tr>
@empty <tr><td colspan="6" class="text-center">Chưa có danh mục.</td></tr>@endforelse</tbody></table>{{ $categories->links() }}</div></div>
@endsection
