@extends('layouts.app')
@section('title') Aspirate : 550MCH Biopsy Reports @endsection

@section('content')
    <div class="row align-items-end">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                Aspirate Report Lists
                            </h5>
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-2">
                            <a href="{{ route('aspirate.create') }}" class="btn btn-primary mb-3" style="width: 125px"><i class="fa fa-plus me-1"></i> Create</a>
                        </div>
                        <div class="mb-2">
                            <form method="get" class="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="aspirateSearch" value="{{ request()->aspirateSearch }}" placeholder="Search Something...">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fa-solid fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset(request()->aspirateSearch)
                        <div class="d-flex align-items-center">
                            <a href="{{ route("index") }}" class="btn btn-secondary mb-3 me-2">
                                <i class="feather-list"></i>
                                All Reports
                            </a>
                            <p>Search By : <b>" {{ request()->aspirateSearch }} "</b></p>
                        </div>
                    @endisset
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age (Gender)</th>
                            <th>Refer Doctor</th>
                            <th>Type</th>
                            <th>Specimen Type</th>
                            <th>Price</th>
                            <th>Receive</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($aspirates as $aspirate)
                            <tr>
                                <td class="text-nowrap">{{ $aspirate->patient_name }}</td>
                                <td class="text-nowrap">
                                    @if(!$aspirate->year == 0)
                                        {{ $aspirate->year }}Yr
                                    @endif
                                    @if(!$aspirate->month == 0)
                                        {{ $aspirate->month }}M
                                    @endif
                                    @if(!$aspirate->day == 0)
                                        {{ $aspirate->day }}D
                                    @endif
                                    ({{ $aspirate->gender }})
                                </td>
                                <td class="text-nowrap">{{ $aspirate->doctor }}</td>
                                <td>{{ $aspirate->pro_perform }}</td>
                                <td>{{ $aspirate->specimenType->name }}</td>
                                <td class="text-success text-nowrap">{{ $aspirate->specimenType->price }} Ks</td>

                                <td>{{ date('j M Y',strtotime($aspirate->sc_date)) }} ({{ date('D',strtotime($aspirate->sc_date)) }})</td>
                                <td class="text-center">
                                    <form action="{{ route('aspirate.destroy',$aspirate->id) }}" id="delForm{{ $aspirate->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        @can('update',$aspirate)
                                            <a href="{{ route('aspirate.edit',$aspirate->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        @endcan
                                        @can('delete',$aspirate)
                                            <a href="#" class="btn btn-light btn-sm" form="delForm{{ $aspirate->id }}" onclick="return askConfirm({{ $aspirate->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
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
                                                <i class="fa-solid fa-print" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Print"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="{{ route('aspirate.invoice',$aspirate->id) }}">Receipt Voucher</a></li>
                                                <li><a class="dropdown-item" href="{{ route('aspirate.print',$aspirate->id) }}">With Header</a></li>
                                                <li><a class="dropdown-item" href="{{ route('aspirate.without.print',$aspirate->id) }}">Without Header</a></li>
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
                    {{ $aspirates->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
    </div>
@stop

