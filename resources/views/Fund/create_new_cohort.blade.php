@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{route('store_new_cohort_func')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <input type="hidden" name="fund_id" value="{{ $fund_id }}">

    <select class="form-control" id="academyDropdown" name="academy" required>
        <option value="" disabled selected>Select an Academy</option>
        @foreach ($academies_cohort as $academy)
        <option value="{{ $academy->id }}">
            {{ $academy->name }}
        </option>
        @endforeach
    </select>
    <!-- Start Date -->
    <div class="form-group mt-3">
        <label for="startDate">Start Date:</label>
        <input type="date" class="form-control" id="startDate" name="start_date" value="">
    </div>

    <!-- End Date -->
    <div class="form-group mt-3">
        <label for="endDate">End Date:</label>
        <input type="date" class="form-control" id="endDate" name="end_date" value="">

    </div>
    <button type="submit" class="btn btn-primary">Update Cohort Data</button>

</form>



@endsection