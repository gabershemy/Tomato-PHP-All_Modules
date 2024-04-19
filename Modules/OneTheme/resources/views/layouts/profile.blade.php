@extends('one-theme::layouts.master')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <div class="col-span-8">
            @yield('body')
        </div>
    </div>
@endsection
