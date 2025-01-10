@extends('layouts.app')
@section('title') 550MCH Biopsy Reports @endsection
@section('head')
    <style>
        #polarChart{
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-12">
            <div class="mb-3">
                <h4 class="text-dark mb-2">
                    <svg width="28px" height="28px" viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Uploaded to SVGRepo https://www.svgrepo.com -->
                        <title>ic_fluent_grid_28_filled</title>
                        <desc>Created with Sketch.</desc>
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_grid_28_filled" fill="#000" fill-rule="nonzero">
                                <path d="M10.75,15 C11.9926407,15 13,16.0073593 13,17.25 L13,22.75 C13,23.9926407 11.9926407,25 10.75,25 L5.25,25 C4.00735931,25 3,23.9926407 3,22.75 L3,17.25 C3,16.0073593 4.00735931,15 5.25,15 L10.75,15 Z M22.75,15 C23.9926407,15 25,16.0073593 25,17.25 L25,22.75 C25,23.9926407 23.9926407,25 22.75,25 L17.25,25 C16.0073593,25 15,23.9926407 15,22.75 L15,17.25 C15,16.0073593 16.0073593,15 17.25,15 L22.75,15 Z M10.75,3 C11.9926407,3 13,4.00735931 13,5.25 L13,10.75 C13,11.9926407 11.9926407,13 10.75,13 L5.25,13 C4.00735931,13 3,11.9926407 3,10.75 L3,5.25 C3,4.00735931 4.00735931,3 5.25,3 L10.75,3 Z M22.75,3 C23.9926407,3 25,4.00735931 25,5.25 L25,10.75 C25,11.9926407 23.9926407,13 22.75,13 L17.25,13 C16.0073593,13 15,11.9926407 15,10.75 L15,5.25 C15,4.00735931 16.0073593,3 17.25,3 L22.75,3 Z" id="🎨-Color"></path>
                            </g>
                        </g>
                    </svg>
                    Dashboard
                </h4>
                <h6 class="ms-4">From <span class="fw-bold text-dark">{{ $first }}</span> To <span class="fw-bold text-dark">{{ $currentDate }}</span></h6>
            </div>
            <div class="row mb-4">
                <div class="col-xxl-3 col-lg-6">
                    <a class="card sale-card border-top border-2 border-primary" href="{{ route('aspirate.index') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4>Aspirate</h4>
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-clipboard-check me-2"></i>
                                       Monthly Registered
                                    </h6>
                                    <h4 class="text-primary fw-bold mb-0">
                                        {{ $aspirates }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/aspirate.png') }}" height="100" alt="">
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
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-clipboard-check me-2"></i>
                                       Monthly Registered
                                    </h6>
                                    <h4 class="text-success fw-bold mb-0">
                                        {{ $trephines }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/trephine.png') }}" height="100" alt="">
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
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-clipboard-check me-2"></i>
                                       Monthly Registered
                                    </h6>
                                    <h4 class="text-danger fw-bold mb-0">
                                        {{ $histos }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/histo.png') }}" height="100" alt="">
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
                                    <h6 class="text-dark small mb-2"><i class="fa-solid fa-clipboard-check me-2"></i>
                                       Monthly Registered
                                    </h6>
                                    <h4 class="text-warning fw-bold mb-0">
                                        {{ $cytos }}
                                    </h4>
                                </div>
                                <div class="">
                                    <img src="{{ asset('images/cyto.png') }}" height="100" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Daily Sales</h4>
                            <canvas id="salesChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Monthly Sales</h4>
                            <canvas id="polarChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>

        let dateArr = {!! json_encode($dateArr) !!};
        const sc = document.getElementById('salesChart');
        let scChart = new Chart(sc, {
            type: 'bar',
            data: {
                labels: dateArr,
                datasets: [
                    {
                        label: 'Aspirate',
                        data: {!! json_encode($aspirateRate) !!},
                        backgroundColor: [
                            '#003eff30',
                        ],
                        borderColor: [
                            '#003eff',
                        ],
                        borderWidth: 1,
                    },
                    {
                        label: 'Trephine',
                        data: {!! json_encode($trephineRate) !!},
                        backgroundColor: [
                            '#28a74530',
                        ],
                        borderColor: [
                            '#28a745',
                        ],
                        borderWidth: 1,
                    },
                    {
                        label: 'Histo',
                        data: {!! json_encode($histoRate) !!},
                        backgroundColor: [
                            '#f9315430',
                        ],
                        borderColor: [
                            '#f93154',
                        ],
                        borderWidth: 1,
                    },
                    {
                        label: 'Cyto',
                        data: {!! json_encode($cytoRate) !!},
                        backgroundColor: [
                            '#ffa90030',
                        ],
                        borderColor: [
                            '#ffa900',
                        ],
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x:  {
                        gridLines: {
                            display : false
                        }
                    }

                },
                legend:{
                    display: true,
                    shape:"circle",
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle:true
                    }
                }
            },
        });

        let reportCount = [{!! json_encode($aspirates) !!},{!! json_encode($trephines) !!},{!! json_encode($histos) !!},{!! json_encode($cytos) !!}];
        let reports = ["Aspirate","Trephine","Histo","Cyto"];

        let pc = document.getElementById('polarChart');
        let pcChart = new Chart(pc, {
            type: 'polarArea',
            data: {
                labels:reports,
                datasets: [{
                    label: '# of Votes',
                    data:reportCount,
                    backgroundColor: [
                        'rgb(0, 62, 255)',
                        'rgb(0, 183, 74)',
                        'rgb(249, 49, 84)',
                        'rgb(255, 169, 0)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: true,
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });
    </script>
@endpush
