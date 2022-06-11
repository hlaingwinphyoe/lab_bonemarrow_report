@extends('layouts.app')
@section('title') Create : Trephine Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Trephine Report</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h4 class="text-capitalize fw-bold">
                            trephine report
                        </h4>
                    </div>
                    <hr>

                    <form action="{{ route('trephine.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-5">
                            <div class="col-12 col-lg-6 right-divider">
                                <div class="mb-3">
                                    <div class="file-upload mt-3">

                                        <button class="file-upload__button" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>

                                        <input type="file" name="trephine_photos[]" id="inputPhotos" class="file-upload__input @error('trephine_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                        @error('trephine_photos')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        @error('trephine_photos.*')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="datepicker">Date of Procedure</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('sc_date') is-invalid @enderror" id="datepicker" placeholder="dd/MM/YYYY" name="sc_date" value="{{ old('sc_date') }}">
                                        @error('sc_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Name Of Institute</label>
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
                                    <label for="lab_access">Laboratory Accession Number</label>
                                    <div class="form-floating">
                                        <input type="number" name="lab_access" class="form-control @error('lab_access') is-invalid @enderror" id="lab_access" placeholder="lab_access" value="{{ old('lab_access') }}">
                                        <label for="lab_access">Enter....</label>
                                        @error('lab_access')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="patient_name">Patient's Name</label>
                                    <div class="form-floating">
                                        <input type="text" name="patient_name" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name" placeholder="patient_name" value="{{ old('patient_name') }}">
                                        <label for="patient_name">Enter Patient's Name</label>
                                        @error('patient_name')
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
                                    <label for="contact_detail" class="form-label">Contact Details</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('contact_detail') is-invalid @enderror" name="contact_detail" id="contact_detail" placeholder="Enter Contact Details" style="height: 130px">{{ old('contact_detail') }}</textarea>
                                        <label for="floatingTextarea2">Enter Contact Details</label>
                                        @error('contact_detail')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="">Physician</label>
                                    <div class="form-floating">
                                        <input type="text" name="physician_name" class="form-control @error('physician_name') is-invalid @enderror" id="physician_name" placeholder="physician_name" value="{{ old('physician_name') }}">
                                        <label for="physician_name">Enter Responsible Physician</label>
                                        @error('physician_name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="">Doctors</label>
                                    <div class="form-floating">
                                        <input type="text" name="doctor" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="doctor" value="{{ old('doctor') }}">
                                        <label for="doctor">Enter Requesting Doctors</label>
                                        @error('doctor')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="clinical_history" class="form-label">Clinical History</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('clinical_history') is-invalid @enderror" name="clinical_history" id="clinical_history" placeholder="Enter clinical history" style="height: 130px">{{ old('clinical_history') }}</textarea>
                                        <label for="floatingTextarea2">Enter Clinical History</label>
                                        @error('clinical_history')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="bmexamination" class="form-label">Bone Marrow Examination</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('bmexamination') is-invalid @enderror" name="bmexamination" id="bmexamination" placeholder="Enter Indication for Bone Marrow Examination" style="height: 130px">{{ old('bmexamination') }}</textarea>
                                        <label for="floatingTextarea2">Enter Indication for Bone Marrow Examination</label>
                                        @error('bmexamination')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="">Procedure Perform</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('pro_perform') == 'Aspirate' ? 'checked':'' }} type="radio" name="pro_perform" id="pro_perform_A" value="Aspirate">
                                        <label class="form-check-label" for="pro_perform_A">Aspirate biopsy</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('pro_perform') == 'Trephine' ? 'checked':'' }} type="radio" name="pro_perform" id="pro_perform_T" value="Trephine">
                                        <label class="form-check-label" for="pro_perform_T">Trephine biopsy</label>
                                    </div>
                                    <br>
                                    @error('pro_perform')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="anatomic_site_trephine" class="form-label">Anatomic site of Aspirate / Trephine biopsy</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('anatomic_site_trephine') is-invalid @enderror" name="anatomic_site_trephine" id="anatomic_site_trephine" placeholder="Anatomic site of Aspirate / Trephine biopsy" style="height: 130px">{{ old('anatomic_site_trephine') }}</textarea>
                                        <label for="anatomic_site_trephine">Anatomic site of Aspirate / Trephine biopsy</label>
                                        @error('anatomic_site_trephine')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="biopsy_core" class="form-label">Aggregate Length Of Biopsy Core</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('biopsy_core') is-invalid @enderror" name="biopsy_core" id="biopsy_core" placeholder="Enter Aggregate Length Of Biopsy Core" style="height: 130px">{{ old('biopsy_core') }}</textarea>
                                        <label for="biopsy_core">Enter Aggregate Length Of Biopsy Core</label>
                                        @error('biopsy_core')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="ade_macro_appearance" class="form-label">Adequacy And Macroscopic Appearance Of Core</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('ade_macro_appearance') is-invalid @enderror" name="ade_macro_appearance" id="ade_macro_appearance" placeholder="Enter Adequacy And Macroscopic Appearance Of Core" style="height: 130px">{{ old('ade_macro_appearance') }}</textarea>
                                        <label for="ade_macro_appearance">Enter Adequacy And Macroscopic Appearance Of Core</label>
                                        @error('ade_macro_appearance')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="percentage_cellularity" class="form-label">Percentage And Pattern Of Cellularity</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('percentage_cellularity') is-invalid @enderror" name="percentage_cellularity" id="percentage_cellularity" placeholder="Enter Percentage And Pattern Of Cellularity" style="height: 130px">{{ old('percentage_cellularity') }}</textarea>
                                        <label for="percentage_cellularity">Enter Percentage And Pattern Of Cellularity</label>
                                        @error('percentage_cellularity')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="bone_architecture" class="form-label">Bone Architecture</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('bone_architecture') is-invalid @enderror" name="bone_architecture" id="bone_architecture" placeholder="Enter Bone Architecture" style="height: 130px">{{ old('bone_architecture') }}</textarea>
                                        <label for="bone_architecture">Enter Bone Architecture</label>
                                        @error('bone_architecture')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="path" class="form-label">Location</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('path') is-invalid @enderror" name="path" id="path" placeholder="Enter Location" style="height: 130px">{{ old('path') }}</textarea>
                                        <label for="path">Enter Location</label>
                                        @error('path')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="tre_number" class="form-label">Trephine Number</label>
                                    <div class="form-floating">
                                        <input type="number" name="tre_number" class="form-control" id="tre_number" placeholder="tre_number" value="{{ old('tre_number') }}">
                                        <label for="tre_number">Enter Number</label>
                                        @error('tre_number')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="erythroid" class="form-label">Morphology And Pattern of Differentiation For Erythroid</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('erythroid') is-invalid @enderror" name="erythroid" id="erythroid" placeholder="Enter Morphology And Pattern of Differentiation For Erythroid" style="height: 130px">{{ old('erythroid') }}</textarea>
                                        <label for="erythroid">Enter Morphology And Pattern of Differentiation For Erythroid</label>
                                        @error('erythroid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="myeloid" class="form-label">Myeloid Lineages</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('myeloid') is-invalid @enderror" name="myeloid" id="myeloid" placeholder="Enter Myeloid Lineages" style="height: 130px">{{ old('myeloid') }}</textarea>
                                        <label for="myeloid">Enter Myeloid Lineages</label>
                                        @error('myeloid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="megaka" class="form-label">Megakaryocytic Lineages</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('megaka') is-invalid @enderror" name="megaka" id="megaka" placeholder="Enter Megakaryocytic Lineages" style="height: 130px">{{ old('myelopoiesis') }}</textarea>
                                        <label for="megaka">Enter Megakaryocytic Lineages</label>
                                        @error('megaka')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="lymphoid" class="form-label">Lymphoid Cells</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('lymphoid') is-invalid @enderror" name="lymphoid" id="lymphoid" placeholder="Enter Lymphoid Cells" style="height: 130px">{{ old('lymphoid') }}</textarea>
                                        <label for="lymphoid">Enter Lymphoid Cells</label>
                                        @error('lymphoid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="plasma_cell" class="form-label">Plasma cells</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('plasma_cell') is-invalid @enderror" name="plasma_cell" id="plasma_cell" placeholder="Enter Plasma cells" style="height: 130px">{{ old('plasma_cell') }}</textarea>
                                        <label for="plasma_cell">Enter Plasma cells</label>
                                        @error('plasma_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="macrophages" class="form-label">Macrophages</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('macrophages') is-invalid @enderror" name="macrophages" id="macrophages" placeholder="Enter Macrophages" style="height: 130px">{{ old('macrophages') }}</textarea>
                                        <label for="macrophages">Enter Macrophages</label>
                                        @error('macrophages')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="abnormal_cell" class="form-label">Abnormal cells and/or infiltrates</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('abnormal_cell') is-invalid @enderror" name="abnormal_cell" id="abnormal_cell" placeholder="Enter Abnormal cells and/or infiltrates" style="height: 130px">{{ old('abnormal_cell') }}</textarea>
                                        <label for="abnormal_cell">Enter Abnormal cells and/or infiltrates</label>
                                        @error('abnormal_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="reticulin_stain" class="form-label">Reticulin Stain</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('reticulin_stain') is-invalid @enderror" name="reticulin_stain" id="reticulin_stain" placeholder="Enter Reticulin Stain" style="height: 130px">{{ old('reticulin_stain') }}</textarea>
                                        <label for="reticulin_stain">Enter Reticulin Stain</label>
                                        @error('reticulin_stain')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="immunohistochemistry" class="form-label">Immunohistochemistry</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('immunohistochemistry') is-invalid @enderror" name="immunohistochemistry" id="immunohistochemistry" placeholder="Enter Immunohistochemistry" style="height: 130px">{{ old('immunohistochemistry') }}</textarea>
                                        <label for="immunohistochemistry">Enter Immunohistochemistry</label>
                                        @error('immunohistochemistry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="histochemistry" class="form-label">Histochemistry</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('histochemistry') is-invalid @enderror" name="histochemistry" id="histochemistry" placeholder="Enter Histochemistry" style="height: 130px">{{ old('histochemistry') }}</textarea>
                                        <label for="histochemistry">Enter Histochemistry</label>
                                        @error('histochemistry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="investigation" class="form-label">Other Investigations</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('investigation') is-invalid @enderror" name="investigation" id="investigation" placeholder="Enter Other Investigations" style="height: 130px">{{ old('investigation') }}</textarea>
                                        <label for="investigation">Enter Other Investigations</label>
                                        @error('investigation')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="conclusion" class="form-label">Conclusion</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('conclusion') is-invalid @enderror" name="conclusion" id="conclusion" placeholder="Enter Conclusion" style="height: 130px">{{ old('conclusion') }}</textarea>
                                        <label for="floatingTextarea2">Enter Conclusion</label>
                                        @error('conclusion')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="disease_code" class="form-label">Disease Code</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('disease_code') is-invalid @enderror" name="disease_code" id="disease_code" placeholder="Disease Code" style="height: 130px">{{ old('disease_code') }}</textarea>
                                        <label for="floatingTextarea2">Enter Disease Code</label>
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
        $('#datepicker').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    </script>
@endpush
