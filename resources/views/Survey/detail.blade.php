<!-- resources/views/survey/detail.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Survey Details</div>
        <div class="card-body">
            <h5>Survey ID: {{ $survey->id }}</h5>
            <p>Student Name: {{ $survey->student_full_name }}</p>
            <p>Employment_status: {{ $survey->employment_status }}</p>
            <p>Company_name: {{ $survey->company_name }}</p>
            <p>Job_title: {{ $survey->position}}</p>
            <p>Start_date: {{ $survey->joining_date }}</p>


            <!-- Add more details here based on your survey model -->
        </div>
    </div>
</div>
@endsection
