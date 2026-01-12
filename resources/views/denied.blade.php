@extends('layouts.app')
@section('title') Page Not Found | Biopsy Reports @endsection
@section('content')
    <!-- 404 Start -->
    <div class="container">
        <div class="row my-3 align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center">
                <img src="{{ asset('404.png') }}" class="w-100" alt="">
                <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website!
                    Maybe go to our home page.</p>
                <a class="btn btn-primary py-3 px-5" href="{{ route('index') }}">Go Back To Home</a>
            </div>
        </div>
    </div>
    <!-- 404 End -->
@stop
