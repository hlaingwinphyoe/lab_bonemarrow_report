@extends('layouts.app')
@section('title') Trephine : 550MCH Biopsy Reports @endsection

@section('content')
    <div class="d-block d-lg-none">
        <div class="fab btn btn-danger">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="mobile-menu">
            @can('write trephine')
                <a href="{{ route('trephine.create') }}" class="mobile-menu-item plus btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            @endcan
            <a href="#" class="mobile-menu-item search btn btn-info" data-mdb-toggle="modal" data-mdb-target="#searchModal"><i class="fa-solid fa-search"></i></a>
            @if($trephines->count() > 0)
                <a href="{{ route('trephine.export') }}" class="mobile-menu-item excel btn btn-light"><img src="{{ asset('images/excel.png') }}" width="25" alt=""></a>
            @endif
            <a href="{{ route('trephine.index') }}" class="mobile-menu-item refresh btn btn-success"><i class="fa-solid fa-refresh"></i></a>
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
                                Trephine Report Lists
                            </h5>
                            <p class="ms-2 mb-0 d-none d-lg-block" style="font-size: 15px">
                                Showing <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $trephines->count() }}</span> Of Total <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $trephines->total() }}</span> Reports
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
                                    <div class="col-6 col-xl-2">
                                        <div class="d-flex">
                                            @can('write trephine')
                                                <a href="{{ route('trephine.create') }}" class="btn btn-primary mb-3" style="width: 125px"><i class="fa fa-plus me-1"></i> Create</a>
                                            @endcan
                                            @if($trephines->count() > 0)
                                                <a href="{{ route('trephine.export') }}" class="btn btn-success mb-3 ms-2" style="width: 125px"><img src="{{ asset('images/excel.png') }}" width="15" alt=""> Export</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2 p-0">
                                        <div class="mx-4 mb-2 mt-1">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Patient Name" value="{{ request()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2 p-0">
                                        <div class="mx-4 mb-2">
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
                                    <div class="col-6 col-xl-2 p-0">
                                        <div class="mx-4 mb-2 mt-1">
                                            <input type="text" class="form-control" name="start_date" id="startDate" placeholder="YYYY/MM/DD" value="{{ request()->start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2 p-0">
                                        <div class="mx-4 mb-2 mt-1">
                                            <input type="text" class="form-control" name="end_date" id="endDate" placeholder="YYYY/MM/DD" value="{{ request()->end_date }}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-2 p-0">
                                        <button class="btn btn-info text-uppercase px-4 d-inline">Filter</button>
                                        <a href="{{ route('trephine.index') }}" class="btn btn-danger px-3" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Refresh"><i class="fa-solid fa-refresh"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age (Gender)</th>
                            <th>Type</th>
                            <th>Specimen Type</th>
                            <th>Receive</th>
                            <th>Photos</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($trephines as $trephine)
                            <tr>
                                <td class="text-nowrap">{{ $trephine->patient_name }}</td>
                                <td class="text-nowrap">
                                    @if(!$trephine->year == 0)
                                        {{ $trephine->year }}Yr
                                    @endif
                                    @if(!$trephine->month == 0)
                                        {{ $trephine->month }}M
                                    @endif
                                    @if(!$trephine->day == 0)
                                        {{ $trephine->day }}D
                                    @endif
                                    ({{ $trephine->gender }})
                                </td>
                                <td class="text-nowrap">{{ $trephine->pro_perform }}</td>
                                <td class="text-nowrap">{{ $trephine->specimenType->name }}</td>
                                <td>{{ date('j M Y',strtotime($trephine->sc_date)) }}</td>
                                <td class="text-nowrap">
                                    @forelse($trephine->trephinePhotos as $key=>$photo)
                                        @if($key == 4)
                                            @break
                                        @endif
                                        <a class="venobox list-thumbnail" data-gall="trephine{{ $trephine->id }}" href="{{ asset('storage/trephine_photos/'.$photo->name) }}">
                                            <img src="{{ asset('storage/trephine_thumbnails/'.$photo->name) }}" class="rounded-circle shadow-sm" height="35" alt="image alt"/>
                                        </a>
                                    @empty
                                        <p class="mb-0 text-muted small">No Photo</p>
                                    @endforelse
                                </td>
                                <td>{{ $trephine->created_at->format('j M Y') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('trephine.destroy',$trephine->id) }}" id="delForm{{ $trephine->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <a class="btn btn-light btn-sm" href="{{ route('trephine.invoice',$trephine->id) }}" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Receipt">
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>
                                        @can('edit trephine')
                                            <a href="{{ route('trephine.edit',$trephine->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        @endcan
                                        @can('delete trephine')
                                            <a href="#" class="btn btn-light btn-sm" form="delForm{{ $trephine->id }}" onclick="return askConfirm({{ $trephine->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
                                                <i class="fa-regular fa-trash-alt"></i>
                                            </a>
                                        @endcan
                                        <div class="btn-group" role="group">
                                            <button
                                                id="btnGroupDrop1"
                                                type="button"
                                                class="btn btn-light btn-sm"
                                                data-mdb-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                <img src="{{ asset('images/printer.png') }}" width="15" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Print" alt="">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="{{ route('trephine.print',$trephine->id) }}">With Header</a></li>
                                                <li><a class="dropdown-item" href="{{ route('trephine.without.print',$trephine->id) }}">Without Header</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center fw-bold">There's no reports. 📜</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>{{ $trephines->appends(request()->all())->onEachSide(1)->links() }}</p>
                        <p class="ms-2 mb-0 d-block d-lg-none" style="font-size: 15px">
                            Showing <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $trephines->count() }}</span> Of Total <span class="badge badge-primary py-1 px-2 mx-2 mb-1">{{ $trephines->total() }}</span> Reports
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
        $('#specimen-select2').select2();
        $('#startDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#endDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#mStartDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#mEndDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    </script>
@endpush
