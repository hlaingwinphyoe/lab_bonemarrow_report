@extends('layouts.app')
@section('title') Create : Aspirate Report @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-plus me-1"></i>create aspirate report
                        </h5>
                    </div>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('aspirate.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <div class="file-upload">

                                        <button class="file-upload__button btn btn-danger" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>

                                        <input type="file" name="aspirate_photos[]" id="inputPhotos" class="file-upload__input @error('aspirate_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                        @error('aspirate_photos')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        @error('aspirate_photos.*')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <div class="">
                                        <label for="patient_name" class="form-label">Patient's Name</label>
                                        <input type="text" name="patient_name" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name" placeholder="Name" value="{{ old('patient_name') }}">
                                        @error('patient_name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="lab_access" class="form-label">Laboratory Accession Number</label>
                                    <div class="">
                                        <input type="number" name="lab_access" min="0" class="form-control @error('lab_access') is-invalid @enderror" id="lab_access" placeholder="Enter Lab Accession Number" value="{{ old('lab_access') }}">
                                        @error('lab_access')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
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
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="datepicker" class="form-label">Date of Procedure</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('sc_date') is-invalid @enderror" id="datepicker" placeholder="dd/MM/YYYY" name="sc_date" value="{{ old('sc_date') }}">
                                        @error('sc_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="year" class="form-label">Year</label>
                                    <div class="">
                                        <input type="number" name="year" min="0" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',0) }}">
                                        @error('year')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label">Procedure Perform</label>
                                    <select class="form-select @error('pro_perform') is-invalid @enderror" name="pro_perform" id="bonemarrow-select">
                                        <option selected disabled>Select Procedure Perform</option>
                                        <option value="Aspirate" {{ old('pro_perform') == 'Aspirate' ? 'selected':'' }}>Aspirate</option>
                                        <option value="Trephine" {{ old('pro_perform') == 'Trephine' ? 'selected':'' }}>Trephine</option>
                                        <option value="Aspirate_Trephine" {{ old('pro_perform') == 'Aspirate_Trephine' ? 'selected':'' }}>Aspirate / Trephine</option>
                                    </select>
                                    @error('pro_perform')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="" class="form-label">Name Of Institute</label>
                                    <select class="form-select @error('hospital') is-invalid @enderror" name="hospital" aria-label="Default select example" id="hospital-select">
                                        <option selected disabled>Select Hospital</option>
                                        @forelse($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital') ? 'selected':'' }}>{{ $hospital->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('hospital')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="month" class="form-label">Month</label>
                                    <div class="">
                                        <input type="number" name="month" min="0" class="form-control @error('month') is-invalid @enderror" id="Month" placeholder="month" value="{{ old('month',0) }}">
                                        @error('month')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="physician_name" class="form-label">Responsible Physician</label>
                                    <div class="">
                                        <input type="text" name="physician_name" class="form-control @error('physician_name') is-invalid @enderror" id="physician_name" placeholder="Enter Physician Name" value="{{ old('physician_name') }}">
                                        @error('physician_name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="" class="form-label">Specimen Type</label>
                                    <select class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select">
                                        <option selected disabled>Select Specimen Type</option>
                                        @forelse($specimens as $specimen)
                                            <option value="{{ $specimen->id }}" {{ $specimen->id == old('specimen_type') ? 'selected':'' }}>{{ $specimen->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('specimen_type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="day" class="form-label">Day</label>
                                    <div class="">
                                        <input type="number" name="day" min="0" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="Day" value="{{ old('day',0) }}">
                                        @error('day')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="doctor" class="form-label">Requesting Doctors</label>
                                    <div class="">
                                        <input type="text" name="doctor" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Refer Doctor" value="{{ old('doctor') }}">
                                        @error('doctor')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-4">
                                    <label for="contact_detail" class="form-label">Contact Details</label>
                                    <div class="">
                                        <textarea class="form-control @error('contact_detail') is-invalid @enderror" name="contact_detail" id="contact_detail" placeholder="Enter Contact Details" style="height: 130px">{{ old('contact_detail') }}</textarea>
                                        @error('contact_detail')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="clinical_history" class="form-label">Clinical History</label>
                                    <div class="">
                                        <textarea class="form-control @error('clinical_history') is-invalid @enderror" name="clinical_history" id="clinical_history" placeholder="Enter clinical history" style="height: 130px">{{ old('clinical_history') }}</textarea>
                                        @error('clinical_history')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="bmexamination" class="form-label">Indication for Bone Marrow Examination</label>
                                    <div class="">
                                        <textarea class="form-control @error('bmexamination') is-invalid @enderror" name="bmexamination" id="bmexamination" placeholder="Enter Indication for Bone Marrow Examination" style="height: 130px">{{ old('bmexamination') }}</textarea>
                                        @error('bmexamination')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="anatomic_site_aspirate" class="form-label">Anatomic site of aspirate/biopsy</label>
                                    <div class="">
                                        <textarea class="form-control @error('anatomic_site_aspirate') is-invalid @enderror" name="anatomic_site_aspirate" id="anatomic_site_aspirate" placeholder="Enter Anatomic site of aspirate/biopsy" style="height: 130px">{{ old('anatomic_site_aspirate') }}</textarea>
                                        @error('anatomic_site_aspirate')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="ease_diff_aspirate" class="form-label">Ease/difficulty of aspiration</label>
                                    <div class="">
                                        <textarea class="form-control @error('ease_diff_aspirate') is-invalid @enderror" name="ease_diff_aspirate" id="ease_diff_aspirate" placeholder="Enter Ease/difficulty of aspiration" style="height: 130px">{{ old('ease_diff_aspirate') }}</textarea>
                                        @error('ease_diff_aspirate')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="blood_count" class="form-label">Blood Count</label>
                                    <div class="">
                                        <textarea class="form-control @error('blood_count') is-invalid @enderror" name="blood_count" id="blood_count" placeholder="Enter Blood Count" style="height: 130px">{{ old('blood_count') }}</textarea>

                                        @error('blood_count')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="blood_smear" class="form-label">Blood smear description and diagnostic conclusion</label>
                                    <div class="">
                                        <textarea class="form-control @error('blood_smear') is-invalid @enderror" name="blood_smear" id="blood_smear" placeholder="Enter Blood smear description and diagnostic conclusion" style="height: 130px">{{ old('blood_smear') }}</textarea>
                                        @error('blood_smear')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="myeloid" class="form-label">Myeloid:erythroid ratio</label>
                                    <div class="">
                                        <textarea class="form-control @error('myeloid') is-invalid @enderror" name="myeloid" id="myeloid" placeholder="Enter Myeloid:erythroid ratio" style="height: 130px">{{ old('myeloid') }}</textarea>
                                        @error('myeloid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="flow_cytometry" class="form-label">Summary of flow cytometry findings</label>
                                    <div class="">
                                        <textarea class="form-control @error('flow_cytometry') is-invalid @enderror" name="flow_cytometry" id="flow_cytometry" placeholder="Enter Summary of flow cytometry findings" style="height: 130px">{{ old('flow_cytometry') }}</textarea>
                                        @error('flow_cytometry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-4">
                                    <label for="cellular_particles" class="form-label">Cellularity of particles and cell trails</label>
                                    <div class="">
                                        <textarea class="form-control @error('cellular_particles') is-invalid @enderror" name="cellular_particles" id="cellular_particles" placeholder="Enter Cellularity of particles and cell trails" style="height: 130px">{{ old('cellular_particles') }}</textarea>
                                        @error('cellular_particles')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="nucleated_differential" class="form-label">Nucleated differential cell count</label>
                                    <div class="">
                                        <textarea class="form-control @error('nucleated_differential') is-invalid @enderror" name="nucleated_differential" id="nucleated_differential" placeholder="Enter Nucleated differential cell count" style="height: 130px">{{ old('nucleated_differential') }}</textarea>
                                        @error('nucleated_differential')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="total_cell_count" class="form-label">Total number of cells counted</label>
                                    <div class="">
                                        <textarea class="form-control @error('total_cell_count') is-invalid @enderror" name="total_cell_count" id="total_cell_count" placeholder="Enter Total number of cells counted" style="height: 130px">{{ old('total_cell_count') }}</textarea>
                                        @error('total_cell_count')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="haemopoietic_cell" class="form-label">Haemopoietic Cells</label>
                                    <div class="">
                                        <textarea class="form-control @error('haemopoietic_cell') is-invalid @enderror" name="haemopoietic_cell" id="haemopoietic_cell" placeholder="Enter Haemopoietic Cells" style="height: 130px">{{ old('haemopoietic_cell') }}</textarea>
                                        @error('haemopoietic_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="abnormal_cell" class="form-label">Abnormal Cells</label>
                                    <div class="">
                                        <textarea class="form-control @error('abnormal_cell') is-invalid @enderror" name="abnormal_cell" id="abnormal_cell" placeholder="Enter Abnormal Cells" style="height: 130px">{{ old('abnormal_cell') }}</textarea>
                                        @error('abnormal_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="iron_stain" class="form-label">Iron Stain</label>
                                    <div class="">
                                        <textarea class="form-control @error('iron_stain') is-invalid @enderror" name="iron_stain" id="iron_stain" placeholder="Enter Iron Stain" style="height: 130px">{{ old('iron_stain') }}</textarea>
                                        @error('iron_stain')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="cytochemistry" class="form-label">Cytochemistry</label>
                                    <div class="">
                                        <textarea class="form-control @error('cytochemistry') is-invalid @enderror" name="cytochemistry" id="cytochemistry" placeholder="Enter Cytochemistry" style="height: 130px">{{ old('cytochemistry') }}</textarea>
                                        @error('cytochemistry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="investigation" class="form-label">Other investigations</label>
                                    <div class="">
                                        <textarea class="form-control @error('investigation') is-invalid @enderror" name="investigation" id="investigation" placeholder="Enter Other investigations" style="height: 130px">{{ old('investigation') }}</textarea>
                                        @error('investigation')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-4">
                                    <label for="erythropoiesis" class="form-label">Erythropoiesis</label>
                                    <div class="">
                                        <textarea class="form-control @error('erythropoiesis') is-invalid @enderror" name="erythropoiesis" id="erythropoiesis" placeholder="Enter Erythropoiesis" style="height: 130px">{{ old('erythropoiesis') }}</textarea>
                                        @error('erythropoiesis')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="myelopoiesis" class="form-label">Myelopoiesis</label>
                                    <div class="">
                                        <textarea class="form-control @error('myelopoiesis') is-invalid @enderror" name="myelopoiesis" id="myelopoiesis" placeholder="Enter Myelopoiesis" style="height: 130px">{{ old('myelopoiesis') }}</textarea>
                                        @error('myelopoiesis')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="megakaryocytes" class="form-label">Megakaryocytes</label>
                                    <div class="">
                                        <textarea class="form-control @error('megakaryocytes') is-invalid @enderror" name="megakaryocytes" id="megakaryocytes" placeholder="Enter Megakaryocytes" style="height: 130px">{{ old('myelopoiesis') }}</textarea>
                                        @error('megakaryocytes')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="lymphocytes" class="form-label">Lymphocytes</label>
                                    <div class="">
                                        <textarea class="form-control @error('lymphocytes') is-invalid @enderror" name="lymphocytes" id="lymphocytes" placeholder="Enter Lymphocytes" style="height: 130px">{{ old('lymphocytes') }}</textarea>
                                        @error('lymphocytes')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="plasma_cell" class="form-label">Plasma cells</label>
                                    <div class="">
                                        <textarea class="form-control @error('plasma_cell') is-invalid @enderror" name="plasma_cell" id="plasma_cell" placeholder="Enter Plasma cells" style="height: 130px">{{ old('plasma_cell') }}</textarea>
                                        @error('plasma_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="conclusion" class="form-label">Conclusion</label>
                                    <div class="">
                                        <textarea class="form-control @error('conclusion') is-invalid @enderror" name="conclusion" id="conclusion" placeholder="Enter Conclusion" style="height: 130px">{{ old('conclusion') }}</textarea>
                                        @error('conclusion')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="classification" class="form-label">WHO classification</label>
                                    <div class="">
                                        <textarea class="form-control @error('classification') is-invalid @enderror" name="classification" id="classification" placeholder="Enter WHO classification" style="height: 130px">{{ old('classification') }}</textarea>
                                        @error('classification')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="disease_code" class="form-label">Disease Code</label>
                                    <div class="">
                                        <textarea class="form-control @error('disease_code') is-invalid @enderror" name="disease_code" id="disease_code" placeholder="Enter Disease Code" style="height: 130px">{{ old('disease_code') }}</textarea>
                                        @error('disease_code')
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
        // select2
        $('#specimen-select').select2();
        $('#hospital-select').select2();
        $('#bonemarrow-select').select2();

        $("#datepicker").datepicker({
            dateFormat : 'yy-mm-dd',
        });
    </script>
@endpush
