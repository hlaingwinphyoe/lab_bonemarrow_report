<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print : Cyto Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
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
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="ms-5 mt-2">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Name: &nbsp;</span>
                                            <span class="second">{{ $patientFact->name }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Referring Doctor: &nbsp;</span>
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
                                            Cytopathology report
                                        </h3>
                                        <p>
                                            {!! DNS2D::getBarcodeHTML('http://127.0.0.1:8000/cyto-print/'.$patientFact->slug, 'QRCODE',3,3,'black') !!}
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="print-header my-1">
                                            <span class="first d-block mb-1 text-decoration-underline">Description</span>
                                            <div class="">
                                                @forelse($patientFact->cytoPhotos as $key=>$photo)
                                                    <img src="{{ asset('storage/cyto_thumbnails/'.$photo->name) }}" class="rounded shadow-sm mb-1" height="130" alt="image alt"/>
                                                @empty

                                                @endforelse
                                            </div>
                                            <div class="">
                                                {{ $patientFact->description }}
                                            </div>
                                        </div>
                                        <div class="print-header my-1">
                                            <span class="first d-block text-decoration-underline">Cytological Diagnosis</span>
                                            <span>{{ $patientFact->cyto_diagnosis }}</span>
                                        </div>
                                        <div class="print-header mt-2">
                                            <span class="first ">Authorize By: </span>
                                            @if(isset($patientFact->user->signature))
                                                <span><img src="{{ asset('storage/signature_thumbnails/'.$patientFact->user->signature) }}" style="width: 70px;height: 40px" alt=""></span>
                                            @else
                                                <span>{{ $patientFact->user->name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
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
