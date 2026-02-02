@extends('layouts.app')

@section('content')
    <style>
        /* Main Layout Styling */
        .create-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid #eef0f2;
        }

        .card-header-custom {
            background-color: #f8f9fa;
            border-bottom: 2px solid #0056b3;
            border-radius: 12px 12px 0 0 !important;
            padding: 25px;
        }

        /* Fixed Title Styling */
        .header-title {
            color: #212529 !important;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .trainee-name-badge {
            background-color: #e7f1ff;
            color: #0056b3;
            padding: 4px 12px;
            border-radius: 8px;
            border: 1px solid #cfe2ff;
            margin-left: 10px;
            font-weight: 800;
        }

        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-text {
            background-color: #fff;
            border-right: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.15);
        }

        /* Search/Select Combo Styling */
        #company-search {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        #company {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-top: none;
        }
    </style>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none">Trainees</a></li>
                        <li class="breadcrumb-item active">Employment History</li>
                    </ol>
                </nav>

                <div class="card create-card border-0">
                    <div class="card-header card-header-custom">
                        <h3 class="header-title fw-bold">
                            <i class="fas fa-history me-3 text-primary"></i>
                            Create Log for
                            <span class="trainee-name-badge shadow-sm">
                            {{ $trainee->first_name }} {{ $trainee->last_name }}
                        </span>
                        </h3>
                        <p class="text-muted small mb-0 mt-2 ms-5">Assign a new employment status or company to this trainee.</p>
                    </div>

                    <div class="card-body p-4">
                        <form id="logForm" action="{{ route('employment-status.logs.store', $trainee->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Employment Status --}}
                                <div class="col-md-6 mb-4">
                                    <label for="employeeStatus" class="form-label-custom">Employee Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-info-circle text-muted"></i></span>
                                        <select class="form-select" id="employeeStatus" name="status" required>
                                            <option value="">Select Employment Status</option>
                                            <option value="job offer">Job offer</option>
                                            <option value="internship_for_Employment">Internship for Employment</option>
                                            <option value="freelance">Freelance</option>
                                            <option value="available">Available</option>
                                            <option value="Dropped">Dropped</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- IT Position --}}
                                <div class="col-md-6 mb-4" id="positionGroup">
                                    <label for="position" class="form-label-custom">IT Position <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-briefcase text-muted"></i></span>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="e.g. Frontend Developer">
                                    </div>
                                    <small id="position-error" class="text-danger" style="display:none;">IT Position is required.</small>
                                </div>
                            </div>

                            {{-- Company Search and Select --}}
                            <div class="mb-4" id="companyGroup">
                                <label for="company-search" class="form-label-custom">Select Company <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" id="company-search" class="form-control" placeholder="Type company name to filter list...">
                                </div>
                                <select class="form-select" id="company" name="company" size="1">
                                    <option value="">Not working / Private Project</option>
                                    @foreach($names_companies as $company)
                                        <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                <small id="company-error" class="text-danger" style="display:none;">Please select a company for this status.</small>
                                <p id="typing-indicator" class="text-muted small mt-2">Filter from {{ count($names_companies) }} available companies.</p>
                            </div>

                            <hr class="my-4 opacity-50">

                            <div class="row">
                                {{-- Start Date --}}
                                <div class="col-md-6 mb-4">
                                    <label for="start_date" class="form-label-custom">Employment Start Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt text-muted"></i></span>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                </div>

                                {{-- End Date Toggle --}}
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom">Contract Duration</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" id="has_end_date" name="has_end_date">
                                        <label class="form-check-label fw-bold text-muted" for="has_end_date">This position has an end date</label>
                                    </div>

                                    <div id="end_date_container" class="mt-3" style="display:none;">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-check text-muted"></i></span>
                                            <input type="date" class="form-control" id="end_date" name="end_date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-light px-4 border fw-semibold text-secondary">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                    <i class="fas fa-save me-2"></i> Save Employment Log
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companySearch = document.getElementById('company-search');
            const companySelect = document.getElementById('company');
            const typingIndicator = document.getElementById('typing-indicator');
            const statusSelect = document.getElementById('employeeStatus');
            const companyGroup = document.getElementById('companyGroup');
            const positionGroup = document.getElementById('positionGroup');
            const hasEndDate = document.getElementById('has_end_date');
            const endDateContainer = document.getElementById('end_date_container');
            const endDateInput = document.getElementById('end_date');
            const positionInput = document.getElementById('position');
            const positionError = document.getElementById('position-error');
            const companyError = document.getElementById('company-error');
            const logForm = document.getElementById('logForm');

            // Company search filter logic
            companySearch.addEventListener('input', function () {
                const query = this.value.toLowerCase();
                const options = companySelect.options;
                let count = 0;

                for (let option of options) {
                    const matches = option.text.toLowerCase().includes(query);
                    option.style.display = matches ? '' : 'none';
                    if (matches) count++;
                }

                typingIndicator.innerHTML = query ? `<i class="fas fa-filter me-1"></i> Found ${count} matches` : 'Start typing to filter companies...';
                companySelect.size = Math.min(count + 1, 6);
            });

            companySelect.addEventListener('change', function () {
                if(this.value) {
                    companySearch.value = this.options[this.selectedIndex].text;
                    companyError.style.display = 'none';
                    companySelect.classList.remove('is-invalid');
                }
                this.size = 1;
            });

            // Toggle End Date Field Visibility
            hasEndDate.addEventListener('change', function () {
                if (this.checked) {
                    endDateContainer.style.display = 'block';
                    endDateInput.required = true;
                } else {
                    endDateContainer.style.display = 'none';
                    endDateInput.required = false;
                    endDateInput.value = '';
                }
            });

            // Hide company & position for "available" or "Dropped"
            function toggleFields() {
                const isHidden = (statusSelect.value === 'available' || statusSelect.value === 'Dropped');
                companyGroup.style.display = isHidden ? 'none' : 'block';
                positionGroup.style.display = isHidden ? 'none' : 'block';

                // Reset errors when toggling
                if(isHidden) {
                    companyError.style.display = 'none';
                    positionError.style.display = 'none';
                }
            }

            statusSelect.addEventListener('change', toggleFields);
            toggleFields();

            // Combined Form Validation
            logForm.addEventListener('submit', function(e) {
                let isValid = true;
                const statusRequiresDetails = (statusSelect.value !== 'available' && statusSelect.value !== 'Dropped' && statusSelect.value !== '');

                if (statusRequiresDetails) {
                    // Validate Position
                    if (positionInput.value.trim() === '') {
                        positionError.style.display = 'block';
                        positionInput.classList.add('is-invalid');
                        isValid = false;
                    }

                    // Validate Company (Ensures it's not empty/Default option)
                    if (companySelect.value === '') {
                        companyError.style.display = 'block';
                        companySelect.classList.add('is-invalid');
                        isValid = false;
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to the first error
                    const firstError = document.querySelector('.is-invalid');
                    if(firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            // Clear errors on input
            positionInput.addEventListener('input', function() {
                positionError.style.display = 'none';
                positionInput.classList.remove('is-invalid');
            });
        });
    </script>
@endsection
