@extends('layouts.app')

@section('content')
    <style>
        /* Card Styling consistent with Add page */
        .edit-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid #eef0f2;
        }

        .card-header-custom {
            background-color: #f8f9fa;
            border-bottom: 2px solid #0d6efd; /* Bootstrap Primary Blue */
            border-radius: 12px 12px 0 0 !important;
            padding: 20px;
        }

        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }

        .readonly-input {
            background-color: #f1f3f5 !important;
            border-color: #dee2e6 !important;
            color: #0d6efd !important;
            font-weight: 600;
            cursor: not-allowed;
        }

        .input-group-text {
            background-color: #fff;
            border-right: none;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
    </style>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none text-primary">Companies</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('companies.show', $up_employee->company_id) }}" class="text-decoration-none text-primary">Company Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Employer</li>
                    </ol>
                </nav>

                <div class="card edit-card border-0">
                    <div class="card-header card-header-custom">
                        <h3 class="mb-0 fw-bold"><i class="fas fa-user-edit me-2 text-primary"></i>Edit Employer Details</h3>
                    </div>

                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('employer.storeEditEmployer', ['id' => $up_employee->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $up_employee->id }}">
                            <input type="hidden" name="company_id" value="{{ $up_employee->company_id }}">

                            <div class="mb-4">
                                <label class="form-label-custom">Employer Company</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building text-muted"></i></span>
                                    <input type="text"
                                           class="form-control readonly-input"
                                           value="{{ $up_employee->company->company_name }}"
                                           readonly>
                                </div>
                                <small class="text-muted mt-1 d-block">Company association cannot be changed here.</small>
                            </div>

                            <hr class="my-4 opacity-50">

                            <div class="mb-4">
                                <label for="name" class="form-label-custom">Employer Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="name" id="name"
                                           class="form-control"
                                           value="{{ $up_employee->name }}"
                                           required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label-custom">Employer Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" id="email"
                                           class="form-control"
                                           value="{{ $up_employee->email }}"
                                           required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 mt-2 border-top">
                                <a href="{{ route('companies.show', $up_employee->company_id) }}" class="btn btn-light px-4 border text-secondary fw-semibold">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                    <i class="fas fa-sync-alt me-2"></i> Update Employer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
