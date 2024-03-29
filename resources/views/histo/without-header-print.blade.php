<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print : Histo Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <style>
        .print-header span{
            font-size: 13px !important;
        }

        .print-header .second{
            font-size: 12px !important;
        }

        .print-header .first{
            font-weight: bold;
        }
        @media print{
            @page{
                size: A4;
                margin-top: 2in;
                /* margin: 2in 0in 0in 10px !important; */
            }
        }
    </style>
</head>
<body oncontextmenu="return false">
<div class="container-fluid">
    <div class="row vh-100 position-relative">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="position-relative">
                        <a href="{{ route('histo') }}" class="btn btn-primary back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-2">
                                <div class="row mb-2">
                                    @if($patientFact->is_approve == '0')
                                        <div class="text-end">
                                            <button class="btn btn-primary" onclick="return print()"><i class="fa-solid fa-print me-1"></i>Print</button>
                                        </div>
                                    @endif
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Name: &nbsp;</span>
                                            <span class="second">{{ $patientFact->name }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Refer Doctor: &nbsp;</span>
                                            <span class="second">{{ $patientFact->doctor }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Cutting Date: &nbsp;</span>
                                            <span class="second">{{ date('d / M / Y',strtotime($patientFact->bio_cut_date)) }}</span>
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Age: &nbsp;</span>
                                            <span class="second">
                                                @if(!$patientFact->year == 0)
                                                    {{ $patientFact->year }} Yr
                                                @endif
                                                @if(!$patientFact->month == 0)
                                                    {{ $patientFact->month }} M
                                                @endif
                                                @if(!$patientFact->day == 0)
                                                    {{ $patientFact->day }} D
                                                @endif
                                            </span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Hospital: &nbsp;</span>
                                            <span class="second">{{ $patientFact->hospital->name }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Report Date: &nbsp;</span>
                                            <span class="second">{{ date('d / M / Y',strtotime($patientFact->bio_report_date)) }}</span>
                                        </div>


                                    </div>
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Gender: &nbsp;</span>
                                            <span class="second">{{ $patientFact->gender }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Received Date: &nbsp;</span>
                                            <span class="second">{{ date('d / M / Y',strtotime($patientFact->bio_receive_date)) }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="text-uppercase text-center my-1">
                                            Histopathology report
                                        </h3>
                                        <p>
                                            {!! DNS2D::getBarcodeSVG(config('app.url').'/histo-print/'.$patientFact->id, 'DATAMATRIX',3,3) !!}
                                        </p>
                                    </div>
                                    @if($patientFact->is_approve == '0')
                                    <div class="col-12">
                                        <div class="print-header">
                                            <span class="first">Specimen Type: &nbsp;</span>
                                            <span class="second">{{ $patientFact->specimenType->name }}</span>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block text-decoration-underline">Specimen</span>
                                            <span class="second">{{ $patientFact->specimen ?? '-' }}</span>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block text-decoration-underline">Gross</span>
                                            <div>
                                                @forelse($patientFact->grossPhotos as $key=>$photo)
                                                    <img src="{{ asset('storage/gross_thumbnails/'.$photo->name) }}" class="rounded mb-1" height="130" alt="Histo Image"/>
                                                @empty

                                                @endforelse
                                            </div>
                                            <div class="second">
                                                {{ $patientFact->gross ?? '-' }}
                                            </div>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block mb-1 text-decoration-underline">Microscopic</span>
                                            <div class="">
                                                @forelse($patientFact->histoPhotos as $key=>$photo)
                                                    <img src="{{ asset('storage/histo_thumbnails/'.$photo->name) }}" class="rounded mb-1" height="130" alt="image alt"/>
                                                @empty

                                                @endforelse
                                            </div>
                                            <div class="second">
                                                {{ $patientFact->description }}
                                            </div>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block text-decoration-underline">Remark</span>
                                            <span class="second">{{ $patientFact->remark }}</span>
                                        </div>
                                    </div>
                                    @else
                                        <div class="col-12">
                                            <h3 class="text-center text-dark fw-bold">အဖြေများ ဆောင်ရွက်နေဆဲ ဖြစ်ပါသည်။ </h3>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="" style="font-size: 13px">
                <p class="mb-0">
                    This document is computer-generated and has been approved by authorized pathologists;
                    <br>
                    Dr Ye Thu Win
                    <br>
                    MBBS, MMedSc(Patho), PhD(Patho), IFCAP
                    <br>
                    Senior Consultant Pathologist
                </p>
                <div style="border-top: 2px solid black"></div>
                <p>Thanks for Your Choice of our Laboratory.</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
