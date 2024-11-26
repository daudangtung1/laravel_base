@extends('layouts.app')

@section('content')
<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
    </div>
    <button type="submit">Submit</button>
</form>
@endsection