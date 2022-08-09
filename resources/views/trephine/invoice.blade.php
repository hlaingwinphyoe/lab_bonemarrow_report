<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice : Trephine Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <style>

        @media print{
            @page{
                margin: 10px 0.2in !important;
            }
        }


        ::-webkit-scrollbar{
            position: absolute;
            top: 0;
            float: right;
            width: 6px;
            background-clip: padding-box;
        }
        ::-webkit-scrollbar-thumb{
            background-color: rgb(66, 66, 66);
            border: 1px solid rgb(255, 255, 255);
            border-radius: 5px;
        }

    </style>
</head>
<body onload="print()" oncontextmenu="return false">
<div class="container">
    <div class="row vh-100 position-relative">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="mb-2 position-relative">
                        <a href="{{ route('index') }}" class="btn btn-primary back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center">
                            <div class="">
                                <img src="{{ asset('images/header.jpg') }}" style="width: 130px" alt="">
                            </div>
                            <div class="ms-2">
                                <p class="mb-2" style="font-size: 2rem">ချမ်းမြေ့ရောဂါရှာဖွေရေး ဓါတ်ခွဲခန်း</p>
                                <p class="mb-0" style="font-size: 12px">12E, 68 Street,Between 29th & 30th Street, Mandalay. Ph: 09974478264, 0933763367</p>
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
                                    {!! DNS2D::getBarcodeSVG('https://bonemarrowreport.com/trephine-print/'.$invoice->slug, 'DATAMATRIX',3,3) !!}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="">
                                    <span>Name: &nbsp;</span>
                                    <span class="fw-bold">{{ $invoice->patient_name }}</span>
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
                                        <td class="text-end">{{ $invoice->specimenType->price }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end fw-bold" style="border: none">Total - </td>
                                        <td class="text-end fw-bold" style="border: none">{{ $invoice->specimenType->price }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center text-uppercase fw-bold fst-italic" style="border: none;">"Thanks For Choosing Our Lab"</td>
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
