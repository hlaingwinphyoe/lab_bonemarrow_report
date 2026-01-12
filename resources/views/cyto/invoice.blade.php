<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice : Cyto Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="icon" href="{{ $clinicInfo && $clinicInfo->logo ? asset('storage/' . $clinicInfo->logo) : asset('images/logo.png') }}">
    <style>

        @media print{
            @page{
                margin: 10px 0.2in !important;
            }
        }
    </style>
</head>
<body oncontextmenu="return false">
<div class="container">
    <div class="row vh-100 position-relative">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="mb-2 position-relative">
                        <a href="{{ route('cyto.index') }}" class="btn btn-primary back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center">
                            <div class="">
                                <img src="{{ $clinicInfo && $clinicInfo->logo ? asset('storage/' . $clinicInfo->logo) : asset('images/logo.png') }}" style="width: 110px" alt="Logo">
                            </div>
                            <div class="ms-2">
                                <p class="mb-0" style="font-size: 2rem">{{ $clinicInfo && $clinicInfo->name ? $clinicInfo->name : "Cellular Pathology" }}</p>
                                <p class="mb-0" style="font-size: 12px">{{ $clinicInfo && $clinicInfo->address ? $clinicInfo->address : "Mandalay, Myanmar" }}. 
                                    @foreach ($clinicInfo->clinic_phones as $phone)
                                        {{ $phone->phone }}
                                        @if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="border-top: 1px solid black"></div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                                <h4 class="text-uppercase mb-0">Receipt</h4>
                                <p class="mb-0">
                                    scan ဖတ်၍ အဖြေကြည့်ရှုနိုင်ပါသည်။ 👉
                                    {!! DNS2D::getBarcodeSVG(config('app.url').'/cyto-print/'.$invoice->id, 'QRCODE',3,3) !!}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="">
                                    <span>Name: &nbsp;</span>
                                    <span class="fw-bold">{{ $invoice->name }}</span>
                                    <br>
                                    <span>Age: </span>
                                    <span class="fw-bold">
                                        @if(!$invoice->year == 0)
                                            {{ $invoice->year }} Yr,
                                        @endif
                                        @if(!$invoice->month == 0)
                                            {{ $invoice->month }} M,
                                        @endif
                                        @if(!$invoice->day == 0)
                                            {{ $invoice->day }} D,
                                        @endif
                                         ({{ $invoice->gender }})
                                    </span>
                                </div>
                                <div class="">
                                    <span>Date: &nbsp;</span>
                                    <span class="fw-bold">{{ date('d / M / Y') }}</span>
                                    <br>
                                    <span class="float-end fw-bold">({{ date('h:i A') }})</span>
                                </div>
                            </div>
                            <div style="border-top: 1px solid #dee2e6"></div>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Specimen Type</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $invoice->specimenType->name }}</td>
                                        <td class="text-end">{{ $invoice->specimenType->price }} Ks</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end fw-bold" style="border: none">Total - </td>
                                        <td class="text-end fw-bold" style="border: none">{{ $invoice->specimenType->price }} Ks</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center text-uppercase fw-bold fst-italic" style="border: none;">"Thanks For Choosing Our Lab"</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end" style="border: none;">
                                            <button class="btn btn-primary" onclick="return print()"><i class="fa-solid fa-print me-1"></i>Print</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
