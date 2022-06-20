<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $patientFact->name }} : Histo Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <style>
        .print-header span{
            font-size: 15px !important;
        }

        .print-header .second{
            font-size: 14px !important;
        }

        .print-header .first{
            font-weight: bold;
        }
        @media print{
            @page{
                size: A4;
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
<body onload="print()">
<div class="container">
    <div class="row vh-100 position-relative">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="mb-2">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-2">
                                <div class="row mb-2">
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
                                            <span class="second">{{ $patientFact->age }} {{ $patientFact->age_type }}</span>
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
                                            {!! DNS2D::getBarcodeSVG('https://bonemarrowreport.com/histo-print/'.$patientFact->slug, 'DATAMATRIX',3,3) !!}
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="print-header">
                                            <span class="first d-block text-decoration-underline">Gross</span>
                                            <span class="second">{{ $patientFact->gross ?? '-' }}</span>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block mb-1 text-decoration-underline">Microscopic</span>
                                            <div class="">
                                                @forelse($patientFact->histoPhotos as $key=>$photo)
                                                    <img src="{{ asset('storage/histo_thumbnails/'.$photo->name) }}" class="rounded shadow-sm mb-1" height="130" alt="image alt"/>
                                                @empty

                                                @endforelse
                                            </div>
                                            <div class="">
                                                {{ $patientFact->description }}
                                            </div>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block text-decoration-underline">Remark</span>
                                            <span>{{ $patientFact->remark }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="">
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
