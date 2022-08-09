@extends('layouts.app')
@section('title') Edit : Cyto Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cyto.index') }}">Cyto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-edit me-1"></i>Edit Cyto report
                        </h5>
                    </div>
                    <hr>
                    <form action="{{ route('cyto.update',$cyto->id) }}" method="post" id="cytoUpdateForm" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    </form>
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-4">
                                <label for="name" class="form-label">Enter Patient's Name</label>
                                <input type="text" name="name" form="cytoUpdateForm" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name',$cyto->name) }}">

                                @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="year" class="form-label ">Enter Year</label>
                                <input type="number" name="year" min="0" form="cytoUpdateForm" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',$cyto->year) }}">

                                @error('year')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="datepicker3" class="form-label">Receive Date</label>
                                <input type="text" form="cytoUpdateForm" class="form-control @error('bio_receive_date') is-invalid @enderror" id="datepicker3" placeholder="dd/MM/YYYY" name="bio_receive_date" value="{{ old('bio_receive_date',$cyto->bio_receive_date) }}">
                                @error('bio_receive_date')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-4">
                                <label for="" class="form-label">Hospital</label>
                                <select form="cytoUpdateForm" class="form-select @error('hospital') is-invalid @enderror" name="hospital" aria-label="Default select example" id="hospital-select">
                                    <option selected disabled>Select Hospital</option>
                                    @forelse($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital',$cyto->hospital_id) ? 'selected':'' }}>{{ $hospital->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('hospital')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="month" class="form-label">Enter Month</label>
                                <input type="number" name="month" min="0" form="cytoUpdateForm" class="form-control @error('month') is-invalid @enderror" id="month" placeholder="Month" value="{{ old('month',$cyto->month) }}">

                                @error('month')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="datepicker4" class="form-label">Staining Date</label>
                                <input type="text" form="cytoUpdateForm" class="form-control @error('bio_cut_date') is-invalid @enderror" id="datepicker4" placeholder="dd/MM/YYYY" name="bio_cut_date" value="{{ old('bio_cut_date',$cyto->bio_cut_date) }}">
                                @error('bio_cut_date')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-4">
                                <label for="" class="form-label">Specimen Type</label>
                                <select form="cytoUpdateForm" class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select">
                                    <option selected disabled>Select Specimen Type</option>
                                    @forelse($specimens as $specimen)
                                        <option value="{{ $specimen->id }}" {{ $specimen->id == old('specimen_type',$cyto->specimen_type_id) ? 'selected':'' }}>{{ $specimen->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('specimen_type')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="day" class="form-label">Enter Day</label>
                                <input type="number" name="day" min="0" form="cytoUpdateForm" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="Day" value="{{ old('day',$cyto->day) }}">

                                @error('day')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="datepicker5" class="form-label">Report Date</label>
                                <input type="text" form="cytoUpdateForm" class="form-control @error('bio_report_date') is-invalid @enderror" id="datepicker5" placeholder="dd/MM/YYYY" name="bio_report_date" value="{{ old('bio_report_date',$cyto->bio_report_date) }}">
                                @error('bio_report_date')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-4">
                                <label for="" class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" form="cytoUpdateForm" {{ old('gender',$cyto->gender) == 'Male' ? 'checked':'' }} type="radio" name="gender" id="genderM" value="Male">
                                    <label class="form-check-label" for="genderM">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" form="cytoUpdateForm" {{ old('gender',$cyto->gender) == 'Female' ? 'checked':'' }} type="radio" name="gender" id="genderF" value="Female">
                                    <label class="form-check-label" for="genderF">Female</label>
                                </div>
                                <br>
                                @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="doctor" class="form-label">Enter Referring Doctor</label>
                                <input type="text" name="doctor" form="cytoUpdateForm" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Refer Doctor" value="{{ old('doctor',$cyto->doctor) }}">
                                @error('doctor')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Photos</label>
                                <div class="rounded p-2 d-flex overflow-scroll">
                                    <form action="{{ route('cyto_photos.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="cyto_id" value="{{ $cyto->id }}">
                                        <div class="mb-3">
                                            <input type="file" name="cyto_photos[]" id="inputPhotos" class="@error('cyto_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                            @error('cyto_photos')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                            @error('cyto_photos.*')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary">Upload</button>
                                    </form>

                                    <div class="border border-2 rounded border-secondary uploader-ui me-1 d-flex justify-content-center align-items-center px-4" id="photoUploadUi">
                                        <i class="fa-solid fa-camera text-secondary fa-2x fa-fw"></i>
                                    </div>

                                    @forelse($cyto->cytoPhotos as $photo)
                                        <div class="position-relative">
                                            <form action="{{ route('cyto_photos.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" id="delForm{{ $photo->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-sm px-2" onclick="return askConfirm({{ $photo->id }})">
                                                    <i class="fa-regular fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a class="venobox" data-gall="img" href="{{ asset('storage/cyto_photos/'.$photo->name) }}">
                                                <img src="{{ asset('storage/cyto_thumbnails/'.$photo->name) }}" height="100" class="rounded me-1" alt="image alt"/>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="mb-0 fw-bold ms-3" style="margin-top: 35px;">No Photo</p>
                                    @endforelse

                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="specimen" class="form-label">Specimen</label>
                                <div class="mb-4">
                                    <textarea form="cytoUpdateForm" class="form-control @error('specimen') is-invalid @enderror" name="specimen" id="specimen" placeholder="Enter Specimen" style="height: 180px">{{ old('specimen',$cyto->specimen) }}</textarea>
                                    @error('specimen')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-4">
                                <label for="cyto_diagnosis" class="form-label">Cytological Diagnosis</label>
                                <div class="mb-4">
                                    <textarea form="cytoUpdateForm" class="form-control @error('cyto_diagnosis') is-invalid @enderror" name="cyto_diagnosis" id="cyto_diagnosis" placeholder="Enter Cytological Diagnosis" style="height: 180px">{{ old('cyto_diagnosis',$cyto->diagnosis) }}</textarea>
                                    @error('cyto_diagnosis')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="morphology" class="form-label">Morphology</label>
                                <div class="mb-4">
                                    <textarea form="cytoUpdateForm" class="form-control @error('morphology') is-invalid @enderror" name="morphology" id="morphology" placeholder="Enter Morphology" style="height: 180px">{{ old('morphology',$cyto->morphology) }}</textarea>
                                    @error('morphology')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary text-uppercase text-white" form="cytoUpdateForm"><i class="fa fa-save me-2"></i>Update</button>
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
