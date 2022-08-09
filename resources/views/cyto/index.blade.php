@extends('layouts.app')
@section('title') Cyto : 550MCH Biopsy Reports @endsection

@section('content')
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
                        </div>
                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('cyto.create') }}" class="btn btn-primary mb-3" style="width: 125px"><i class="fa fa-plus me-1"></i> Create</a>
                            @isset(request()->cytoSearch)
                                <a href="{{ route("cyto.index") }}" class="btn btn-secondary btn-sm mb-3 me-2">
                                    <i class="feather-list"></i>
                                    All Reports
                                </a>
                                <span>Search By : <b>" {{ request()->cytoSearch }} "</b></span>
                            @endisset
                        </div>
                        <div class="mb-2">
                            <form method="get" class="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cytoSearch" value="{{ request()->cytoSearch }}" placeholder="Search Something...">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fa-solid fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age (Gender)</th>
                            <th>Refer Doctor</th>
                            <th>Specimen Type</th>
                            <th>Price</th>
                            <th>Receive</th>
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
                                    <br>
                                    ({{ date('D',strtotime($cyto->bio_receive_date)) }})
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('cyto.destroy',$cyto->id) }}" id="delForm{{ $cyto->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        @can('update',$cyto)
                                            <a href="{{ route('cyto.edit',$cyto->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        @endcan
                                        @can('delete',$cyto)
                                            <a href="#" class="btn btn-light btn-sm" form="delForm{{ $cyto->id }}" onclick="return askConfirm({{ $cyto->id }})"  data-mdb-toggle="tooltip" data-mdb-placement="top" title="Delete">
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
                                                <li><a class="dropdown-item" href="{{ route('cyto.invoice',$cyto->id) }}">Receipt Voucher</a></li>
                                                <li><a class="dropdown-item" href="{{ route('cyto.print',$cyto->id) }}">With Header</a></li>
                                                <li><a class="dropdown-item" href="{{ route('cyto.without.print',$cyto->id) }}">Without Header</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center fw-bold">There's no reports. 📜</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $cytos->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
    </div>
@stop

