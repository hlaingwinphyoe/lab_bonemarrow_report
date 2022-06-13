@extends('layouts.app')
@section('title') Create : Cyto Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Cyto Report</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h4 class="text-capitalize fw-bold">
                            Cyto report
                        </h4>
                    </div>
                    <hr>

                    <form action="{{ route('cyto.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-5">
                            <div class="col-12 col-lg-6 right-divider">
                                <div class="mb-3">
                                    <div class="file-upload mt-3">

                                        <button class="file-upload__button" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>

                                        <input type="file" name="cyto_photos[]" id="inputPhotos" class="file-upload__input @error('cyto_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                        @error('cyto_photos')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        @error('cyto_photos.*')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Hospital</label>
                                    <select class="form-select @error('hospital') is-invalid @enderror" name="hospital" aria-label="Default select example">
                                        <option selected>Select Hospital</option>
                                        @forelse(\App\Models\Hospital::all() as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital') ? 'selected':'' }}>{{ $hospital->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('hospital')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name">Patient's Name</label>
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" value="{{ old('name') }}">
                                        <label for="name">Enter Patient's Name</label>
                                        @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="">Age</label>
                                            <div class="form-floating">
                                                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age" placeholder="age" value="{{ old('age') }}">
                                                <label for="age">Enter Age</label>
                                                @error('age')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Age Type</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type') == 'D' ? 'checked':'' }} type="radio" name="age_type" id="d" value="D">
                                                <label class="form-check-label" for="d">Day</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type') == 'M' ? 'checked':'' }} type="radio" name="age_type" id="m" value="M">
                                                <label class="form-check-label" for="m">Month</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type') == 'Yr' ? 'checked':'' }} type="radio" name="age_type" id="yr" value="Yr">
                                                <label class="form-check-label" for="yr">Year</label>
                                            </div>
                                            <br>
                                            @error('age_type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="">Gender</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('gender') == 'Male' ? 'checked':'' }} type="radio" name="gender" id="genderM" value="Male">
                                        <label class="form-check-label" for="genderM">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('gender') == 'Female' ? 'checked':'' }} type="radio" name="gender" id="genderF" value="Female">
                                        <label class="form-check-label" for="genderF">Female</label>
                                    </div>
                                    <br>
                                    @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="doctor">Referring Doctor</label>
                                    <div class="form-floating">
                                        <input type="text" name="doctor" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="doctor" value="{{ old('doctor') }}">
                                        <label for="doctor">Enter Referring Doctor</label>
                                        @error('doctor')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="datepicker3">Biopsy Receive Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_receive_date') is-invalid @enderror" id="datepicker3" placeholder="dd/MM/YYYY" name="bio_receive_date" value="{{ old('bio_receive_date') }}">
                                        @error('bio_receive_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="datepicker4">Biopsy Cutting Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_cut_date') is-invalid @enderror" id="datepicker4" placeholder="dd/MM/YYYY" name="bio_cut_date" value="{{ old('bio_cut_date') }}">
                                        @error('bio_cut_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="datepicker5">Biopsy Report Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_report_date') is-invalid @enderror" id="datepicker5" placeholder="dd/MM/YYYY" name="bio_report_date" value="{{ old('bio_report_date') }}">
                                        @error('bio_report_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <hr>
                                <div class="mb-3">
                                    <label for="specimen" class="form-label">Specimen</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('specimen') is-invalid @enderror" name="specimen" id="specimen" placeholder="Enter Specimen" style="height: 180px">{{ old('specimen') }}</textarea>
                                        <label for="specimen">Enter Specimen</label>
                                        @error('specimen')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="morphology" class="form-label">Morphology</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('morphology') is-invalid @enderror" name="morphology" id="morphology" placeholder="Enter Morphology" style="height: 180px">{{ old('morphology') }}</textarea>
                                        <label for="morphology">Enter Morphology</label>
                                        @error('morphology')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="cyto_diagnosis" class="form-label">Cytological Diagnosis</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('cyto_diagnosis') is-invalid @enderror" name="cyto_diagnosis" id="cyto_diagnosis" placeholder="Enter Cytological Diagnosis" style="height: 180px">{{ old('cyto_diagnosis') }}</textarea>
                                        <label for="cyto_diagnosis">Enter Cytological Diagnosis</label>
                                        @error('cyto_diagnosis')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary text-uppercase text-white"><i class="fa fa-save me-2"></i>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
        $('#datepicker3').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#datepicker4').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#datepicker5').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    </script>
@endpush
