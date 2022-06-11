@extends('layouts.app')
@section('title') User Register : {{ env('APP_NAME') }} @endsection
@section('head')
    <style>
        .auth-btn{
            background: #6f42c1;
            border-color: #6f42c1;
            color: #fff;
        }
        .auth-btn:hover{
            background: #8338ec;
            color: #fff;
        }
        .auth-btn:active{
            background: #6f42c190;
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
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg  bg-white">
                <div class="text-center mt-5">
                    <h3 class="text-uppercase" style="color: #5a23c8">User Register</h3>
                </div>
                <form action="">
                    <div class="p-4">

                        <div class="input-group mb-3">
                                <span class="input-group-text auth-btn">
                                    <i class="fa-solid fa-user-plus text-white"></i>
                                </span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                                <span class="input-group-text auth-btn">
                                    <i class="fa-solid fa-key text-white"></i>
                                </span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label>
                        </div>
                        <button class="btn text-center mt-2 mb-3 auth-btn text-uppercase" type="submit">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
