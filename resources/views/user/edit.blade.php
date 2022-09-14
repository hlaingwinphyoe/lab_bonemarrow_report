@extends('layouts.app')
@section('title') Edit Role : 550MCH Biopsy Reports @endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>
    <div class="row align-items-end">
        <div class="mb-2">
            <a href="{{ route('users') }}" class="btn btn-primary back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                Edit User
                            </h5>
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="">
                        <form action="{{ route('user.update',$user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-4">
                                <label class="form-label text-dark" for="name">User Name</label>
                                <input type="text" name="name" disabled class="form-control text-black-50 @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name',$user->name) }}">
                                @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-dark" for="email">Email</label>
                                <input type="text" name="email" disabled class="form-control text-black-50 @error('email') is-invalid @enderror" id="email" placeholder="email" value="{{ old('email',$user->email) }}">
                                @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label text-dark">Choose Roles</label>
                                <select id="role" name="role" autocomplete="role-name" class="form-control">
                                    <option selected disabled>Select Roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected':'' }} >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-3"><i class="fa-solid fa-save me-1"></i>Update</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@push('script')
    <script>
        $("#role").select2();
    </script>
@endpush
