@extends('core::layouts.master')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-group"></i>
        </span> Tác giả
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tác giả</li>
        </ul>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Danh sách tác giả</h4>
                    <a href="{{ route('admin.authors.create') }}" class="btn btn-gradient-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Thêm mới
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="authors-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tác giả</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authors as $author)
                                <tr>
                                    <td>{{ $author->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($author->avatar)
                                                <img src="{{ $author->avatar }}"
                                                     alt="{{ $author->full_name }}"
                                                     class="rounded-circle"
                                                     width="36" height="36"
                                                     style="object-fit:cover;">
                                            @else
                                                <span class="avatar-placeholder rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center text-white"
                                                      style="width:36px;height:36px;font-size:14px;">
                                                    {{ strtoupper(substr($author->full_name, 0, 1)) }}
                                                </span>
                                            @endif
                                            <span>{{ $author->full_name }}</span>
                                        </div>
                                    </td>
                                    <td><code>{{ $author->username }}</code></td>
                                    <td>{{ $author->email ?? '—' }}</td>
                                    <td>
                                        @forelse($author->authorTypes as $type)
                                            <span class="badge me-1"
                                                  style="background-color: {{ $type->color_hex ?? '#6c757d' }};">
                                                {{ $type->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">—</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        @if($author->is_active)
                                            <span class="badge badge-gradient-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-gradient-danger">Tắt</span>
                                        @endif
                                    </td>
                                    <td>{{ $author->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.authors.edit', $author->id) }}"
                                           class="btn btn-gradient-info btn-sm"
                                           title="Chỉnh sửa">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-gradient-danger btn-sm btn-delete"
                                                data-id="{{ $author->id }}"
                                                data-name="{{ $author->full_name }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                title="Xóa">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="mdi mdi-account-off mdi-24px d-block mb-2"></i>
                                        Chưa có tác giả nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc muốn xóa tác giả <strong id="deleteItemName"></strong>?
                Dữ liệu sẽ được chuyển vào thùng rác (soft delete).
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id   = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteForm').action = '/admin/authors/' + id;
        });
    });
</script>
@endpush
