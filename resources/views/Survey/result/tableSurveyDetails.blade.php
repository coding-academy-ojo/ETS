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
<div class="container">
<h1 class="mb-4  display-4">Survey Result</h1>

            <!-- Survey Listing Table -->
            <table id="news-table" class=" table table-sm table-custom table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Survey Response Status</th>
                        <th scope="col">Survey Info</th>
                    </tr>
                </thead>
                <tbody id="surveyInfo">
                    @foreach($surveys as $survey)
                    <tr>
                        <td>{{ $survey->student_full_name }}</td>
                        <td>{{ $survey->Response ? 'Response' : 'Response' }}</td>
                        <td>
                            <a href="{{ route('survey.detail', ['id' => $survey->id]) }}" class="btn btn-primary">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
