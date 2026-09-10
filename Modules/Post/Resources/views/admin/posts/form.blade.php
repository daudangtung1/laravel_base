@extends('core::layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h3>{{ $post->exists ? 'Sửa bài viết' : 'Thêm bài viết' }}</h3><a href="{{ route('admin.posts.index') }}" class="btn btn-light">Quay lại</a></div>
<div class="card"><div class="card-body"><form method="POST" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}">@csrf @if($post->exists) @method('PUT') @endif
@include('post::admin.posts.partials.fields')
<button class="btn btn-gradient-primary">Lưu bài viết</button></form></div></div>
@endsection
