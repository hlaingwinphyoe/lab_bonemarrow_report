@extends('layouts.app')
@section('title') Edit Role : Biopsy Reports @endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
        </ol>
    </nav>
    <div class="row align-items-end">
        <div class="mb-2">
            <a href="{{ route('roles.index') }}" class="btn btn-primary back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                Create Role
                            </h5>
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="">
                        <div class="mb-4">
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label" for="name">Role Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <h5 class="text-dark mb-3">Choose Permissions</h5>
                                @foreach($permissions as $key=>$permission)
                                    @if($key == 0)
                                        <p class="mb-1 fw-bold">Hospital</p>
                                    @endif
                                    @if($key == 3 || $key == 6 || $key == 9 || $key == 12)
                                        <br>
                                        @if($key == 3)
                                            <p class="mb-1 fw-bold">Specimen</p>
                                        @elseif($key == 6)
                                            <p class="mb-1 fw-bold">Role</p>
                                        @elseif($key == 9)
                                            <p class="mb-1 fw-bold">Histo</p>
                                        @elseif($key == 12)
                                            <p class="mb-1 fw-bold">Cyto</p>
                                        @endif
                                    @endif
                                    <div class="form-check form-check-inline mb-4">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" {{ old('permissions') ? 'checked':'' }} name="permissions[]" id="permission{{ $permission->id }}">
                                        <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                                <br>
                                <button class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>Create</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
        $("#permission").select2();
    </script>
@endpush
