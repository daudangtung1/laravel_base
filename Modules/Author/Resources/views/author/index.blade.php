@extends('core::layouts.master')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Author</h4>
            <p class="card-description">Author list</code>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($authors as $k => $v )
                    <tr>
                        <!-- <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                        </td> -->
                        <td>
                            <a href="{{ route('admin.author.show', $v->id) }}">
                                {{ $v->user->email}}
                            </a>
                        </td>
                        <td>{{ $v->created_at }}</td>
                        <td>{{ $v->user_name }}</td>
                    </tr>
                    @empty
                    <tr>
                        Data not found
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $authors->links('core::vendor.pagination.pagination') }}
        </div>
    </div>
</div>
@endsection