@extends('layouts.app')
@section('title') Users : {{ env('APP_NAME') }} @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-users me-1 text-primary"></i>
                            Users
                        </h5>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#userModal" style="width: 125px">
                        <i class="fa-solid fa-plus fa-fw" title="create"></i> Create
                    </button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <!-- Modal -->
                    <div class="modal fade" id="userModal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel"><i class="fa-solid fa-plus me-1"></i>Create User</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('register.post') }}" id="createUserForm" method="post">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label" for="name">User Name</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" value="{{ old('email') }}">
                                            @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password">
                                            @error('password')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Choose Roles</label>
                                            <select id="role" name="role" autocomplete="role-name" class="form-control">
                                                <option selected disabled>Select Roles</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role') ? 'selected':'' }} >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" form="createUserForm">Save</button>
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
                            <th>Permissions</th>
                            <th>Control</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-nowrap">{{ $user->name }}</td>
                                <td class="text-nowrap">{{ $user->email }}</td>
                                <td class="text-nowrap">
                                    @foreach($user->getRoleNames() as $role)
                                        {{ $role }}
                                    @endforeach
                                </td>
                                <td>
                                    @forelse($user->getAllPermissions() as $permission)
                                        <span class="badge badge-primary my-2">
                                            <i class="fa-solid fa-check me-1"></i>{{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="badge badge-danger my-2">
                                            <i class="fa-solid fa-warning me-1"></i>No Permission
                                        </span>
                                    @endforelse
                                </td>
                                <td class="text-nowrap">
                                    <form action="{{ route('user.destroy',$user->id) }}" id="delForm{{ $user->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group">
                                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit">
                                            <i class="fa-solid fa-user-edit fa-fw"></i>
                                        </a>
                                        <button type="button" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete" form="delForm{{ $user->id }}" onclick="return askConfirm({{ $user->id }})">
                                            <i class="fa-regular fa-trash-alt fa-fw" ></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-nowrap">{{ $user->created_at->diffForHumans() }}</td>
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

@push('script')
    <script>
        $("#role").select2();
    </script>
@endpush
