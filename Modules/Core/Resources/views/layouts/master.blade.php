<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Module Core</title>

    @include('core::layouts.partials.style')
</head>

<body>
    <div class="container-scroller">
        @include('core::layouts.header')

        <div class="container-fluid page-body-wrapper">
            @include('core::layouts.partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('core::layouts.footer')
            </div>
        </div>
    </div>
</body>
@include('core::layouts.partials.script')
@stack('scripts')
<script>    
    $(document).ready(function(){
        let currentYear = new Date().getFullYear();
        $('#footer-content').text(`Copyright © ` + currentYear + `. All rights reserved.`)
    });
</script>

</html>