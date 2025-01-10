@extends('layouts.app')
@section('title') Edit : Trephine Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trephine.index') }}">Trephine</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Trephine</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-edit me-1"></i>Edit Trephine Report
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

                    <form action="{{ route('trephine.update',$trephine->id) }}" id="trephineUpdateForm" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    </form>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Photos</label>
                                    <div class="rounded p-2 d-flex overflow-scroll">
                                        <form action="{{ route('trephine_photos.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="trephine_id" value="{{ $trephine->id }}">
                                            <div class="mb-3">
                                                <input type="file" name="trephine_photos[]" id="inputPhotos" class="@error('trephine_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                                @error('trephine_photos')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                                @error('trephine_photos.*')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary">Upload</button>
                                        </form>

                                        <div class="border border-2 rounded border-secondary uploader-ui me-1 d-flex justify-content-center align-items-center px-4" id="photoUploadUi">
                                            <i class="fa-solid fa-camera text-secondary fa-2x fa-fw"></i>
                                        </div>

                                        @forelse($trephine->trephinePhotos as $photo)
                                            <div class="position-relative">
                                                <form action="{{ route('trephine_photos.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" id="delForm{{ $photo->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="img-delete-btn btn btn-danger btn-sm px-2" onclick="return askConfirm({{ $photo->id }})">
                                                        <i class="fa-regular fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a class="venobox" data-gall="img" href="{{ asset('storage/trephine_photos/'.$photo->name) }}">
                                                    <img src="{{ asset('storage/trephine_thumbnails/'.$photo->name) }}" height="100" class="rounded me-1" alt="image alt"/>
                                                </a>
                                            </div>
                                        @empty
                                            <p class="mb-0 fw-bold ms-3" style="margin-top: 35px;">No Photo</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="patient_name">Patient's Name</label>
                                    <div class="">
                                        <input type="text" name="patient_name" form="trephineUpdateForm" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name" placeholder="Name" value="{{ old('patient_name',$trephine->patient_name) }}">
                                        @error('patient_name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="lab_access">Laboratory Accession Number</label>
                                    <div class="">
                                        <input type="number" name="lab_access" min="0" form="trephineUpdateForm" class="form-control @error('lab_access') is-invalid @enderror" id="lab_access" placeholder="Enter Lab Accession Number" value="{{ old('lab_access',$trephine->lab_access) }}">
                                        @error('lab_access')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Gender</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" form="trephineUpdateForm" {{ old('gender',$trephine->gender) == 'Male' ? 'checked':'' }} type="radio" name="gender" id="genderM" value="Male">
                                        <label class="form-check-label" for="genderM">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" form="trephineUpdateForm" {{ old('gender',$trephine->gender) == 'Female' ? 'checked':'' }} type="radio" name="gender" id="genderF" value="Female">
                                        <label class="form-check-label" for="genderF">Female</label>
                                    </div>
                                    <br>
                                    @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="tre_number" class="form-label">Trephine Number</label>
                                    <div class="">
                                        <input type="number" name="tre_number" min="0" form="trephineUpdateForm" class="form-control" id="tre_number" placeholder="Enter Trephine Number" value="{{ old('tre_number',$trephine->tre_number) }}">
                                        @error('tre_number')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="sc_date">Date of Procedure</label>
                                    <div class="">
                                        <input type="text" form="trephineUpdateForm" class="form-control @error('sc_date') is-invalid @enderror" id="datepicker" placeholder="DD/MM/YYYY" name="sc_date" value="{{ old('sc_date',$trephine->sc_date) }}">
                                        @error('sc_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Year</label>
                                    <div class="">
                                        <input type="number" name="year" min="0" form="trephineUpdateForm" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',$trephine->year) }}">
                                        @error('year')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Procedure Perform</label>
                                    <select form="trephineUpdateForm" class="form-select @error('pro_perform') is-invalid @enderror" name="pro_perform" id="bonemarrow-select">
                                        <option selected disabled>Select Procedure Perform</option>
                                        <option value="Aspirate" {{ old('pro_perform',$trephine->pro_perform) == 'Aspirate' ? 'selected':'' }}>Aspirate biopsy</option>
                                        <option value="Trephine" {{ old('pro_perform',$trephine->pro_perform) == 'Trephine' ? 'selected':'' }}>Trephine biopsy</option>
                                    </select>
                                    @error('pro_perform')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Name Of Institute</label>
                                    <select form="trephineUpdateForm" class="form-select @error('hospital') is-invalid @enderror" name="hospital" aria-label="Default select example" id="hospital-select">
                                        <option selected>Select Hospital</option>
                                        @forelse($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital',$trephine->hospital_id) ? 'selected':'' }}>{{ $hospital->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('hospital')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Month</label>
                                    <div class="">
                                        <input type="number" name="month" min="0" form="trephineUpdateForm" class="form-control @error('month') is-invalid @enderror" id="month" placeholder="Month" value="{{ old('month',$trephine->month) }}">
                                        @error('month')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Physician</label>
                                    <div class="">
                                        <input type="text" name="physician_name" form="trephineUpdateForm" class="form-control @error('physician_name') is-invalid @enderror" id="physician_name" placeholder="Enter Physician Name" value="{{ old('physician_name',$trephine->physician_name) }}">
                                        @error('physician_name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="" class="form-label">Specimen Type</label>
                                    <select form="trephineUpdateForm" class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select">
                                        <option selected disabled>Select Specimen Type</option>
                                        @forelse($specimens as $specimen)
                                            <option value="{{ $specimen->id }}" {{ $specimen->id == old('specimen_type',$trephine->specimen_type_id) ? 'selected':'' }}>{{ $specimen->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('specimen_type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Day</label>
                                    <div class="">
                                        <input type="number" name="day" min="0" form="trephineUpdateForm" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="day" value="{{ old('day',$trephine->day) }}">
                                        @error('day')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Doctors</label>
                                    <div class="">
                                        <input type="text" name="doctor" form="trephineUpdateForm" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Enter Refer Doctor" value="{{ old('doctor',$trephine->doctor) }}">
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
                                        <textarea form="trephineUpdateForm" class="form-control @error('contact_detail') is-invalid @enderror" name="contact_detail" id="contact_detail" placeholder="Enter Contact Details" style="height: 130px">{{ old('contact_detail',$trephine->contact_detail) }}</textarea>
                                        @error('contact_detail')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="clinical_history" class="form-label">Clinical History</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('clinical_history') is-invalid @enderror" name="clinical_history" id="clinical_history" placeholder="Enter clinical history" style="height: 130px">{{ old('clinical_history',$trephine->clinical_history) }}</textarea>
                                        @error('clinical_history')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="bmexamination" class="form-label">Bone Marrow Examination</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('bmexamination') is-invalid @enderror" name="bmexamination" id="bmexamination" placeholder="Enter Indication for Bone Marrow Examination" style="height: 130px">{{ old('bmexamination',$trephine->bmexamination) }}</textarea>
                                        @error('bmexamination')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="anatomic_site_trephine" class="form-label">Anatomic site of Aspirate / Trephine biopsy</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('anatomic_site_trephine') is-invalid @enderror" name="anatomic_site_trephine" id="anatomic_site_trephine" placeholder="Anatomic site of Aspirate / Trephine biopsy" style="height: 130px">{{ old('anatomic_site_trephine',$trephine->anatomic_site_trephine) }}</textarea>
                                        @error('anatomic_site_trephine')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="biopsy_core" class="form-label">Aggregate Length Of Biopsy Core</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('biopsy_core') is-invalid @enderror" name="biopsy_core" id="biopsy_core" placeholder="Enter Aggregate Length Of Biopsy Core" style="height: 130px">{{ old('biopsy_core',$trephine->biopsy_core) }}</textarea>
                                        @error('biopsy_core')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="ade_macro_appearance" class="form-label">Adequacy And Macroscopic Appearance Of Core</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('ade_macro_appearance') is-invalid @enderror" name="ade_macro_appearance" id="ade_macro_appearance" placeholder="Enter Adequacy And Macroscopic Appearance Of Core" style="height: 130px">{{ old('ade_macro_appearance',$trephine->ade_macro_appearance) }}</textarea>
                                        @error('ade_macro_appearance')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="percentage_cellularity" class="form-label">Percentage And Pattern Of Cellularity</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('percentage_cellularity') is-invalid @enderror" name="percentage_cellularity" id="percentage_cellularity" placeholder="Enter Percentage And Pattern Of Cellularity" style="height: 130px">{{ old('percentage_cellularity',$trephine->percentage_cellularity) }}</textarea>
                                        @error('percentage_cellularity')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="bone_architecture" class="form-label">Bone Architecture</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('bone_architecture') is-invalid @enderror" name="bone_architecture" id="bone_architecture" placeholder="Enter Bone Architecture" style="height: 130px">{{ old('bone_architecture',$trephine->bone_architecture) }}</textarea>
                                        @error('bone_architecture')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="path" class="form-label">Location</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('path') is-invalid @enderror" name="path" id="path" placeholder="Enter Location" style="height: 130px">{{ old('path',$trephine->path) }}</textarea>
                                        @error('path')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-4">
                                    <label for="erythroid" class="form-label">Morphology And Pattern of Differentiation For Erythroid</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('erythroid') is-invalid @enderror" name="erythroid" id="erythroid" placeholder="Enter Morphology And Pattern of Differentiation For Erythroid" style="height: 130px">{{ old('erythroid',$trephine->erythroid) }}</textarea>
                                        @error('erythroid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="myeloid" class="form-label">Myeloid Lineages</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('myeloid') is-invalid @enderror" name="myeloid" id="myeloid" placeholder="Enter Myeloid Lineages" style="height: 130px">{{ old('myeloid',$trephine->myeloid) }}</textarea>
                                        @error('myeloid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="megaka" class="form-label">Megakaryocytic Lineages</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('megaka') is-invalid @enderror" name="megaka" id="megaka" placeholder="Enter Megakaryocytic Lineages" style="height: 130px">{{ old('myelopoiesis',$trephine->myelopoiesis) }}</textarea>
                                        @error('megaka')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="lymphoid" class="form-label">Lymphoid Cells</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('lymphoid') is-invalid @enderror" name="lymphoid" id="lymphoid" placeholder="Enter Lymphoid Cells" style="height: 130px">{{ old('lymphoid',$trephine->lymphoid) }}</textarea>
                                        @error('lymphoid')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="plasma_cell" class="form-label">Plasma cells</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('plasma_cell') is-invalid @enderror" name="plasma_cell" id="plasma_cell" placeholder="Enter Plasma cells" style="height: 130px">{{ old('plasma_cell',$trephine->plasma_cell) }}</textarea>
                                        @error('plasma_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="macrophages" class="form-label">Macrophages</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('macrophages') is-invalid @enderror" name="macrophages" id="macrophages" placeholder="Enter Macrophages" style="height: 130px">{{ old('macrophages',$trephine->macrophages) }}</textarea>
                                        @error('macrophages')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="abnormal_cell" class="form-label">Abnormal cells and/or infiltrates</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('abnormal_cell') is-invalid @enderror" name="abnormal_cell" id="abnormal_cell" placeholder="Enter Abnormal cells and/or infiltrates" style="height: 130px">{{ old('abnormal_cell',$trephine->abnormal_cell) }}</textarea>
                                        @error('abnormal_cell')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="reticulin_stain" class="form-label">Reticulin Stain</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('reticulin_stain') is-invalid @enderror" name="reticulin_stain" id="reticulin_stain" placeholder="Enter Reticulin Stain" style="height: 130px">{{ old('reticulin_stain',$trephine->reticulin_stain) }}</textarea>
                                        @error('reticulin_stain')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="ade_macro_appearance" class="form-label">Adequacy And Macroscopic Appearance Of Core</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('ade_macro_appearance') is-invalid @enderror" name="ade_macro_appearance" id="ade_macro_appearance" placeholder="Enter Adequacy And Macroscopic Appearance Of Core" style="height: 130px">{{ old('ade_macro_appearance',$trephine->ade_macro_appearance) }}</textarea>
                                        @error('ade_macro_appearance')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 col-lg-4">

                                <div class="mb-4">
                                    <label for="percentage_cellularity" class="form-label">Percentage And Pattern Of Cellularity</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('percentage_cellularity') is-invalid @enderror" name="percentage_cellularity" id="percentage_cellularity" placeholder="Enter Percentage And Pattern Of Cellularity" style="height: 130px">{{ old('percentage_cellularity',$trephine->percentage_cellularity) }}</textarea>
                                        @error('percentage_cellularity')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="bone_architecture" class="form-label">Bone Architecture</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('bone_architecture') is-invalid @enderror" name="bone_architecture" id="bone_architecture" placeholder="Enter Bone Architecture" style="height: 130px">{{ old('bone_architecture',$trephine->bone_architecture) }}</textarea>
                                        @error('bone_architecture')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="path" class="form-label">Location</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('path') is-invalid @enderror" name="path" id="path" placeholder="Enter Location" style="height: 130px">{{ old('path',$trephine->path) }}</textarea>
                                        @error('path')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="immunohistochemistry" class="form-label">Immunohistochemistry</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('immunohistochemistry') is-invalid @enderror" name="immunohistochemistry" id="immunohistochemistry" placeholder="Enter Immunohistochemistry" style="height: 130px">{{ old('immunohistochemistry',$trephine->immunohistochemistry) }}</textarea>
                                        @error('immunohistochemistry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="histochemistry" class="form-label">Histochemistry</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('histochemistry') is-invalid @enderror" name="histochemistry" id="histochemistry" placeholder="Enter Histochemistry" style="height: 130px">{{ old('histochemistry',$trephine->histochemistry) }}</textarea>
                                        @error('histochemistry')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="investigation" class="form-label">Other Investigations</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('investigation') is-invalid @enderror" name="investigation" id="investigation" placeholder="Enter Other Investigations" style="height: 130px">{{ old('investigation',$trephine->investigation) }}</textarea>
                                        @error('investigation')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="conclusion" class="form-label">Conclusion</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('conclusion') is-invalid @enderror" name="conclusion" id="conclusion" placeholder="Enter Conclusion" style="height: 130px">{{ old('conclusion',$trephine->conclusion) }}</textarea>
                                        @error('conclusion')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="disease_code" class="form-label">Disease Code</label>
                                    <div class="">
                                        <textarea form="trephineUpdateForm" class="form-control @error('disease_code') is-invalid @enderror" name="disease_code" id="disease_code" placeholder="Disease Code" style="height: 130px">{{ old('disease_code',$trephine->disease_code) }}</textarea>
                                        @error('disease_code')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary text-uppercase text-white" form="trephineUpdateForm"><i class="fa fa-save me-2"></i>Update</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>

        let photoUploadForm = document.getElementById('photoUploadForm');
        let photoInput = document.getElementById('inputPhotos');
        let photoUploadUi = document.getElementById('photoUploadUi');

        photoUploadUi.addEventListener('click',function (){
            photoInput.click();
        })

        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })

        // select2
        $('#specimen-select').select2();
        $('#hospital-select').select2();
        $('#bonemarrow-select').select2();

        $("#datepicker").datepicker({
            dateFormat : 'yy-mm-dd',
        });

    </script>
@endpush
