@extends('layouts.app')
@section('title') Approve Cyto : 550MCH Biopsy Reports @endsection
@section('content')
    <div class="d-block d-lg-none">
        <div class="fab btn btn-danger">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="mobile-menu">
            @can('write cyto')
                <a href="{{ route('cyto.create') }}" class="mobile-menu-item plus btn btn-primary shadow"><i class="fa-solid fa-plus"></i></a>
            @endcan
            <a href="#" class="mobile-menu-item search btn btn-info shadow" data-mdb-toggle="modal" data-mdb-target="#searchModal"><i class="fa-solid fa-search"></i></a>
            <a href="{{ route('report.toApproveCyto') }}" class="mobile-menu-item refresh btn btn-success shadow"><i class="fa-solid fa-refresh"></i></a>
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
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                Cyto Report Lists
                            </h4>
                            <p class="ms-2 mb-0 d-none d-lg-block" style="font-size: 15px">
                                Showing <span class="badge badge-primary py-1 px-2 mx-2">{{ $cytos->count() }}</span> Of Total <span class="badge badge-primary py-1 px-2 mx-2">{{ $cytos->total() }}</span> To Approve Reports
                            </p>
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <form method="get" class="d-none d-lg-block">
                        <div class="row">
                            <div class="col-6 col-xl-3">
                                <div class="mb-2 mt-1">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Patient Name" value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <div class="mb-2">
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
                                <div class="mb-2 mt-1">
                                    <input type="text" class="form-control" name="start_date" id="startDate" placeholder="YYYY/MM/DD" value="{{ request()->start_date }}">
                                </div>
                            </div>
                            <div class="col-6 col-xl-2">
                                <div class="mb-2 mt-1">
                                    <input type="text" class="form-control" name="end_date" id="endDate" placeholder="YYYY/MM/DD" value="{{ request()->end_date }}">
                                </div>
                            </div>
                            <div class="col-6 col-xl-2">
                                <button class="btn btn-info text-uppercase px-4 d-inline">Filter</button>
                                <a href="{{ route('report.toApproveCyto') }}" class="btn btn-danger px-3" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Refresh"><i class="fa-solid fa-refresh"></i></a>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age (Gender)</th>
                            <th>Specimen Type</th>
                            <th>Receive</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
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
                                <td>
                                    {{ $cyto->specimenType->name }}
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
                                <td>
                                    <a href="#" type="button" data-mdb-toggle="modal" data-mdb-target="#detailModal{{ $cyto->id }}">
                                        <img src="{{ asset('images/detail.png') }}" width="20" alt="" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Detail">
                                    </a>
                                    <div class="modal fade" style="z-index: 2019" id="detailModal{{ $cyto->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title ms-3" id="detailModalLabel">
                                                        <span class="text-danger fw-bold">{{ $cyto->name }}</span> -
                                                        <span class="text-secondary small">
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

                                                            @can('edit histo')
                                                                <a href="{{ route('cyto.edit',$cyto->id) }}" class="btn btn-warning btn-sm ms-2">
                                                                    Edit
                                                                </a>
                                                            @endcan

                                                            @if($cyto->is_complete == '0')
                                                                <form action="{{ route('cyto.approved',$cyto->id) }}" method="post" class="d-inline ms-3" id="approveForm{{ $cyto->id }}">
                                                                        @csrf
                                                                        <button class="btn btn-success btn-sm" @if($cyto->is_approve == '0') disabled @endif id="approveBtn{{ $cyto->id }}" onclick="toApprove({{ $cyto->id }})">
                                                                            @if($cyto->is_approve == '0') Approved @else Approve @endif
                                                                        </button>
                                                                    </form>
                                                            @endif
                                                            </span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Hospital</th>
                                                                <td>{{ $cyto->hospital->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Specimen Type</th>
                                                                <td>{{ $cyto->specimenType->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Refer Doctor</th>
                                                                <td>{{ $cyto->doctor }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Receive Date</th>
                                                                <td>{{ $cyto->bio_receive_date }}</td>

                                                            </tr>
                                                            <tr>
                                                                <th>Staining Date</th>
                                                                <td>{{ $cyto->bio_cut_date }}</td>

                                                            </tr>
                                                            <tr>
                                                                <th>Report Date</th>
                                                                <td>{{ $cyto->bio_report_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Morphology</th>
                                                                <td>{{ $cyto->morphology }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Cytological Diagnosis</th>
                                                                <td>{{ $cyto->cyto_diagnosis }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bold">There's no to approve reports. 📜</td>
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

        function toApprove(id){
            let approveForm = document.getElementById('approveForm'+id);
            let approveBtn = document.getElementById('approveBtn'+id);

            approveForm.addEventListener('submit',function (e){
                e.preventDefault();
                $.post($(this).attr('action'),$(this).serialize(),function (response){
                    // console.log(response.data);
                    if (response.status === 'success'){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            title: 'Approved Successful!'
                        })

                        approveBtn.setAttribute('disabled','disabled');
                        approveBtn.innerText = "Approved";

                        Push.create('Bone Marrow Report',{
                            body: response.create,
                            timeout:5000,
                            icon: '{{ asset('images/logo.jpg') }}'
                        })

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Fail',
                            text: 'Something went wrong!',
                        })
                    }
                })
            })
        }

        $('#specimen-select').select2();

        $('#startDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#endDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#specimen-select2').select2();

        $('#mStartDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#mEndDate').datepicker({
            dateFormat : 'yy-mm-dd'
        });

    </script>
@endpush
