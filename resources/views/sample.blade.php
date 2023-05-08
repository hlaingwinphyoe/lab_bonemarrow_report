@extends('layouts.app')
@section('title') Total Sales : 550MCH Biopsy Reports @endsection

@section('content')
    <div class="row p-2">
        <div class="col-12">
            <div class="mb-3">
                <h4 class="text-dark mb-2">
                    <i class="fa-solid fa-box-archive me-1"></i>
                    Total Sales
                </h4>
                {{--                <p class="ms-4">From <span class="fw-bold text-dark">{{ $first }}</span> To <span class="fw-bold text-dark">{{ $currentDate }}</span></p>--}}
            </div>
            <div class="row mb-4">
                <div class="col-xxl-3 col-lg-6">
                    <a class="card sale-card border-top border-2 border-primary" href="{{ route('aspirate.index') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4>Aspirate</h4>
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-dollar me-2"></i>
                                        Total Sales
                                    </h6>
                                    <h4 class="text-primary fw-bold mb-0">
                                        {{ $aspirateTotal }} Ks
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/aspirate_sale.png') }}" height="100" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6">
                    <a class="card sale-card border-top border-2 border-success" href="{{ route('trephine.index') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="text-success">Trephine</h4>
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-dollar me-2"></i>
                                        Total Sales
                                    </h6>
                                    <h4 class="text-success fw-bold mb-0 trephine">
                                        {{ $trephineTotal }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/trephine_sale.png') }}" height="100" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6">
                    <a class="card sale-card border-top border-2 border-danger" href="{{ route('histo') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="text-danger">Histo</h4>
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-dollar me-2"></i>
                                        Total Sales
                                    </h6>
                                    <h4 class="text-danger fw-bold mb-0 histo">
                                        {{ $trephineTotal }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/histo_sale.png') }}" height="100" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6">
                    <a class="card sale-card border-top border-2 border-warning" href="{{ route('cyto') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="text-warning">Cyto</h4>
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-dollar me-2"></i>
                                        Total Sales
                                    </h6>
                                    <h4 class="text-warning fw-bold mb-0 cyto">
                                        {{ $trephineTotal }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/cyto_sale.png') }}" height="100" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            {{--            <div class="row mb-3">--}}
            {{--                <div class="col-12 col-lg-4">--}}
            {{--                    <div class="d-md-flex d-none">--}}
            {{--                        <form action="" method="get" class="d-flex align-items-end">--}}
            {{--                            <div class="me-2">--}}
            {{--                                <label for="datepicker" class="form-label">From Date</label>--}}
            {{--                                <input type="date" class="form-control @error('start') is-invalid @enderror" placeholder="dd/MM/YYYY" name="start" value="{{ request()->start }}">--}}
            {{--                            </div>--}}
            {{--                            <div class="me-2">--}}
            {{--                                <label for="datepicker" class="form-label">To Date</label>--}}
            {{--                                <input type="date" class="form-control @error('end') is-invalid @enderror" placeholder="dd/MM/YYYY" name="end" value="{{ request()->end }}">--}}
            {{--                            </div>--}}
            {{--                            <button type="submit" class="btn btn-primary">Filter</button>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            
        </div>
    </div>
@stop
