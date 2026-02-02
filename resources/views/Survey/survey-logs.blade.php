@extends('layouts.app')

@section('content')

<style>
    .container-fluid-custom {
        padding: 5px;
        border-radius: 10px;
    }
    .table-custom {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .table-custom th, .table-custom td {
        vertical-align: middle;
    }
    .table-custom th {
        color: #000;
        border-bottom: 2px solid #0056b3;
    }
    .table-custom tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-custom {
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.3s;
    }
    .btn-custom-success {
        background-color: #28a745;
        color: white;
    }
    .btn-custom-success:hover {
        background-color: #218838;
        transform: translateY(-3px);
    }
    .btn-custom-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-custom-primary:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }
    .alert-custom {
        border-radius: 10px;
    }
    .file-input {
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
<div class="container-fluid container-fluid-custom mt-5">
    <h1 class="display-4 mb-4">Survey Logs</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="news-table" class=" table table-sm table-custom table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Type</th>
                                    <th>Sent</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surveyLogs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->survey->student_full_name }}</td>
                                    <td>{{ $log->type }}</td>
                                    <td>{{ $log->sent ? 'Yes' : 'No' }}</td>
                                    <td>{{ $log->created_at->format('d.m.Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
