@extends('layouts.master')
@section('title') Trephine : Biopsy Reports @endsection

@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="row p-0 m-0">
            <div class="col-12 p-0 m-0">
                <!-- Navbar -->
            @include('front_navbar')
            <!-- Navbar -->
                <div class="container">
                    <div class="row align-items-end my-3">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mb-0 fw-bold">
                                                <i class="fa-solid fa-align-left text-primary me-1"></i>
                                                Trephine Report Lists
                                            </h5>
                                        </div>
                                        <button type="button" class="btn btn-link btn-sm full-screen-btn" >
                                            <i class="fa-solid fa-expand "  data-mdb-toggle="tooltip" title="Maximize" style="font-size: 16px"></i>
                                        </button>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="mb-2">
                                            <form>
                                                <div class="input-group">
                                                    <div class="form-outline">
                                                        <input type="search" name="search" value="{{ request()->search }}" class="form-control" />
                                                        <label class="form-label" for="form1">Search</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @isset(request()->search)
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route("trephine") }}" class="btn btn-secondary mb-3 me-2">
                                                <i class="feather-list"></i>
                                                All Reports
                                            </a>
                                            <p>Search By : <b>" {{ request()->search }} "</b></p>
                                        </div>
                                    @endisset
                                    <table class="table table-hover mb-3">
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
                                                <td class="text-nowrap">{{ $trephine->doctor }}</td>
                                                <td class="text-nowrap">{{ $trephine->pro_perform }}</td>
                                                <td class="text-nowrap">{{ $trephine->specimenType->name }}</td>
                                                <td class="text-success text-nowrap">{{ $trephine->specimenType->price }} Ks</td>
                                                <td>{{ date('j M Y',strtotime($trephine->sc_date)) }} ({{ date('D',strtotime($trephine->sc_date)) }})</td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ route('trephine.invoice',$trephine->id) }}" class="btn btn-light btn-sm" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Receipt">
                                                        <i class="fa-solid fa-receipt me-1"></i> Voucher
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center fw-bold">There's no reports. 📜</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{ $trephines->appends(request()->all())->onEachSide(1)->links() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
