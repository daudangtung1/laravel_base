@extends('core::layouts.master')

@section('content')
<h1>Hello World</h1>
<x-demo />  
<x-second-demo />
<p>
    This view is loaded from module: {!! config('faq.name') !!}
</p>
@endsection 