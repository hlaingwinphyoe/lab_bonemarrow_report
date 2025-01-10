@extends('layouts.app')
@section('title') Create : Specimen @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Specimens</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-money-check-dollar me-1 text-primary"></i>
                            Specimens
                        </h5>
                    </div>
                    <hr>
                    <!-- Button trigger modal -->
                    @if(auth()->user()->role == 0)
                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#specimenModal" style="width: 125px">
                        <i class="fa-solid fa-plus fa-fw" title="create"></i> Create
                    </button>
                    @endif
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
                    <div class="modal fade" id="specimenModal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="specimenModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="specimenModalLabel"><i class="fa-solid fa-plus me-1"></i>Create Specimen</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('specimen_type.store') }}" id="createSpecimenForm" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="specimens" placeholder="specimens" value="{{ old('name') }}">
                                                <label for="specimens">Specimen Name</label>
                                                @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="number" name="price" min="0" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="price" value="{{ old('price') }}">
                                                <label for="price">Price</label>
                                                @error('price')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" form="createSpecimenForm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Specimen</th>
                            <th>Price</th>
                            <th>Creator</th>
                            <th>Control</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($specimens as $specimen)
                            <tr>
                                <td>{{ $specimen->name }}</td>
                                <td>{{ $specimen->price }}</td>
                                <td>{{ $specimen->user->name }}</td>
                                <td>
                                    <form action="{{ route('specimen_type.destroy',$specimen->id) }}" id="delForm{{ $specimen->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group">
                                        @can('delete specimen')
                                            <a href="#" class="btn btn-light btn-sm" form="delForm{{ $specimen->id }}" onclick="return askConfirm({{ $specimen->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
                                                <i class="fa-regular fa-trash-alt fa-fw" title="Delete"></i>
                                            </a>
                                        @endcan
                                        @can('edit specimen')
                                        <!-- Button trigger modal -->
                                            <a href="#" class="btn btn-light btn-sm" data-mdb-toggle="modal" data-mdb-target="#editSpecimenModal{{ $specimen->id }}">
                                                <i class="fa-solid fa-pen fa-fw"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editSpecimenModal{{ $specimen->id }}" tabindex="-1" aria-labelledby="editSpecimenModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSpecimenModalLabel"><i class="fa-solid fa-pen me-1"></i>Edit Specimen</h5>
                                                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('specimen_type.update',$specimen->id) }}" id="editSpecimenForm{{ $specimen->id }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="specimens" placeholder="specimens" value="{{ old('name',$specimen->name) }}">
                                                                    <label for="specimens">Specimen Name</label>
                                                                    @error('name')
                                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="number" name="price" min="0" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="price" value="{{ old('price',$specimen->price) }}">
                                                                        <label for="price">Price</label>
                                                                        @error('price')
                                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary" form="editSpecimenForm{{ $specimen->id }}">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button trigger modal -->
                                        @endcan
                                    </div>
                                </td>
                                <td>{{ $specimen->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center fw-bold">There's no specimen type!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
