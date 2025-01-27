@extends('core::layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Default form</h4>
                <p class="card-description"> Basic form layout </p>
                <form class="forms-sample">
                    <x-second-demo
                        :placeholder="'Username'"
                        :title="'Username'"
                        :name="'username'"
                        :value="$author->user_name ?? ''"
                        :id="'username'"
                        :type="'text'">
                    </x-second-demo>
                    <x-buttons.submit>
                        <x-slot name="name">Submit</x-slot>
                    </x-buttons.submit>
                    <a class="btn btn-light" href="{{ URL::previous() }}">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection