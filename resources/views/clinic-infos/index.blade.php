@extends('layouts.app')

@section("title") Clinic Info : Biopsy Reports @endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Clinic Information</li>
        </ol>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="text-capitalize fw-bold mb-4">
                        <i class="fa-solid fa-hospital me-2"></i>Clinic Information
                    </h5>

                    @if($clinicInfo)
                        {{-- Update Form --}}
                        <form action="{{ route('clinic-infos.update', $clinicInfo->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="clinicName" placeholder="Clinic Name" value="{{ old('name', $clinicInfo->name) }}" required>
                                <label for="clinicName"><i class="me-1 fa-solid fa-building"></i>Clinic Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="clinicAddress" placeholder="Address" style="height: 120px" required>{{ old('address', $clinicInfo->address) }}</textarea>
                                <label for="clinicAddress"><i class="me-1 fa-solid fa-location-dot"></i>Address</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Clinic Phones Section --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa-solid fa-phone me-1"></i>Phone Numbers
                                </label>
                                <div id="phonesContainer">
                                    @forelse($clinicInfo->clinic_phones ?? [] as $index => $phone)
                                        <div class="input-group mb-3 phone-row">
                                            <select class="form-select phone-type" style="max-width: 130px;">
                                                <option value="mobile" {{ ($phone->type ?? 'mobile') == 'mobile' ? 'selected' : '' }}>📱 Mobile</option>
                                                <option value="office" {{ ($phone->type ?? '') == 'office' ? 'selected' : '' }}>🏢 Office</option>
                                                <option value="fax" {{ ($phone->type ?? '') == 'fax' ? 'selected' : '' }}>📠 Fax</option>
                                                <option value="emergency" {{ ($phone->type ?? '') == 'emergency' ? 'selected' : '' }}>🚨 Emergency</option>
                                                <option value="other" {{ ($phone->type ?? '') == 'other' ? 'selected' : '' }}>📞 Other</option>
                                            </select>
                                            <input type="text" class="form-control phone-input" placeholder="Phone number" value="{{ $phone->phone ?? '' }}">
                                            <button type="button" class="btn btn-outline-danger" onclick="removePhone(this)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="text-muted small mb-2" id="noPhonesMsg">No phone numbers added yet.</div>
                                    @endforelse
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="addPhone()">
                                    <i class="fa-solid fa-plus me-1"></i>Add Phone
                                </button>
                            </div>

                            {{-- Hidden phones field --}}
                            <input type="hidden" name="phones" id="phonesJsonInput" value="{{ json_encode($clinicInfo->clinic_phones ?? []) }}">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-save me-1"></i>
                                Update
                            </button>
                        </form>
                    @else
                        {{-- Create Form --}}
                        <form action="{{ route('clinic-infos.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="clinicName" placeholder="Clinic Name" value="{{ old('name') }}" required>
                                <label for="clinicName"><i class="me-1 fa-solid fa-building"></i>Clinic Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="clinicAddressCreate" placeholder="Address" style="height: 120px" required>{{ old('address') }}</textarea>
                                <label for="clinicAddressCreate"><i class="me-1 fa-solid fa-location-dot"></i>Address</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Clinic Phones Section --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa-solid fa-phone me-1"></i>Phone Numbers
                                </label>
                                <div id="phonesContainerCreate">
                                    <div class="text-muted small mb-2" id="noPhonesMsgCreate">No phone numbers added yet.</div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="addPhoneCreate()">
                                    <i class="fa-solid fa-plus me-1"></i>Add Phone
                                </button>
                            </div>

                            {{-- Hidden phones field --}}
                            <input type="hidden" name="phones" id="phonesJsonInputCreate" value="[]">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-plus me-1"></i>
                                Create
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Logo Upload Section --}}
        <div class="col-12 col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="text-capitalize fw-bold mb-4">
                        <i class="fa-solid fa-image me-2"></i>Clinic Logo
                    </h5>

                    @if($clinicInfo)
                        {{-- Logo Preview --}}
                        <div class="text-center mb-3">
                            @if($clinicInfo->logo)
                                <img src="{{ asset('storage/' . $clinicInfo->logo) }}" id="logoPreview" style="max-width: 200px; max-height: 200px;" class="rounded border border-2 p-2 border-primary img-fluid" alt="Clinic Logo">
                            @else
                                <img src="{{ asset('images/logo.png') }}" id="logoPreview" style="max-width: 200px; max-height: 200px;" class="rounded border border-2 p-2 border-primary img-fluid" alt="Default Logo">
                                <p class="text-muted mt-2"><small>No logo uploaded yet</small></p>
                            @endif
                        </div>

                        {{-- Upload Form --}}
                        <form action="{{ route('clinic-infos.update', $clinicInfo->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- Hidden fields to pass existing data --}}
                            <input type="hidden" name="name" value="{{ $clinicInfo->name }}">
                            <input type="hidden" name="address" value="{{ $clinicInfo->address }}">
                            <input type="hidden" name="phones" id="logoPhonesInput" value="{{ json_encode($clinicInfo->clinic_phones ?? []) }}">

                            <div class="file-upload mt-3">
                                <button class="file-upload__button btn btn-danger" type="button">
                                    <i class="fa-solid fa-folder-open me-1"></i>Choose Logo
                                </button>
                                <span class="file-upload__label ms-2"></span>
                                <input type="file" name="logo" id="logoUpload" class="file-upload__input" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
                            </div>
                            @error('logo')
                                <div class="text-danger mt-2"><small>{{ $message }}</small></div>
                            @enderror

                            @if($clinicInfo->logo)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="removeLogo">
                                    <label class="form-check-label text-danger" for="removeLogo">
                                        <i class="fa-solid fa-trash me-1"></i>Remove current logo
                                    </label>
                                </div>
                            @endif

                            <hr>
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-upload me-1"></i>
                                Upload Logo
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <i class="fa-solid fa-info-circle me-2"></i>
                            Please create clinic information first before uploading a logo.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    // Create phone row HTML template
    function createPhoneRowHtml() {
        return `
            <div class="input-group mb-2 phone-row">
                <select class="form-select phone-type" style="max-width: 130px;">
                    <option value="mobile">📱 Mobile</option>
                    <option value="office">🏢 Office</option>
                    <option value="fax">📠 Fax</option>
                    <option value="emergency">🚨 Emergency</option>
                    <option value="other">📞 Other</option>
                </select>
                <input type="text" class="form-control phone-input" placeholder="Phone number">
                <button type="button" class="btn btn-outline-danger" onclick="removePhone(this)">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;
    }

    // Add phone for Update form
    function addPhone() {
        const container = document.getElementById('phonesContainer');
        const noMsg = document.getElementById('noPhonesMsg');
        if (noMsg) noMsg.remove();
        container.insertAdjacentHTML('beforeend', createPhoneRowHtml());
    }

    // Add phone for Create form
    function addPhoneCreate() {
        const container = document.getElementById('phonesContainerCreate');
        const noMsg = document.getElementById('noPhonesMsgCreate');
        if (noMsg) noMsg.remove();
        container.insertAdjacentHTML('beforeend', createPhoneRowHtml());
    }

    // Remove phone row
    function removePhone(btn) {
        btn.closest('.phone-row').remove();
    }

    // Collect phones data from container
    function collectPhonesData(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return [];

        const phones = [];
        container.querySelectorAll('.phone-row').forEach(row => {
            const phone = row.querySelector('.phone-input').value.trim();
            const type = row.querySelector('.phone-type').value;
            if (phone) {
                phones.push({ phone, type });
            }
        });
        return phones;
    }

    // Intercept form submission to update phones JSON
    document.addEventListener('DOMContentLoaded', function() {
        // Update form
        const updateForm = document.querySelector('form[action*="clinic-infos"][method="post"]');
        if (updateForm && document.getElementById('phonesJsonInput')) {
            updateForm.addEventListener('submit', function(e) {
                const phones = collectPhonesData('phonesContainer');
                document.getElementById('phonesJsonInput').value = JSON.stringify(phones);
            });
        }

        // Create form
        const createForm = document.querySelector('form[action*="clinic-infos.store"]');
        if (createForm && document.getElementById('phonesJsonInputCreate')) {
            createForm.addEventListener('submit', function(e) {
                const phones = collectPhonesData('phonesContainerCreate');
                document.getElementById('phonesJsonInputCreate').value = JSON.stringify(phones);
            });
        }
    });

    // Logo preview on file select
    document.getElementById('logoUpload')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('logoPreview');
                preview.src = e.target.result;
                preview.classList.remove('border-secondary');
                preview.classList.add('border-primary');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush