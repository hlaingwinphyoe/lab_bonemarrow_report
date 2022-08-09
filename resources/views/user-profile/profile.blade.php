@extends('layouts.app')

@section("title") Profile : {{ env('app_name') }} @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h5 class="text-capitalize fw-bold">
                                        Profile Name
                                    </h5>
                                </div>
                                <form action="{{ route('profile.changeName') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name" value="{{ auth()->user()->name }}">
                                        <label for="floatingInput"><i class="me-1 fa-regular fa-user"></i>Your Name</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary text-uppercase">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                        Change
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h5 class="text-capitalize fw-bold">
                                        Profile Email
                                    </h5>
                                </div>
                                <form action="{{ route('profile.changeEmail') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="email" value="{{ auth()->user()->email }}">
                                        <label for="floatingInput"><i class="me-1 fa-regular fa-envelope"></i>Email</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary text-uppercase">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                        Change
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h5 class="text-capitalize fw-bold">
                                        Change Password
                                    </h5>
                                </div>

                                <form action="{{ route('profile.changePassword') }}" id="changeForm" method="post">
                                    @csrf
                                    <div class="form-floating mb-4">
                                        <input type="password" name="current_password" class="form-control" id="floatingInput" placeholder="current_password">
                                        <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>Current Password</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" name="new_password" class="form-control" id="floatingInput" placeholder="new_password">
                                        <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>New Password</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" name="new_confirm_password" class="form-control " id="floatingInput" placeholder="new_confirm_password">
                                        <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>Confirm New Password</label>

                                    </div>
                                    <button type="button" class="btn btn-primary text-uppercase" onclick="return changeConfirm()">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                        Change
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h5 class="text-capitalize fw-bold">
                                Profile Photo
                            </h5>
                        </div>
                        <div class="mt-3">
                            <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile_thumbnails/'.Auth::user()->photo) : asset('images/user_default.png') }}" id="preview" style="width: 130px;height: 130px" class="rounded-circle my-2 border border-2 p-1 border-primary" alt="">
                        </div>
                        <form action="{{ route('profile.changePhoto') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="file-upload mt-3">
                                <button class="file-upload__button btn btn-danger" type="button">Choose File</button>
                                <span class="file-upload__label"></span>
                                <input type="file" name="profile_photo" id="upload" class="file-upload__input" accept="image/jpeg,image/png">
                            </div>
                            <hr>
                            <button class="btn btn-primary text-uppercase"><i class="fa-solid fa-upload me-1"></i>Upload</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h5 class="text-capitalize fw-bold">
                                Signature Photo
                            </h5>
                        </div>
                        @if(isset(Auth::user()->signature))
                            <div class="mt-3">
                                <img src="{{ asset('storage/signature_thumbnails/'.Auth::user()->signature) }}" style="width: 100px;height: 70px" id="sg-preview" class="rounded my-2 border border-2 p-1 border-primary" alt="">
                            </div>
                        @endif
                        <form action="{{ route('profile.signature_thumbnails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="file-upload mt-3">
                                <button class="file-upload__button btn btn-danger" type="button">Choose File</button>
                                <span class="file-upload__label"></span>

                                <input type="file" name="signature" id="sg-upload" class="file-upload__input" accept="image/jpeg,image/png">
                            </div>
                            <hr>
                            <button class="btn btn-primary text-uppercase"><i class="fa-solid fa-upload me-1"></i>Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



