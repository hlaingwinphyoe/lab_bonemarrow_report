@extends('layouts.app')
@section('title') Roles : Biopsy Reports @endsection
@section('content')
    <div class="row align-items-end">
        <div class="col-12">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fa-solid fa-align-left text-primary me-1"></i>
                            Roles
                        </h5>
                    </div>
                    <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                        <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                    </button>
                </div>
                <hr>
                @can('write role')
                <div class="me-2">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3" style="width: 125px"><i class="fa fa-plus me-1"></i> Create</a>
                </div>
                @endcan
                <div class="row">
                    @foreach($roles as $role)
                        <div class="col-12 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4 class="text-capitalize text-dark">{{ $role->name }}</h4>
                                    </div>
                                    @if($role->permissions)
                                        @forelse($role->permissions as $role_permission)
                                            <span class="badge badge-primary my-2 text-capitalize">
                                                <i class="fa-solid fa-check me-1"></i>{{ $role_permission->name }}
                                            </span>
                                        @empty
                                            <span class="badge badge-danger my-2">
                                                <i class="fa-solid fa-warning me-1"></i>No Permission Allowed!
                                            </span>
                                        @endforelse
                                    @endif
                                    <hr>
                                    <form action="{{ route('roles.destroy',$role->id) }}" id="delForm{{ $role->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-primary py-2">
                                        <i class="fa-solid fa-pen me-1"></i>Edit
                                    </a>
                                    <button type="button" form="delForm{{ $role->id }}" class="btn btn-danger py-2" onclick="return askConfirm({{ $role->id }})">
                                        <i class="fa-regular fa-trash-alt me-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
