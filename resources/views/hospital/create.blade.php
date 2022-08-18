@extends('layouts.app')
@section('title') Create : Hospital @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Hospitals</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-regular fa-hospital-alt me-1 text-primary"></i>
                            Hospitals
                        </h5>
                    </div>
                    <hr>
                    <!-- Button trigger modal -->
                    @if(auth()->user()->role == 0)
                        <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#hospitalModal" style="width: 125px">
                            <i class="fa-solid fa-plus fa-fw" title="create"></i> Create
                        </button>
                @endif

                <!-- Modal -->
                    <div class="modal fade" id="hospitalModal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="hospitalModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hospitalModalLabel"><i class="fa-solid fa-plus me-1"></i>Create Hospital</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('hospital.store') }}" id="createHospitalForm" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="hospitals" placeholder="hospitals" value="{{ old('name') }}">
                                                <label for="hospitals">Hospital Name</label>
                                                @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" form="createHospitalForm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Hospitals</th>
                            <th>Creator</th>
                            <th>Control</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(\App\Models\Hospital::all() as $hospital)
                            <tr>
                                <td>{{ $hospital->name }}</td>
                                <td>{{ $hospital->user->name }}</td>
                                <td>
                                    <form action="{{ route('hospital.destroy',$hospital->id) }}" id="delForm{{ $hospital->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group">
                                        @can('delete',$hospital)
                                            <a href="#" class="btn btn-sm btn-light" form="delForm{{ $hospital->id }}" onclick="return askConfirm({{ $hospital->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
                                                <i class="fa-regular fa-trash-alt fa-fw"></i>
                                            </a>
                                        @endcan
                                        @can('update',$hospital)
                                            <!-- Button trigger modal -->
                                                <a href="#" class="btn btn-sm btn-light" data-mdb-toggle="modal" data-mdb-target="#editHospitalModal{{ $hospital->id }}">
                                                    <i class="fa-solid fa-pen fa-fw"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editHospitalModal{{ $hospital->id }}" tabindex="-1" aria-labelledby="editHospitalModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editHospitalModalLabel"><i class="fa-solid fa-pen me-1"></i>Edit Hospital</h5>
                                                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('hospital.update',$hospital->id) }}" id="editHospitalForm{{ $hospital->id }}" method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="form-floating">
                                                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="hospitals" placeholder="hospitals" value="{{ old('name',$hospital->name) }}">
                                                                        <label for="hospitals">Hospital Name</label>
                                                                        @error('name')
                                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary" form="editHospitalForm{{ $hospital->id }}">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Button trigger modal -->
                                        @endcan
                                    </div>
                                </td>
                                <td>{{ $hospital->created_at->diffForHumans() }}</td>
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
