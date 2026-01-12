@extends('layouts.app')
@section('title') Cyto : Biopsy Reports @endsection

@section('content')
    <div class="d-block d-lg-none">
        <div class="fab btn btn-danger">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="mobile-menu">
            @can('write cyto')
                <a href="{{ route('cyto.create') }}" class="mobile-menu-item plus btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            @endcan
            <a href="#" class="mobile-menu-item search btn btn-info" data-mdb-toggle="modal" data-mdb-target="#searchModal"><i class="fa-solid fa-search"></i></a>
            <a href="{{ route('cyto.index') }}" class="mobile-menu-item refresh btn btn-success"><i class="fa-solid fa-refresh"></i></a>
        </div>
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Search</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" class="d-inline" id="searchForm">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <div class="mx-4 mb-3 mt-1">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Patient Name" value="{{ request()->name }}">
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <div class="mx-4 mb-3">
                                        <select class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select2">
                                            <option selected disabled>Choose Specimen</option>
                                            @forelse($specimens as $specimen)
                                                <option value="{{ $specimen->id }}" {{ $specimen->id == request()->specimen_type ? 'selected':'' }}>{{ $specimen->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('specimen_type')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <div class="mx-4 mb-3">
                                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status-select2">
                                            <option selected disabled>Choose Status</option>
                                            <option value="2" {{ request()->status == '2' ? 'selected':'' }}>Registered</option>
                                            <option value="1" {{ request()->status == '1' ? 'selected':'' }}>Partial Completed</option>
                                        </select>
                                        @error('status')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <div class="mx-4 mb-3 mt-1">
                                        <input type="text" class="form-control" name="start_date" id="mStartDate" placeholder="YYYY/MM/DD" value="{{ request()->start_date }}">
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <div class="mx-4 mb-3 mt-1">
                                        <input type="text" class="form-control" name="end_date" id="mEndDate" placeholder="YYYY/MM/DD" value="{{ request()->end_date }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" form="searchForm" class="btn btn-info">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                Cyto Report Lists
                            </h5>
                            <p class="ms-2 mb-0 d-none d-lg-block" style="font-size: 15px">
                                Showing <span class="badge badge-primary py-1 px-2 mx-2">{{ $cytos->count() }}</span> Of Total <span class="badge badge-primary py-1 px-2 mx-2">{{ $cytos->total() }}</span> Reports
                            </p>
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-12">
                            <form method="get" class="d-inline d-none d-lg-block">
                                <div class="row">
                                    <div class="col-6 col-xl-1">
                                        @can('write cyto')
                                            <a href="{{ route('cyto.create') }}" class="btn btn-primary mb-3" style="width: 125px"><i class="fa fa-plus me-1"></i> Create</a>
                                        @endcan
                                    </div>
                                    <div class="col-6 col-xl-2">
                                        <div class="mx-2 mb-2 mt-1">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Patient Name" value="{{ request()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2">
                                        <div class="mx-2 mb-2">
                                            <select class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select">
                                                <option selected disabled>Choose Specimen</option>
                                                @forelse($specimens as $specimen)
                                                    <option value="{{ $specimen->id }}" {{ $specimen->id == request()->specimen_type ? 'selected':'' }}>{{ $specimen->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('specimen_type')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2">
                                        <div class="mx-2 mb-2">
                                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status-select">
                                                <option selected disabled>Choose Status</option>
                                                <option value="2" {{ request()->status == '2' ? 'selected':'' }}>Registered</option>
                                                <option value="1" {{ request()->status == '1' ? 'selected':'' }}>Partial Completed</option>
                                            </select>
                                            @error('status')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-1 p-0">
                                        <div class=" mt-1 mb-2">
                                            <input type="text" class="form-control" name="start_date" id="startDate" placeholder="YYYY/MM/DD" value="{{ request()->start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-1 p-0">
                                        <div class="mx-1 mt-1 mb-2">
                                            <input type="text" class="form-control" name="end_date" id="endDate" placeholder="YYYY/MM/DD" value="{{ request()->end_date }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2">
                                        <button class="btn btn-info text-uppercase px-4 d-inline">Filter</button>
                                        <a href="{{ route('cyto.index') }}" class="btn btn-danger px-3" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Refresh"><i class="fa-solid fa-refresh"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset(request()->search)
                        <div class="d-flex align-items-center">
                            <a href="{{ route("cyto.index") }}" class="btn btn-secondary mb-3 me-2">
                                <i class="feather-list"></i>
                                All Reports
                            </a>
                            <p>Search By : <b>" {{ request()->search }} "</b></p>
                        </div>
                    @endisset
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age (Gender)</th>
                            <th>Refer Doctor</th>
                            <th>Specimen Type</th>
                            <th>Price</th>
                            <th>Receive</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cytos as $cyto)
                            <tr>
                                <td class="text-nowrap">{{ $cyto->name }}</td>
                                <td class="text-nowrap">
                                    @if(!$cyto->year == 0)
                                        {{ $cyto->year }}Yr
                                    @endif
                                    @if(!$cyto->month == 0)
                                        {{ $cyto->month }}M
                                    @endif
                                    @if(!$cyto->day == 0)
                                        {{ $cyto->day }}D
                                    @endif
                                    ({{ $cyto->gender }})
                                </td>
                                <td>{{ $cyto->doctor }}</td>
                                <td>
                                    {{ $cyto->specimenType->name }}
                                </td>
                                <td class="text-nowrap text-success">
                                    {{ $cyto->specimenType->price }} Ks
                                </td>
                                <td>
                                    {{ date('j M Y',strtotime($cyto->bio_receive_date)) }}
                                </td>
                                <td>
                                    @if($cyto->is_complete == '2')
                                        <span class="badge badge-light my-2">
                                            Registered
                                        </span>
                                    @elseif($cyto->is_complete == '1')
                                        <span class="badge badge-info my-2">
                                            Partial Completed
                                        </span>
                                    @else
                                        <span class="badge badge-success my-2">
                                            Completed
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $cyto->created_at->format('j M Y') }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('cyto.destroy',$cyto->id) }}" id="delForm{{ $cyto->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <a class="btn btn-light btn-sm" href="{{ route('cyto.invoice',$cyto->id) }}" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Voucher">
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>
                                        @can('edit cyto')
                                            <a href="{{ route('cyto.edit',$cyto->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        @endcan
                                        @if($cyto->is_complete == '2')
                                            @can('delete cyto')
                                                <a href="#" class="btn btn-light btn-sm" form="delForm{{ $cyto->id }}" onclick="return askConfirm({{ $cyto->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
                                                    <i class="fa-regular fa-trash-alt"></i>
                                                </a>
                                            @endcan
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center fw-bold">There's no reports. 📜</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>{{ $cytos->appends(request()->all())->onEachSide(1)->links() }}</p>
                        <p class="ms-2 mb-0 d-block d-lg-none" style="font-size: 15px">
                            Showing <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $cytos->count() }}</span> Of Total <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $cytos->total() }}</span> Reports
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
        document.querySelector('.fab').addEventListener('click',function(e){
            document.querySelector('.mobile-menu').classList.toggle('mobile-menu-active');
            document.querySelector('.fab').classList.toggle('fab-active');
        });

        $('#specimen-select').select2();
        $('#status-select').select2();

        $('#startDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#endDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });

        $('#specimen-select2').select2();
        $('#status-select2').select2();

        $('#mStartDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#mEndDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    </script>
@endpush

