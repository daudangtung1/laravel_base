@extends('core::layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Bài viết</h3>
    <a class="btn btn-gradient-primary" href="{{ route('admin.posts.create') }}">Thêm bài viết</a>
</div>
@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card"><div class="card-body table-responsive">
<table class="table"><thead><tr><th>Tiêu đề</th><th>Danh mục</th><th>Trạng thái</th><th>Xuất bản</th><th></th></tr></thead>
<tbody>@forelse($posts as $post)<tr>
    <td><strong>{{ $post->title }}</strong><br><small class="text-muted">{{ $post->slug }}</small></td>
    <td>{{ optional($post->category)->name ?? '—' }}</td><td>{{ $post->status }}</td>
    <td>{{ optional($post->published_at)->format('d/m/Y H:i') ?? '—' }}</td>
    <td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.posts.edit', $post) }}">Sửa</a>
    <form class="d-inline" method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Xóa bài viết này?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Xóa</button></form></td>
</tr>@empty <tr><td colspan="5" class="text-center">Chưa có bài viết.</td></tr>@endforelse</tbody></table>
{{ $posts->links() }}</div></div>
@endsection
