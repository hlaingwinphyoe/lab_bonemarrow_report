@extends('layouts.app')

@section("title") Profile : {{ env('app_name') }} @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-6 col-xxl-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h4 class="text-capitalize fw-bold">
                                        Profile Name
                                    </h4>
                                </div>
                                <form action="{{ route('profile.changeName') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="name" value="{{ auth()->user()->name }}">
                                        <label for="floatingInput"><i class="me-1 fa-regular fa-user"></i>Your Name</label>
                                        @error("name")
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
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
                                    <h4 class="text-capitalize fw-bold">
                                        Profile Email
                                    </h4>
                                </div>
                                <form action="{{ route('profile.changeEmail') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="email" value="{{ auth()->user()->email }}">
                                        <label for="floatingInput"><i class="me-1 fa-regular fa-envelope"></i>Email</label>
                                        @error("email")
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
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
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-4">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h4 class="text-capitalize fw-bold">
                                Profile Photo
                            </h4>
                        </div>
                        <div class="text-center mt-3">
                            <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile_thumbnails/'.Auth::user()->photo) : asset('images/user_default.png') }}" style="width: 130px;height: 130px" class="rounded-circle my-2 border border-2 p-1 border-primary" alt="">
                        </div>
                        <form action="{{ route('profile.changePhoto') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="file-upload mt-3">
                                <button class="file-upload__button" type="button">Choose File</button>
                                <span class="file-upload__label"></span>

                                <input type="file" name="profile_photo" id="inputPhotos" class="file-upload__input @error('profile_photo') is-invalid @enderror" accept="image/jpeg,image/png">
                                @error('profile_photo')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <hr>
                            <button class="btn btn-primary text-uppercase"><i class="fa-solid fa-upload me-1"></i>Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-4">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h4 class="text-capitalize fw-bold">
                                Change Password
                            </h4>
                        </div>

                        <form action="{{ route('profile.changePassword') }}" id="changeForm" method="post">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="floatingInput" placeholder="current_password">
                                <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>Current Password</label>
                                @error("current_password")
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="floatingInput" placeholder="new_password">
                                <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>New Password</label>
                                @error("new_password")
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="new_confirm_password" class="form-control @error('new_confirm_password') is-invalid @enderror" id="floatingInput" placeholder="new_confirm_password">
                                <label for="floatingInput"><i class="me-1 fa-solid fa-key"></i>Confirm New Password</label>
                                @error("new_confirm_password")
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
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
        <div class="col-12 col-md-6 col-xxl-4">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h4 class="text-capitalize fw-bold">
                                Signature Photo
                            </h4>
                        </div>
                        @if(isset(Auth::user()->signature))
                        <div class="text-center mt-3">
                            <img src="{{ asset('storage/signature_thumbnails/'.Auth::user()->signature) }}" style="width: 100px;height: 70px" class="rounded my-2 border border-2 p-1 border-primary" alt="">
                        </div>
                        @endif
                        <form action="{{ route('profile.signature_thumbnails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="file-upload mt-3">
                                <button class="file-upload__button" type="button">Choose File</button>
                                <span class="file-upload__label"></span>

                                <input type="file" name="signature" id="inputPhotos" class="file-upload__input @error('signature_thumbnails') is-invalid @enderror" accept="image/jpeg,image/png">
                                @error('signature_thumbnails')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
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



