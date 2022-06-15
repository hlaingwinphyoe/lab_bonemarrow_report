<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print : Trephine Report</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <style>
        .print-table tr{
            font-size: 12px !important;
        }

        .print-header span{
            font-size: 12px !important;
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
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-capitalize text-center mb-0">
                                bone marrow trephine report
                            </h3>
                            <h5 class="text-center text-uppercase mb-0">ICSH Guidelines</h5>
                        </div>
                        <p>
                            {!! DNS2D::getBarcodeSVG('https://bonemarrowreport.com/trephine-print/'.$patientFact->slug, 'DATAMATRIX',3,3) !!}
                        </p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-uppercase mb-0">Patient's Particulars</h6>
                            <div class="ms-3 mt-2">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Name: &nbsp;</span>
                                            <span>{{ $patientFact->patient_name }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Refer Doctor: &nbsp;</span>
                                            <span>{{ $patientFact->doctor }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Age: &nbsp;</span>
                                            <span>{{ $patientFact->age }} {{ $patientFact->age_type }}</span>
                                        </div>
                                        <div class="print-header">
                                            <span class="first">Gender: &nbsp;</span>
                                            <span>{{ $patientFact->gender }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="print-header">
                                            <span class="first">Schedule Date: &nbsp;</span>
                                            <span>{{ date('d / M / Y',strtotime($patientFact->sc_date)) }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="print-header">
                                            <span class="first">Address: &nbsp;</span>
                                            <span>{{ $patientFact->contact_detail ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="print-header my-1">
                                            <span class="first d-block">Photos: &nbsp;</span>
                                            <span>
                                                @forelse($patientFact->trephinePhotos as $key=>$photo)
                                                    <img src="{{ asset('storage/trephine_thumbnails/'.$photo->name) }}" class="rounded shadow-sm" height="100" alt="image alt"/>
                                                @empty
                                                @endforelse
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-borderless print-table">
                                    <tbody>
                                    <tr>
                                        <td class="fw-bold text-capitalize title text-nowrap">Name of institution</td>
                                        <td class="result">{{ $patientFact->hospital->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Laboratory Accession Number</td>
                                        <td class="result">{{ $patientFact->lab_access }}</td>
                                    </tr>

                                    <tr>
                                        <td class="fw-bold text-capitalize title">physician name</td>
                                        <td class="result">{{ $patientFact->physician_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Significant clinical history</td>
                                        <td class="result">{{ $patientFact->clinical_history ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td class="fw-bold text-capitalize title">Indication for bone marrow examination</td>
                                        <td class="result">{{ $patientFact->bmexamination ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Procedure performed</td>
                                        <td class="result">{{ $patientFact->pro_perform ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Anatomic site of aspirate/biopsy</td>
                                        <td class="result">{{ $patientFact->anatomic_site_trephine ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Ease/difficulty of aspiration</td>
                                        <td class="result">{{ $patientFact->biopsy_core ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Blood count</td>
                                        <td class="result">{{ $patientFact->ade_macro_appearance ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Blood smear description and diagnostic conclusion</td>
                                        <td class="result">{{ $patientFact->percentage_cellularity ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Cellularity of particles and cell trails</td>
                                        <td class="result">{{ $patientFact->bone_architecture ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Nucleated differential cell count</td>
                                        <td class="result">{{ $patientFact->path ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Total number of cells counted</td>
                                        <td class="result">{{ $patientFact->tre_number ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Myeloid:erythroid ratio</td>
                                        <td class="result">{{ $patientFact->erythroid ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Erythropoiesis</td>
                                        <td class="result">{{ $patientFact->myeloid ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Myelopoiesis</td>
                                        <td class="result">{{ $patientFact->megaka ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Megakaryocytes</td>
                                        <td class="result">{{ $patientFact->lymphoid ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Lymphocytes</td>
                                        <td class="result">{{ $patientFact->plasma_cell ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Plasma cells</td>
                                        <td class="result">{{ $patientFact->macrophages ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Other haemopoietic cells</td>
                                        <td class="result">{{ $patientFact->abnormal_cell ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Abnormal cells</td>
                                        <td class="result">{{ $patientFact->reticulin_stain ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Iron Stain</td>
                                        <td class="result">{{ $patientFact->immunohistochemistry ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Cytochemistry</td>
                                        <td class="result">{{ $patientFact->histochemistry ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Other investigations</td>
                                        <td class="result">{{ $patientFact->investigation ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Conclusion</td>
                                        <td class="result">{{ $patientFact->conclusion ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Disease code</td>
                                        <td class="result">{{ $patientFact->disease_code ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-capitalize title">Authorize By</td>
                                        @if(isset($patientFact->user->signature))
                                            <td class="result"><img src="{{ asset('storage/signature_thumbnails/'.$patientFact->user->signature) }}" style="width: 50px;height: 30px" alt=""></td>
                                        @else
                                            <td class="result">{{ $patientFact->user->name }}</td>
                                        @endif
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
</div>

<script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
