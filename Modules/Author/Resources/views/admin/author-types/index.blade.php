@extends('core::layouts.master')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-tag-multiple"></i>
        </span> Loại tác giả
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Loại tác giả</li>
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
                    <h4 class="card-title mb-0">Danh sách loại tác giả</h4>
                    <a href="{{ route('admin.author-types.create') }}" class="btn btn-gradient-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Thêm mới
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="author-types-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Mã</th>
                                <th>Màu</th>
                                <th>Thứ tự</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authorTypes as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td><code>{{ $type->code }}</code></td>
                                    <td>
                                        @if($type->color_hex)
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <span style="display:inline-block;width:18px;height:18px;border-radius:4px;background:{{ $type->color_hex }};border:1px solid #ddd;"></span>
                                                {{ $type->color_hex }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $type->sort_order }}</td>
                                    <td>
                                        @if($type->is_active)
                                            <span class="badge badge-gradient-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-gradient-danger">Tắt</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.author-types.edit', $type->id) }}"
                                           class="btn btn-gradient-info btn-sm"
                                           title="Chỉnh sửa">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-gradient-danger btn-sm btn-delete"
                                                data-id="{{ $type->id }}"
                                                data-name="{{ $type->name }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                title="Xóa">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="mdi mdi-information-outline mdi-24px d-block mb-2"></i>
                                        Chưa có loại tác giả nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $authorTypes->links() }}
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
                Bạn có chắc muốn xóa loại tác giả <strong id="deleteItemName"></strong>?
                Hành động này không thể hoàn tác.
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
            document.getElementById('deleteForm').action = '/admin/author-types/' + id;
        });
    });
</script>
@endpush
