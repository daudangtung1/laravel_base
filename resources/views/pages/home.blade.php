@extends('layouts.app')
@push('styles')
<style>
    .bg-red {
        background: red;
    }

    .bg-gray {
        background: gray;
    }

    #notification {
        width: 10px;
        height: 10px;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div id="notification" class="bg-gray"></div>
    <div id="a1"></div>
    <div class="notification"></div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#notification').on('click', function() {
            $(this).removeClass('bg-red').addClass('bg-gray');
        });

        var pusher = new Pusher(pusherAppKey, {
            cluster: pusherCluster
        });

        var channel = pusher.subscribe('art-app-channel');
        channel.bind('art-app-event', function(data) {
            $('#a1').text(JSON.stringify(data));
            $('#notification').removeClass('bg-gray').addClass('bg-red');
        });

        let contactChannel = pusher.subscribe('contact-channel');
        contactChannel.bind('contact-event', function(data) {
            $('.notification').text(JSON.stringify(data));
        });
    });
</script>
@endpush