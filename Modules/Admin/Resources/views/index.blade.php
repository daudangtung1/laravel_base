@extends('core::layouts.master')

@section('content')
    <h1>Hello World 12</h1>

    <p>
        This view is loaded from module: {!! config('admin.name') !!}
    </p>
@endsection
