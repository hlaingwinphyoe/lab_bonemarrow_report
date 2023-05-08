@extends('layouts.app')
@section('title') Total Sales : 550MCH Biopsy Reports @endsection

@section('content')
    <div class="row p-2">
        <div class="col-12">
            <div class="mb-3">
                <h4 class="text-dark mb-2">
                    <i class="fa-solid fa-box-archive me-1"></i>
                    Daily Sales
                </h4>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-5">
                    <div class="d-md-flex d-none">
                        <form action="" method="get" class="d-flex align-items-end">
                            <div class="me-4">
                                <label for="datepicker" class="form-label">From Date</label>
                                <input type="text" class="form-control @error('start') is-invalid @enderror" id="sale-picker" placeholder="dd/MM/YYYY" name="start" value="{{ request()->start }}">
                            </div>
                            <div class="me-4">
                                <label for="datepicker" class="form-label">To Date</label>
                                <input type="text" class="form-control @error('end') is-invalid @enderror" id="sale-picker2" placeholder="dd/MM/YYYY" name="end" value="{{ request()->end }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('sales') }}" class="btn btn-danger"><i class="fa-solid fa-refresh"></i></a>
                        </form>
                    </div>
                </div>
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
                                        {{ $trephineTotal }} Ks
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
                                        {{ $histoTotal }} Ks
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
                                        {{ $cytoTotal }} Ks
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

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-hover" id="priceTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Specimen Type</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Aspirate</th>
                                        <th class="text-end">Trephine</th>
                                        <th class="text-end">Histo</th>
                                        <th class="text-end">Cyto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($specimens as $index => $specimen)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $specimen->name }}</td>
                                            <td class="text-end">{{ $specimen->price }}</td>
                                            @if ($specimen->aspirates_count)
                                            <td class="text-end bg-success bg-opacity-25" id="count">{{ $specimen->aspirates_count }}</td>
                                            @else
                                            <td class="text-end">0</td>
                                            @endif
                                            
                                            @if ($specimen->trephines_count)
                                            <td class="text-end bg-success bg-opacity-25" id="count">{{ $specimen->trephines_count }}</td>
                                            @else
                                            <td class="text-end">0</td>
                                            @endif

                                            @if ($specimen->histos_count)
                                            <td class="text-end bg-success bg-opacity-25" id="count">{{ $specimen->histos_count }}</td>
                                            @else
                                            <td class="text-end">0</td>
                                            @endif

                                            @if ($specimen->cytos_count)
                                            <td class="text-end bg-success bg-opacity-25" id="count">{{ $specimen->cytos_count }}</td>
                                            @else
                                            <td class="text-end">0</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">There's no record!</td>
                                        </tr>
                                    @endforelse
                                    <tr style="font-size: 16px;font-weight: bold">
                                        <td class="text-center" colspan="3">Total</td>
                                        <td class="text-end">{{ $aspirateCount }}</td>
                                        <td class="text-end">{{ $trephineCount }}</td>
                                        <td class="text-end">{{ $histoCount }}</td>
                                        <td class="text-end">{{ $cytoCount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@push('script')
    <script>

        $("#sale-picker").datepicker({
            dateFormat : 'yy-mm-dd',
        });
        $("#sale-picker2").datepicker({
            dateFormat : 'yy-mm-dd',
        });
    </script>
@endpush
