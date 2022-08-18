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
            <div class="row">
                <div class="col-xxl-3 col-lg-6 mb-4">
                    <a class="sale-card" href="{{ route('index') }}">
                        <h3>Aspirate</h3>
                        <p class="small mb-1">Total Sales - <span class="fw-bold aspirate">0 Ks</span></p>
                        <p class="small mb-1">Total Reports - <span class="fw-bold">{{ $aspirates->count() }}</span></p>
                        <div class="dimmer"></div>
                        <div class="go-corner" href="{{ route('index') }}">
                            <div class="go-arrow">
                                →
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6 mb-4">
                    <a class="sale-card" href="{{ route('trephine.index') }}">
                        <h3>Trephine</h3>
                        <p class="small mb-1">Total Sales - <span class="fw-bold trephine">0 Ks</span></p>
                        <p class="small mb-1">Total Reports - <span class="fw-bold">{{ $trephines->count() }}</span></p>
                        <div class="dimmer"></div>
                        <div class="go-corner" href="{{ route('trephine.index') }}">
                            <div class="go-arrow">
                                →
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6 mb-4">
                    <a class="sale-card" href="{{ route('histo.index') }}">
                        <h3>Histo</h3>
                        <p class="small mb-1">Total Sales - <span class="fw-bold histo">0 Ks</span></p>
                        <p class="small mb-1">Total Reports - <span class="fw-bold">{{ $histos->count() }}</span></p>
                        <div class="dimmer"></div>
                        <div class="go-corner" href="{{ route('histo.index') }}">
                            <div class="go-arrow">
                                →
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-lg-6 mb-4">
                    <a class="sale-card" href="{{ route('cyto.index') }}">
                        <h3>Cyto</h3>
                        <p class="small mb-1">Total Sales - <span class="fw-bold cyto">0 Ks</span></p>
                        <p class="small mb-1">Total Reports - <span class="fw-bold">{{ $cytos->count() }}</span></p>
                        <div class="dimmer"></div>
                        <div class="go-corner" href="{{ route('cyto.index') }}">
                            <div class="go-arrow">
                                →
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
