@extends('layouts.app')

@section('content')
    <style>
        .container-fluid-custom {
            padding: 20px 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .management-bar {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid #eef0f2;
        }

        .table-custom {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .table-custom th {
            color: #000;
            border-bottom: 2px solid #0056b3;
            background-color: #f8f9fa;
            font-weight: 700;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table-custom td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table-custom tbody tr:hover {
            background-color: #f1f7ff;
        }

        .bar-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
        }

        .company-badge {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
    </style>

    <div class="container-fluid container-fluid-custom">

        <div class="page-header">
            <div>
                <h1 class="fw-bold mb-0">All Employers</h1>
                <p class="text-muted mb-0">Manage and export global employer records</p>
            </div>
            <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to Companies
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="management-bar">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <span class="bar-label">Search Employers</span>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-primary"><i class="fas fa-search text-primary"></i></span>
                        <input type="text" id="custom-search" class="form-control border-primary" placeholder="Search name, email, or company...">
                    </div>
                </div>

                <div class="col-md-5">
                    <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span class="bar-label">Import Employers (Excel/CSV)</span>
                        <div class="input-group shadow-sm">
                            <input type="file" name="file" class="form-control" required>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-upload me-1"></i> Import
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-3">
                    <span class="bar-label">Data Action</span>
                    <a href="{{ route('employees.export') }}" class="btn btn-success w-100 shadow-sm fw-bold">
                        <i class="fas fa-file-excel me-2"></i>Export All Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                <table id="employees-table" class="table table-custom mb-0">
                    <thead>
                    <tr>
                        <th style="width: 30%;">Employer Name</th>
                        <th style="width: 35%;">Email Address</th>
                        <th style="width: 35%;">Associated Company</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        @if($employee->status == 'active')
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-muted small"></i>
                                        </div>
                                        <span class="fw-bold text-dark">{{ $employee->name }}</span>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $employee->email }}</td>
                                <td>
                                <span class="company-badge">
                                    <i class="fas fa-building me-1 small"></i>
                                    {{ $employee->company->company_name ?? 'No Company' }}
                                </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#employees-table').DataTable({
                dom: 't<"d-flex justify-content-between p-3"ip>', // Hides default search/length
                lengthChange: false,
                pageLength: 10,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    }
                }
            });

            // Link the custom search bar to the DataTable
            $('#custom-search').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection
