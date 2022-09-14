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
                                    <h4 class="text-primary fw-bold mb-0 aspirate">
                                        0 Ks
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
                                    <h4 class="text-success fw-bold mb-0 aspirate">
                                        0 Ks
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
                                        0 Ks
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
                                        0 Ks
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
                @if($aspirates->count() > 0)
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Aspirate Sales</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="priceTable">
                                <thead>
                                <tr>
                                    <th>Specimen Type</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($specimens as $specimen)
                                    <tr id="aspirate">
                                        <td>{{ $specimen->name }}</td>
                                        <td class="text-end" id="price">{{ $specimen->price }}</td>
                                        <td class="text-end" id="count">{{ $specimen->aspirates_count }}</td>
                                        <td id="loop" class="text-end">{{ $specimen->price * $specimen->aspirates_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">There's no record!</td>
                                    </tr>
                                @endforelse
                                <tr style="font-size: 16px;font-weight: bold">
                                    <td class="text-center" colspan="2">Total</td>
                                    <td class="text-end">{{ $aspirates->count() }}</td>
                                    <td id="total"  class="text-end"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if($trephines->count() > 0)
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Trephine Sales</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="priceTable">
                                <thead>
                                <tr>
                                    <th>Specimen Type</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($specimens as $specimen)
                                    <tr id="aspirate">
                                        <td>{{ $specimen->name }}</td>
                                        <td class="text-end" id="price">{{ $specimen->price }}</td>
                                        <td class="text-end" id="count">{{ $specimen->trephines_count }}</td>
                                        <td id="loop1" class="text-end">{{ $specimen->trephines_count * $specimen->price }} Ks</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">There's no record!</td>
                                    </tr>
                                @endforelse
                                <tr style="font-size: 16px;font-weight: bold">
                                    <td class="text-center" colspan="2">Total</td>
                                    <td class="text-end">{{ $trephines->count() }}</td>
                                    <td id="tre_total"  class="text-end"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if($histos->count() > 0)
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Histo Sales</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="priceTable">
                                <thead>
                                <tr>
                                    <th>Specimen Type</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($specimens as $specimen)
                                    <tr id="aspirate">
                                        <td>{{ $specimen->name }}</td>
                                        <td class="text-end" id="price">{{ $specimen->price }}</td>
                                        <td class="text-end" id="count">{{ $specimen->histos_count }}</td>
                                        <td id="loop2" class="text-end">{{ $specimen->histos_count * $specimen->price }} Ks</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">There's no record!</td>
                                    </tr>
                                @endforelse
                                <tr style="font-size: 16px;font-weight: bold">
                                    <td class="text-center" colspan="2">Total</td>
                                    <td class="text-end">{{ $histos->count() }}</td>
                                    <td id="histo_total"  class="text-end"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if($cytos->count() > 0)
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Cyto Sales</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="priceTable">
                                <thead>
                                <tr>
                                    <th>Specimen Type</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($specimens as $specimen)
                                    <tr id="aspirate">
                                        <td>{{ $specimen->name }}</td>
                                        <td class="text-end" id="price">{{ $specimen->price }}</td>
                                        <td class="text-end" id="count">{{ $specimen->cytos_count }}</td>
                                        <td id="loop3" class="text-end">{{ $specimen->cytos_count * $specimen->price }} Ks</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">There's no record!</td>
                                    </tr>
                                @endforelse
                                <tr style="font-size: 16px;font-weight: bold">
                                    <td class="text-center" colspan="2">Total</td>
                                    <td class="text-end">{{ $cytos->count() }}</td>
                                    <td id="cyto_total"  class="text-end"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
        $(function() {

            let total = 0;

            $("tr #loop").each(function (index,value){
               currentRow = parseFloat($(this).text());
               total += currentRow;
            });

            document.getElementById('total').innerHTML = Math.abs(Number(total)) >= 1.0e+9
                                                        ? Math.abs(Number(total)) / 1.0e+9 + "B"
                                                        // Six Zeroes for Millions
                                                        : Math.abs(Number(total)) >= 1.0e+6
                                                            ? Math.abs(Number(total)) / 1.0e+6 + "M"
                                                            // Three Zeroes for Thousands
                                                            : Math.abs(Number(total)) >= 1.0e+3
                                                                ? Math.abs(Number(total)) / 1.0e+3 + "K"
                                                                : Math.abs(Number(total));
            $(".sale-card .aspirate").html(Math.abs(Number(total)) >= 1.0e+9
                                            ? Math.abs(Number(total)) / 1.0e+9 + "B"
                                            // Six Zeroes for Millions
                                            : Math.abs(Number(total)) >= 1.0e+6
                                                ? Math.abs(Number(total)) / 1.0e+6 + "M"
                                                // Three Zeroes for Thousands
                                                : Math.abs(Number(total)) >= 1.0e+3
                                                    ? Math.abs(Number(total)) / 1.0e+3 + "K"
                                                    : Math.abs(Number(total)))

        });

        $(function() {

            let tre_total = 0;
            $("tr #loop1").each(function (index,value){
                currentRow = parseFloat($(this).text());
                tre_total += currentRow;
            });

            document.getElementById('tre_total').innerHTML = Math.abs(Number(tre_total)) >= 1.0e+9
                                                            ? Math.abs(Number(tre_total)) / 1.0e+9 + "B"
                                                            // Six Zeroes for Millions
                                                            : Math.abs(Number(tre_total)) >= 1.0e+6
                                                                ? Math.abs(Number(tre_total)) / 1.0e+6 + "M"
                                                                // Three Zeroes for Thousands
                                                                : Math.abs(Number(tre_total)) >= 1.0e+3
                                                                    ? Math.abs(Number(tre_total)) / 1.0e+3 + "K"
                                                                    : Math.abs(Number(tre_total));
            $(".sale-card .trephine").html(Math.abs(Number(tre_total)) >= 1.0e+9
                                            ? Math.abs(Number(tre_total)) / 1.0e+9 + "B"
                                            // Six Zeroes for Millions
                                            : Math.abs(Number(tre_total)) >= 1.0e+6
                                                ? Math.abs(Number(tre_total)) / 1.0e+6 + "M"
                                                // Three Zeroes for Thousands
                                                : Math.abs(Number(tre_total)) >= 1.0e+3
                                                    ? Math.abs(Number(tre_total)) / 1.0e+3 + "K"
                                                    : Math.abs(Number(tre_total)))

        });

        $(function() {

            let histo_total = 0;
            $("tr #loop2").each(function (index,value){
                currentRow = parseFloat($(this).text());
                histo_total += currentRow;
            });

            document.getElementById('histo_total').innerHTML = Math.abs(Number(histo_total)) >= 1.0e+9
                                                                ? Math.abs(Number(histo_total)) / 1.0e+9 + "B"
                                                                // Six Zeroes for Millions
                                                                : Math.abs(Number(histo_total)) >= 1.0e+6
                                                                    ? Math.abs(Number(histo_total)) / 1.0e+6 + "M"
                                                                    // Three Zeroes for Thousands
                                                                    : Math.abs(Number(histo_total)) >= 1.0e+3
                                                                        ? Math.abs(Number(histo_total)) / 1.0e+3 + "K"
                                                                        : Math.abs(Number(histo_total));
            $(".sale-card .histo").html(Math.abs(Number(histo_total)) >= 1.0e+9
                                        ? Math.abs(Number(histo_total)) / 1.0e+9 + "B"
                                        // Six Zeroes for Millions
                                        : Math.abs(Number(histo_total)) >= 1.0e+6
                                            ? Math.abs(Number(histo_total)) / 1.0e+6 + "M"
                                            // Three Zeroes for Thousands
                                            : Math.abs(Number(histo_total)) >= 1.0e+3
                                                ? Math.abs(Number(histo_total)) / 1.0e+3 + "K"
                                                : Math.abs(Number(histo_total)))

        });

        $(function() {

            let cyto_total = 0;
            $("tr #loop3").each(function (index,value){
                currentRow = parseFloat($(this).text());
                cyto_total += currentRow;
            });

            document.getElementById('cyto_total').innerHTML = Math.abs(Number(cyto_total)) >= 1.0e+9
                                                            ? Math.abs(Number(cyto_total)) / 1.0e+9 + "B"
                                                            // Six Zeroes for Millions
                                                            : Math.abs(Number(cyto_total)) >= 1.0e+6
                                                                ? Math.abs(Number(cyto_total)) / 1.0e+6 + "M"
                                                                // Three Zeroes for Thousands
                                                                : Math.abs(Number(cyto_total)) >= 1.0e+3
                                                                    ? Math.abs(Number(cyto_total)) / 1.0e+3 + "K"
                                                                    : Math.abs(Number(cyto_total));
            $(".sale-card .cyto").html(Math.abs(Number(cyto_total)) >= 1.0e+9
                                        ? Math.abs(Number(cyto_total)) / 1.0e+9 + "B"
                                        // Six Zeroes for Millions
                                        : Math.abs(Number(cyto_total)) >= 1.0e+6
                                            ? Math.abs(Number(cyto_total)) / 1.0e+6 + "M"
                                            // Three Zeroes for Thousands
                                            : Math.abs(Number(cyto_total)) >= 1.0e+3
                                                ? Math.abs(Number(cyto_total)) / 1.0e+3 + "K"
                                                : Math.abs(Number(cyto_total)))

        });
    </script>
@endpush
