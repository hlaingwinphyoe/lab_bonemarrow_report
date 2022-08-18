@extends('layouts.app')
@section('title') Edit : Histo Report @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('histo.index') }}">Histo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-edit me-1"></i>Edit Histo report
                        </h5>
                    </div>
                    <hr>

                    <form action="{{ route('histo.update',$histo->id) }}" method="post" id="histoUpdateForm" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    </form>
                        <div class="row g-5">
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="name">Patient's Name</label>
                                    <div class="mb-4">
                                        <input type="text" name="name" form="histoUpdateForm" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name',$histo->name) }}">
                                        @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Year</label>
                                    <input type="number" name="year" min="0" form="histoUpdateForm" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',$histo->year) }}">
                                    @error('year')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="datepicker">Receive Date</label>
                                    <div class="">
                                        <input type="text" form="histoUpdateForm" class="form-control @error('bio_receive_date') is-invalid @enderror" id="datepicker" placeholder="dd/MM/YYYY" name="bio_receive_date" value="{{ old('bio_receive_date',$histo->bio_receive_date) }}">
                                        @error('bio_receive_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Hospital</label>
                                    <select form="histoUpdateForm" class="form-select @error('hospital') is-invalid @enderror" name="hospital" id="hospital-select">
                                        <option selected disabled>Select Hospital</option>
                                        @forelse($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $hospital->id == old('hospital',$histo->hospital_id) ? 'selected':'' }}>{{ $hospital->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('hospital')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Month</label>
                                    <div class="mb-4">
                                        <input type="number" name="month" min="0" form="histoUpdateForm" class="form-control @error('month') is-invalid @enderror" id="month" placeholder="Month" value="{{ old('month',$histo->month) }}">
                                        @error('month')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="datepicker1">Cutting Date</label>
                                    <div class="">
                                        <input type="text" form="histoUpdateForm" class="form-control @error('bio_cut_date') is-invalid @enderror" id="datepicker1" placeholder="dd/MM/YYYY" name="bio_cut_date" value="{{ old('bio_cut_date',$histo->bio_cut_date) }}">
                                        @error('bio_cut_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Specimen Type</label>
                                    <select form="histoUpdateForm" class="form-select @error('specimen_type') is-invalid @enderror" name="specimen_type" id="specimen-select">
                                        <option selected disabled>Select Specimen Type</option>
                                        @forelse($specimens as $specimen)
                                            <option value="{{ $specimen->id }}" {{ $specimen->id == old('specimen_type',$histo->specimen_type_id) ? 'selected':'' }}>{{ $specimen->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('specimen_type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Day</label>
                                    <div class="mb-4">
                                        <input type="number" name="day" min="0" form="histoUpdateForm" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="Day" value="{{ old('day',$histo->day) }}">
                                        @error('day')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="datepicker2">Report Date</label>
                                    <div class="">
                                        <input type="text" form="histoUpdateForm" class="form-control @error('bio_report_date') is-invalid @enderror" id="datepicker2" placeholder="dd/MM/YYYY" name="bio_report_date" value="{{ old('bio_report_date',$histo->bio_report_date) }}">
                                        @error('bio_report_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Gender</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" form="histoUpdateForm" {{ old('gender',$histo->gender) == 'Male' ? 'checked':'' }} type="radio" name="gender" id="genderM" value="Male">
                                        <label class="form-check-label" for="genderM">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" form="histoUpdateForm" {{ old('gender',$histo->gender) == 'Female' ? 'checked':'' }} type="radio" name="gender" id="genderF" value="Female">
                                        <label class="form-check-label" for="genderF">Female</label>
                                    </div>
                                    <br>
                                    @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="doctor">Referring Doctor</label>
                                    <input type="text" name="doctor" form="histoUpdateForm" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Refer Doctor" value="{{ old('doctor',$histo->doctor) }}">
                                    @error('doctor')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Photos</label>
                                    <div class="rounded p-2 d-flex overflow-scroll">
                                        <form action="{{ route('histo_gross.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="histo_id" value="{{ $histo->id }}">
                                            <div class="mb-3">
                                                <input type="file" name="gross_photos[]" id="inputPhotos" class="@error('gross_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                                @error('gross_photos')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                                @error('gross_photos.*')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary">Upload</button>
                                        </form>

                                        <div class="border border-2 rounded border-secondary uploader-ui me-1 d-flex justify-content-center align-items-center px-4" id="photoUploadUi">
                                            <i class="fa-solid fa-camera text-secondary fa-2x fa-fw"></i>
                                        </div>

                                        @forelse($histo->grossPhotos as $photo)
                                            <div class="position-relative">
                                                <form action="{{ route('histo_gross.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" id="delForm{{ $photo->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm px-2" onclick="return askConfirm({{ $photo->id }})">
                                                        <i class="fa-regular fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a class="venobox" data-gall="img" href="{{ asset('storage/gross_photos/'.$photo->name) }}">
                                                    <img src="{{ asset('storage/gross_thumbnails/'.$photo->name) }}" height="100" class="rounded me-1" alt="image alt"/>
                                                </a>
                                            </div>
                                        @empty
                                            <p class="mb-0 fw-bold ms-3" style="margin-top: 35px;">No Photo</p>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="gross" class="form-label">Gross</label>
                                    <div class="mb-4">
                                        <textarea form="histoUpdateForm" class="form-control @error('gross') is-invalid @enderror" name="gross" id="gross" placeholder="Enter Gross" style="height: 180px">{{ old('gross',$histo->gross) }}</textarea>
                                        @error('gross')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="specimen" class="form-label">Specimen</label>
                                    <div class="mb-4">
                                        <textarea form="histoUpdateForm" class="form-control @error('specimen') is-invalid @enderror" name="specimen" id="specimen" placeholder="Enter Specimen" style="height: 180px">{{ old('specimen',$histo->specimen) }}</textarea>
                                        @error('specimen')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Photos</label>
                                    <div class="rounded p-2 d-flex overflow-scroll">
                                        <form action="{{ route('histo_photos.store') }}" method="post" class="d-none" id="photoUploadForm2" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="histo_id" value="{{ $histo->id }}">
                                            <div class="mb-3">
                                                <input type="file" name="histo_photos[]" id="inputPhotos2" class="@error('histo_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                                @error('histo_photos')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                                @error('histo_photos.*')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary">Upload</button>
                                        </form>

                                        <div class="border border-2 rounded border-secondary uploader-ui me-1 d-flex justify-content-center align-items-center px-4" id="photoUploadUi2">
                                            <i class="fa-solid fa-camera text-secondary fa-2x fa-fw"></i>
                                        </div>

                                        @forelse($histo->histoPhotos as $photo)
                                            <div class="position-relative">
                                                <form action="{{ route('histo_photos.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" id="delForm{{ $photo->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm px-2" onclick="return askConfirm({{ $photo->id }})">
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
                                <div class="mb-4">
                                    <label for="description" class="form-label">Microscopic Description</label>
                                    <div class="mb-4">
                                        <textarea form="histoUpdateForm" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Microscopic Description" style="height: 180px">{{ old('description',$histo->description) }}</textarea>
                                        @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="remark" class="form-label">Remark</label>
                                    <div class="mb-4">
                                        <textarea form="histoUpdateForm" class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" placeholder="Enter Remark" style="height: 180px">{{ old('remark',$histo->remark) }}</textarea>
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

        let photoUploadForm2 = document.getElementById('photoUploadForm2');
        let photoInput2 = document.getElementById('inputPhotos2');
        let photoUploadUi2 = document.getElementById('photoUploadUi2');

        photoUploadUi2.addEventListener('click',function (){
            photoInput2.click();
        })

        photoInput2.addEventListener('change',function (){
            photoUploadForm2.submit();
        })

        // select2
        $('#specimen-select').select2();
        $('#hospital-select').select2();

        $('#datepicker').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#datepicker1').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $('#datepicker2').datepicker({
            dateFormat : 'yy-mm-dd'
        });

    </script>
@endpush
