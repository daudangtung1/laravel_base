<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>123</title>
    @stack('styles')
</head>

<body>
    @yield('content')
    <script src="{{mix('lib/js/jquery-3.2.1.min.js')}}"></script>
    @stack('scripts')
</body>

</html>