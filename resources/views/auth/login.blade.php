@extends('layouts.master')
@section('title') Login : {{ env('APP_NAME') }} @endsection
@section('head')
    <style>
        .auth-btn{
            background: #5a23c8;
            border-color: #5a23c8;
            color: #fff;
        }
        .auth-btn:hover{
            background: #5a23c8dd;
            color: #fff;
        }
        .auth-btn:active{
            background: #5a23c890;
        }
        .form-control:focus{
            border-color: #6f42c1;
        }
        ::-webkit-scrollbar{
            position: absolute;
            top: 0;
            float: right;
            width: 6px;
            height: 8px;
            background-clip: padding-box;
        }
        ::-webkit-scrollbar-thumb{
            background-color: rgb(66, 66, 66);
            border: 1px solid rgb(255, 255, 255);
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-white">
                <div class="text-center">
                    <h3 class="text-uppercase" style="color: #5a23c8">Sign In</h3>
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="p-4">
                        <div class="input-group mb-3">
                                <span class="input-group-text auth-btn">
                                    <i class="fa-solid fa-envelope text-white"></i>
                                </span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                                <span class="input-group-text auth-btn">
                                    <i class="fa-solid fa-key text-white"></i>
                                </span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label>
                        </div>
                        <button class="btn text-center mt-2 auth-btn text-uppercase" type="submit">
                            <i class="fa-solid fa-sign-in me-2"></i>Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
