@extends('layouts.app')
@section('title') Users : {{ env('APP_NAME') }} @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h4 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-users me-1 text-primary"></i>
                            Users
                        </h4>
                    </div>
                    <hr>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-2 text-uppercase" style="border-radius: 0.2rem;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-plus fa-fw" title="create"></i> Create
                    </button>
                    <!-- Create Hospital Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-plus text-primary me-1"></i>Create User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('register.post') }}" id="createHospitalForm" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" value="{{ old('name') }}">
                                                <label for="name">User Name</label>
                                                @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" value="{{ old('email') }}">
                                                <label for="email">Email</label>
                                                @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password" value="{{ old('password') }}">
                                                <label for="password">Password</label>
                                                @error('password')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-white text-uppercase" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary text-uppercase" form="createHospitalForm"><i class="fa-solid fa-save me-1"></i>Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Control</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role ?? $user->role == 1 ? 'User':'' }}</td>
                                <td>
                                    <form action="{{ route('user.destroy',$user->id) }}" id="delForm{{ $user->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <form action="{{ route('user.makeAdmin') }}" method="post" id="makeAdminForm{{ $user->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                    </form>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm" title="Delete" form="delForm{{ $user->id }}" onclick="return askConfirm({{ $user->id }})">
                                            <i class="fa-regular fa-trash-alt fa-fw" ></i> Delete
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm" title="Change Role" onclick="return makeAdmin({{ $user->id }})">
                                            <i class="fa-solid fa-user-edit fa-fw"></i> Make Admin
                                        </button>
                                    </div>
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
