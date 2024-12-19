@extends('core::layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Acitvity</h4>
            <p class="card-description">Activity log</code>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Log</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>IP address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity )
                    <tr>
                        <td>{{ $activity->description}}</td>
                        <td>{{ $activity->time }}</td>
                        <td>{{ $activity->date }}</td>
                        <td>{{ $activity->ip }}</td>
                    </tr>
                    @empty
                    <tr>
                        Data not found
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection