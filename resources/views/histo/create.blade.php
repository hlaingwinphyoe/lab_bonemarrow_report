@extends('layouts.app')
@section('title') Create : Histo Report @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-plus me-1"></i>Create Histo report
                        </h5>
                    </div>
                    <hr>

                    <form action="{{ route('histo.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="name">Patient's Name</label>
                                    <div class="mb-4">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="">Year</label>
                                    <input type="number" name="year" min="0" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',0) }}">
                                    @error('year')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="datepicker">Receive Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_receive_date') is-invalid @enderror" id="datepicker" placeholder="dd/MM/YYYY" name="bio_receive_date" value="{{ old('bio_receive_date') }}">
                                        @error('bio_receive_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Hospital</label>
                                    <select class="form-select @error('hospital') is-invalid @enderror" name="hospital" id="hospital-select">
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
                                    <label class="form-label" for="">Month</label>
                                    <div class="mb-4">
                                        <input type="number" name="month" min="0" class="form-control @error('month') is-invalid @enderror" id="month" placeholder="Month" value="{{ old('month',0) }}">
                                        @error('month')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="datepicker1">Cutting Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_cut_date') is-invalid @enderror" id="datepicker1" placeholder="dd/MM/YYYY" name="bio_cut_date" value="{{ old('bio_cut_date') }}">
                                        @error('bio_cut_date')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label class="form-label" for="">Specimen Type</label>
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
                                    <label class="form-label" for="">Day</label>
                                    <div class="mb-4">
                                        <input type="number" name="day" min="0" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="Day" value="{{ old('day',0) }}">
                                        @error('day')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="datepicker2">Report Date</label>
                                    <div class="">
                                        <input type="text" class="form-control @error('bio_report_date') is-invalid @enderror" id="datepicker2" placeholder="dd/MM/YYYY" name="bio_report_date" value="{{ old('bio_report_date') }}">
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
                                <div class="mb-4">
                                    <label class="form-label" for="doctor">Referring Doctor</label>
                                    <input type="text" name="doctor" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Refer Doctor" value="{{ old('doctor') }}">
                                    @error('doctor')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-4">
                                    <div class="file-upload ">

                                        <button class="file-upload__button btn btn-danger" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>

                                        <input type="file" name="gross_photos[]" id="inputPhotos" class="file-upload__input @error('gross_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                        @error('gross_photos')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        @error('gross_photos.*')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="gross" class="form-label">Gross</label>
                                    <div class="mb-4">
                                        <textarea class="form-control @error('gross') is-invalid @enderror" name="gross" id="gross" placeholder="Enter Gross" style="height: 180px">{{ old('gross') }}</textarea>
                                        @error('gross')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="specimen" class="form-label">Specimen</label>
                                    <div class="mb-4">
                                        <textarea class="form-control @error('specimen') is-invalid @enderror" name="specimen" id="specimen" placeholder="Enter Specimen" style="height: 180px">{{ old('specimen') }}</textarea>
                                        @error('specimen')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-4">
                                    <div class="file-upload">
                                        <button class="file-upload__button btn btn-danger" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>

                                        <input type="file" name="histo_photos[]" id="inputPhotos" class="file-upload__input @error('histo_photos') is-invalid @enderror" multiple accept="image/jpeg,image/png">
                                        @error('histo_photos')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        @error('histo_photos.*')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="form-label">Microscopic Description</label>
                                    <div class="mb-4">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Microscopic Description" style="height: 180px">{{ old('description') }}</textarea>
                                        @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="remark" class="form-label">Remark</label>
                                    <div class="mb-4">
                                        <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" placeholder="Enter Remark" style="height: 180px">{{ old('remark') }}</textarea>
                                        @error('remark')
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
