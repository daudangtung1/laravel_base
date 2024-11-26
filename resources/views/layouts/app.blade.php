<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        .bg-light {
            background-color: #eae9e9 !important;
        }
    </style>
    @stack('styles')
</head>

<body>
    <header></header>
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
</body>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    let pusherAppKey = "{{ config('broadcasting.connections.pusher.key') }}";
    let pusherCluster = "{{ config('broadcasting.connections.pusher.options.cluster') }}";
</script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@stack('scripts')

</html>