@extends('layouts.app')
@section('title') 550MCH Biopsy Reports @endsection

@section('content')
    <div class="row align-items-end">
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fa-solid fa-th-list text-primary me-1"></i>
                                Aspirate Report Lists
                            </h4>
                            <h5 class="mb-0 badge bg-primary ms-1">{{ $aspirates->total() }}</h5>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('aspirate.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                            @isset(request()->aspirateSearch)
                                <a href="{{ route("index") }}" class="btn btn-outline-primary btn-sm mb-3 me-2">
                                    <i class="feather-list"></i>
                                    All Reports
                                </a>
                                <span>Search By : <b>" {{ request()->aspirateSearch }} "</b></span>
                            @endisset
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
                                        <a href="{{ route('aspirate.invoice',$aspirate->id) }}" class="btn btn-outline-primary btn-sm" title="Invoice">
                                            <i class="fa-solid fa-receipt text-success"></i>
                                        </a>
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Print">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('aspirate.print',$aspirate->id) }}">
                                                    With Header
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('aspirate.without.print',$aspirate->id) }}">
                                                    Without Header
                                                </a>
                                            </li>
                                        </ul>
                                        @can('update',$aspirate)
                                            <a href="{{ route('aspirate.edit',$aspirate->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen text-info"></i>
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
                    {{ $aspirates->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fa-solid fa-th-list text-primary me-1"></i>
                                Trephine Report Lists
                            </h4>
                            <h5 class="mb-0 badge bg-primary ms-1">{{ $trephines->total() }}</h5>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('trephine.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                            @isset(request()->trephineSearch)
                                <a href="{{ route("index") }}" class="btn btn-outline-primary btn-sm mb-3 me-2">
                                    <i class="feather-list"></i>
                                    All Reports
                                </a>
                                <span>Search By : <b>" {{ request()->trephineSearch }} "</b></span>
                            @endisset
                        </div>
                        <div class="mb-2">
                            <form method="get" class="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="trephineSearch" value="{{ request()->trephineSearch }}" placeholder="Search Something...">
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
                                        <a href="{{ route('trephine.invoice',$trephine->id) }}" class="btn btn-outline-primary btn-sm" title="Invoice">
                                            <i class="fa-solid fa-receipt text-success"></i>
                                        </a>
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Print">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('trephine.print',$trephine->id) }}">
                                                    With Header
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('trephine.without.print',$trephine->id) }}">
                                                    Without Header
                                                </a>
                                            </li>
                                        </ul>
                                        @can('update',$trephine)
                                            <a href="{{ route('trephine.edit',$trephine->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen text-info" ></i>
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
                    {{ $trephines->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fa-solid fa-th-list text-primary me-1"></i>
                                Histo Report Lists
                            </h4>
                            <h5 class="mb-0 badge bg-primary ms-1">{{ $histos->total() }}</h5>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('histo.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                            @isset(request()->histoSearch)
                                <a href="{{ route("index") }}" class="btn btn-outline-primary btn-sm mb-3 me-2">
                                    <i class="feather-list"></i>
                                    All Reports
                                </a>
                                <span>Search By : <b>" {{ request()->histoSearch }} "</b></span>
                            @endisset
                        </div>
                        <div class="mb-2">
                            <form method="get" class="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="histoSearch" value="{{ request()->histoSearch }}" placeholder="Search Something...">
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
                                <td>{{ date('j/n/y',strtotime($histo->bio_receive_date)) }}</td>
                                <td>{{ date('j/n/y',strtotime($histo->bio_cut_date)) }}</td>
                                <td>{{ date('j/n/y',strtotime($histo->bio_report_date)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('histo.invoice',$histo->id) }}" class="btn btn-outline-primary btn-sm" title="Invoice">
                                            <i class="fa-solid fa-receipt text-success"></i>
                                        </a>
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Print">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('histo.print',$histo->id) }}">
                                                    With Header
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('histo.without.print',$histo->id) }}">
                                                    Without Header
                                                </a>
                                            </li>
                                        </ul>
                                        @can('update',$histo)
                                            <a href="{{ route('histo.edit',$histo->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen text-info"></i>
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
                    {{ $histos->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fa-solid fa-th-list text-primary me-1"></i>
                                Cyto Report Lists
                            </h4>
                            <h5 class="mb-0 badge bg-primary ms-1">{{ $cytos->total() }}</h5>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm full-screen-btn" >
                            <i class="fa-solid fa-maximize" title="maximize"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('cyto.create') }}" class="btn btn-sm btn-primary mb-3 text-uppercase"><i class="fa fa-plus"></i> Create</a>
                            @isset(request()->cytoSearch)
                                <a href="{{ route("index") }}" class="btn btn-outline-primary btn-sm mb-3 me-2">
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
                                <td>{{ date('j/n/y',strtotime($cyto->bio_receive_date)) }}</td>
                                <td>{{ date('j/n/y',strtotime($cyto->bio_cut_date)) }}</td>
                                <td>{{ date('j/n/y',strtotime($cyto->bio_report_date)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('cyto.invoice',$cyto->id) }}" class="btn btn-outline-primary btn-sm" title="Invoice">
                                            <i class="fa-solid fa-receipt text-success"></i>
                                        </a>
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Print">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cyto.print',$cyto->id) }}">
                                                    With Header
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cyto.without.print',$cyto->id) }}">
                                                    Without Header
                                                </a>
                                            </li>
                                        </ul>
                                        @can('update',$cyto)
                                            <a href="{{ route('cyto.edit',$cyto->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="fa-solid fa-pen text-info"></i>
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
                    {{ $cytos->appends(request()->all())->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
    </div>
@stop

