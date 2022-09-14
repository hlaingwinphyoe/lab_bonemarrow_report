@extends('layouts.app')
@section('title') Create : Cyto Report @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-capitalize fw-bold">
                            <i class="fa-solid fa-plus me-1"></i>create Cyto report
                        </h5>
                    </div>
                    <hr>

                    <form action="{{ route('cyto.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Enter Patient's Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}">

                                    @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="year" class="form-label ">Enter Year</label>
                                    <input type="number" name="year" min="0" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Year" value="{{ old('year',0) }}">

                                    @error('year')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="datepicker3" class="form-label">Receive Date</label>
                                    <input type="text" class="form-control @error('bio_receive_date') is-invalid @enderror" id="datepicker3" placeholder="dd/MM/YYYY" name="bio_receive_date" value="{{ old('bio_receive_date') }}">
                                    @error('bio_receive_date')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="" class="form-label">Hospital</label>
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
                                    <label for="month" class="form-label">Enter Month</label>
                                    <input type="number" name="month" min="0" class="form-control @error('month') is-invalid @enderror" id="month" placeholder="Month" value="{{ old('month',0) }}">

                                    @error('month')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
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
                                    <label for="day" class="form-label">Enter Day</label>
                                    <input type="number" name="day" min="0" class="form-control @error('day') is-invalid @enderror" id="day" placeholder="Day" value="{{ old('day',0) }}">

                                    @error('day')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-4">
                                    <label for="" class="form-label">Gender</label><br>
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
                                    <label for="doctor" class="form-label">Enter Referring Doctor</label>
                                    <input type="text" name="doctor" class="form-control @error('doctor') is-invalid @enderror" id="doctor" placeholder="Refer Doctor" value="{{ old('doctor') }}">
                                    @error('doctor')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
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
