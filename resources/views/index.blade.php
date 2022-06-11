@extends('layouts.app')

@section('content')
    <div class="row align-items-end">
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fa-solid fa-th-list text-primary me-1"></i> Aspirate Report Lists
                        </h4>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('aspirate.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="Search..." id="search" name="search" onfocus="this.value=''">
                        </div>
                    </div>
                    <table class="table table-hover  mb-3" id="search_list">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Schedule</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($aspirates as $aspirate)
                            <tr>
                                <td class="text-nowrap">{{ $aspirate->patient_name }}</td>
                                <td class="text-nowrap">
                                    @forelse($aspirate->aspiratePhotos as $key=>$photo)
                                        @if($key == 4)
                                            @break
                                        @endif
                                        <a class="venobox list-thumbnail" data-gall="aspirate{{ $aspirate->id }}" href="{{ asset('storage/aspirate_photos/'.$photo->name) }}">
                                            <img src="{{ asset('storage/aspirate_thumbnails/'.$photo->name) }}" class="rounded-circle shadow-sm" height="35" alt="image alt"/>
                                        </a>
                                    @empty
                                        <p class="mb-0 text-muted">No Photo</p>
                                    @endforelse
                                </td>
                                <td class="text-nowrap">{{ $aspirate->user->name ?? 'Unknown Owner' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('aspirate.print',$aspirate->slug) }}" class="btn btn-outline-primary btn-sm" title="Print">
                                            <i class="fa-solid fa-print fa-fw"></i>
                                        </a>
                                        @can('update',$aspirate)
                                            <a href="{{ route('aspirate.edit',$aspirate->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                                <td>{{ date('d M Y',strtotime($aspirate->sc_date)) }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center fw-bold">There's no reports. 📜</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        {{ $aspirates->appends(request()->all())->links() }}
                        <p class="mb-0 fw-bolder h5">Total : {{ $aspirates->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fa-solid fa-th-list text-primary me-1"></i> Trephine Report Lists
                        </h4>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <a href="{{ route('trephine.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Schedule</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($trephines as $trephine)
                            <tr>
                                <td class="text-nowrap">{{ $trephine->patient_name }}</td>
                                <td class="text-nowrap">
                                    @forelse($trephine->trephinePhotos as $key=>$photo)
                                        @if($key == 4)
                                            @break
                                        @endif
                                        <a class="venobox list-thumbnail" data-gall="trephine{{ $trephine->id }}" href="{{ asset('storage/trephine_photos/'.$photo->name) }}">
                                            <img src="{{ asset('storage/trephine_thumbnails/'.$photo->name) }}" class="rounded-circle shadow-sm" height="35" alt="image alt"/>
                                        </a>
                                    @empty
                                        <p class="mb-0 text-muted">No Photo</p>
                                    @endforelse
                                </td>
                                <td class="text-nowrap">{{ $trephine->user->name ?? 'Unknown Owner' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('trephine.print',$trephine->slug) }}" class="btn btn-outline-primary btn-sm" title="Print">
                                            <i class="fa-solid fa-print fa-fw"></i>
                                        </a>
                                        @can('update',$trephine)
                                            <a href="{{ route('trephine.edit',$trephine->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                                <td>{{ date('d M Y',strtotime($trephine->sc_date)) }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center fw-bold">There's no reports. 📜</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        {{ $trephines->appends(request()->all())->links() }}
                        <p class="mb-0 fw-bolder h5">Total : {{ $trephines->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fa-solid fa-th-list text-primary me-1"></i> Histo Report Lists
                        </h4>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <a href="{{ route('histo.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Receive</th>
                            <th>Cutting</th>
                            <th>Report</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($histos as $histo)
                            <tr>
                                <td class="text-nowrap">{{ $histo->name }}</td>
                                <td class="text-nowrap">
                                    @forelse($histo->histoPhotos as $key=>$photo)
                                        @if($key == 4)
                                            @break
                                        @endif
                                        <a class="venobox list-thumbnail" data-gall="histo{{ $histo->id }}" href="{{ asset('storage/histo_photos/'.$photo->name) }}">
                                            <img src="{{ asset('storage/histo_thumbnails/'.$photo->name) }}" class="rounded-circle shadow-sm" height="35" alt="image alt"/>
                                        </a>
                                    @empty
                                        <p class="mb-0 text-muted">No Photo</p>
                                    @endforelse
                                </td>
                                <td>{{ date('j/n/Y',strtotime($histo->bio_receive_date)) }}</td>
                                <td>{{ date('j/n/Y',strtotime($histo->bio_cut_date)) }}</td>
                                <td>{{ date('j/n/Y',strtotime($histo->bio_report_date)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('histo.print',$histo->slug) }}" class="btn btn-outline-primary btn-sm" title="Print">
                                            <i class="fa-solid fa-print fa-fw"></i>
                                        </a>
                                        @can('update',$histo)
                                            <a href="{{ route('histo.edit',$histo->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </a>
                                        @endcan
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
                    <div class="d-flex justify-content-between align-items-center">
                        {{ $histos->appends(request()->all())->links() }}
                        <p class="mb-0 fw-bolder h5">Total : {{ $histos->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fa-solid fa-th-list text-primary me-1"></i> Cyto Report Lists
                        </h4>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <a href="{{ route('cyto.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-hover  mb-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Receive</th>
                            <th>Cutting</th>
                            <th>Report</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cytos as $cyto)
                            <tr>
                                <td class="text-nowrap">{{ $cyto->name }}</td>
                                <td class="text-nowrap">
                                    @forelse($cyto->cytoPhotos as $key=>$photo)
                                        @if($key == 4)
                                            @break
                                        @endif
                                        <a class="venobox list-thumbnail" data-gall="cyto{{ $cyto->id }}" href="{{ asset('storage/cyto_photos/'.$photo->name) }}">
                                            <img src="{{ asset('storage/cyto_thumbnails/'.$photo->name) }}" class="rounded-circle shadow-sm" height="35" alt="image alt"/>
                                        </a>
                                    @empty
                                        <p class="mb-0 text-muted">No Photo</p>
                                    @endforelse
                                </td>
                                <td>{{ date('j/n/Y',strtotime($cyto->bio_receive_date)) }}</td>
                                <td>{{ date('j/n/Y',strtotime($cyto->bio_cut_date)) }}</td>
                                <td>{{ date('j/n/Y',strtotime($cyto->bio_report_date)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('cyto.print',$cyto->slug) }}" class="btn btn-outline-primary btn-sm" title="Print">
                                            <i class="fa-solid fa-print fa-fw"></i>
                                        </a>
                                        @can('update',$cyto)
                                            <a href="{{ route('cyto.edit',$cyto->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </a>
                                        @endcan
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
                    <div class="d-flex justify-content-between align-items-center">
                        {{ $cytos->appends(request()->all())->links() }}
                        <p class="mb-0 fw-bolder h5">Total : {{ $cytos->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
