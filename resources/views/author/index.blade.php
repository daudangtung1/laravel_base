@extends('layouts.author.master')
@push('styles')
<style>
    .a1 {
        color: red;
    }
</style>
@endpush
@section('content')
<p class="a1">abcxyz</p>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let a1 = $('.a1');
        a1.on('click', function() {
            console.log('a1 clicked');
        });
    });
</script>
@endpush