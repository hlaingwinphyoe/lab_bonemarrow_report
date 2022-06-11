@extends('layouts.app')
@section('title') Edit : Histo Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Listings</a></li>
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Histo Create</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h4 class="text-capitalize fw-bold">
                            Edit Histo report
                        </h4>
                    </div>
                    <hr>

                    <form action="{{ route('histo.update',$histo->id) }}" method="post" id="histoUpdateForm" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    </form>
                        <div class="row g-5">
                            <div class="col-12 col-lg-6 right-divider">
                                <div class="mb-3">
                                    <label class="form-label">Photos</label>
                                    <div class="rounded p-2 d-flex overflow-scroll">
                                        <form action="{{ route('histo_photos.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="histo_id" value="{{ $histo->id }}">
                                            <div class="mb-3">
                                                <input type="file" name="histo_photos[]" id="inputPhotos" class="@error('histo_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                                @error('histo_photos')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                                @error('histo_photos.*')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary">Upload</button>
                                        </form>

                                        <div class="border border-2 rounded border-primary uploader-ui me-1 d-flex justify-content-center align-items-center px-4" id="photoUploadUi">
                                            <i class="fa-regular fa-images text-primary fa-2x fa-fw"></i>
                                        </div>

                                        @forelse($histo->histoPhotos as $photo)
                                            <div class="position-relative">
                                                <form action="{{ route('histo_photos.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" id="delForm{{ $photo->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="img-delete-btn rounded shadow-sm" onclick="return askConfirm({{ $photo->id }})">
                                                        <i class="fa-regular fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a class="venobox" data-gall="img" href="{{ asset('storage/histo_photos/'.$photo->name) }}">
                                                    <img src="{{ asset('storage/histo_thumbnails/'.$photo->name) }}" height="100" class="rounded me-1" alt="image alt"/>
                                                </a>
                                            </div>
                                        @empty
                                            <p class="mb-0 fw-bold ms-3" style="margin-top: 35px;">No Photo</p>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Hospital</label>
                                    <select class="form-select @error('hospital') is-invalid @enderror" form="histoUpdateForm" name="hospital" aria-label="Default select example">
                                        <option selected>Select Hospital</option>
                                        @forelse(\App\Models\Hospital::all() as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital',$histo->hospital_id) ? 'selected':'' }}>{{ $hospital->name }}</option>
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
                                        <input type="text" name="name" form="histoUpdateForm" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" value="{{ old('name',$histo->name) }}">
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
                                                <input type="number" name="age" form="histoUpdateForm" class="form-control @error('age') is-invalid @enderror" id="age" placeholder="age" value="{{ old('age',$histo->age) }}">
                                                <label for="age">Enter Age</label>
                                                @error('age')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Age Type</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type',$histo->age_type) == 'D' ? 'checked':'' }} type="radio" form="histoUpdateForm" name="age_type" id="d" value="D">
                                                <label class="form-check-label" for="d">Day</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type',$histo->age_type) == 'M' ? 'checked':'' }} type="radio" form="histoUpdateForm" name="age_type" id="m" value="M">
                                                <label class="form-check-label" for="m">Month</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" {{ old('age_type',$histo->age_type) == 'Yr' ? 'checked':'' }} type="radio" form="histoUpdateForm" name="age_type" id="yr" value="Yr">
                                                <label class="form-check-label" for="yr">Year</label>
                                            </div>
                                            <br>
                                            @error('age_type')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="">Gender</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('gender',$histo->gender) == 'Male' ? 'checked':'' }} form="histoUpdateForm" type="radio" name="gender" id="genderM" value="Male">
                                        <label class="form-check-label" for="genderM">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ old('gender',$histo->gender) == 'Female' ? 'checked':'' }} form="histoUpdateForm" type="radio" name="gender" id="genderF" value="Female">
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
                                        <input type="text" name="doctor" form="histoUpdateForm" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="doctor" value="{{ old('doctor',$histo->doctor) }}">
                                        <label for="doctor">Enter Referring Doctor</label>
                                        @error('doctor')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="bio_receive_date">Biopsy Receive Date</label>
                                    <div class="">
                                        <input type="date" form="histoUpdateForm" class="form-control @error('bio_receive_date') is-invalid @enderror" id="bio_receive_date" name="bio_receive_date" value="{{ old('bio_receive_date',$histo->bio_receive_date) }}">
                                        @error('bio_receive_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bio_cut_date">Biopsy Cutting Date</label>
                                    <div class="">
                                        <input type="date" form="histoUpdateForm" class="form-control @error('bio_cut_date') is-invalid @enderror" id="bio_cut_date" name="bio_cut_date" value="{{ old('bio_cut_date',$histo->bio_cut_date) }}">
                                        @error('bio_cut_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bio_report_date">Biopsy Report Date</label>
                                    <div class="">
                                        <input type="date" form="histoUpdateForm" class="form-control @error('bio_report_date') is-invalid @enderror" id="bio_report_date" name="bio_report_date" value="{{ old('bio_report_date',$histo->bio_report_date) }}">
                                        @error('bio_report_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="specimen" class="form-label">Specimen</label>
                                    <div class="form-floating">
                                        <textarea form="histoUpdateForm" class="form-control @error('specimen') is-invalid @enderror" name="specimen" id="specimen" placeholder="Enter Specimen" style="height: 180px">{{ old('specimen',$histo->specimen) }}</textarea>
                                        <label for="specimen">Enter Specimen</label>
                                        @error('specimen')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="gross" class="form-label">Gross</label>
                                    <div class="form-floating">
                                        <textarea form="histoUpdateForm" class="form-control @error('gross') is-invalid @enderror" name="gross" id="gross" placeholder="Enter Gross" style="height: 180px">{{ old('gross',$histo->gross) }}</textarea>
                                        <label for="gross">Enter Gross</label>
                                        @error('gross')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Microscopic Description</label>
                                    <div class="form-floating">
                                        <textarea form="histoUpdateForm" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Microscopic Description" style="height: 180px">{{ old('description',$histo->description) }}</textarea>
                                        <label for="description">Enter Microscopic Description</label>
                                        @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <div class="form-floating">
                                        <textarea form="histoUpdateForm" class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" placeholder="Enter Remark" style="height: 180px">{{ old('remark',$histo->remark) }}</textarea>
                                        <label for="remark">Enter Remark</label>
                                        @error('remark')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary text-uppercase text-white" form="histoUpdateForm"><i class="fa fa-save me-2"></i>Update</button>
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

    </script>
@endpush
