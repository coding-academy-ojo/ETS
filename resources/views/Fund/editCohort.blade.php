@extends('layouts.app')

@section('content')

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
<form action="{{ route('cohortFund.store_update', $selectedCohort->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <select class="form-control" id="academyDropdown" name="academy" required>
        <option value="" disabled>Select an Academy</option>
        @foreach ($academies as $academy)
        <option value="{{ $academy->id }}"
            {{ $selectedCohort && $academy->id == $selectedCohort->academy_id ? 'selected' : '' }}>
            {{ $academy->name }}
        </option>
        @endforeach
    </select>

    <!-- Cohort Dropdown -->
    <div class="form-group mt-3">
        <label for="cohortDropdown">Select Cohort Number:</label>
        <select class="form-control" id="cohortDropdown" name="cohort" required>
            <option value="" disabled>Select Cohort Number</option>
            @foreach ($cohorts->where('academy_id', optional($selectedCohort)->academy_id) as $cohort)
            <option value="{{ $cohort->id }}"
                {{ $selectedCohort && $cohort->id == $selectedCohort->id ? 'selected' : '' }}>
                {{ $cohort->slug }}
            </option>
            @endforeach
        </select>
    </div>

    <!-- Start Date -->
    <div class="form-group mt-3">
        <label for="startDate">Start Date:</label>
        <input type="date" class="form-control" id="startDate" name="start_date"
            value="{{ $selectedCohort ? \Carbon\Carbon::parse($selectedCohort->start_date)->format('Y-m-d') : '' }}">
    </div>

    <!-- End Date -->
    <div class="form-group mt-3">
        <label for="endDate">End Date:</label>
        <input type="date" class="form-control" id="endDate" name="end_date"
            value="{{ $selectedCohort && $selectedCohort->end_date ? \Carbon\Carbon::parse($selectedCohort->end_date)->format('Y-m-d') : '' }}">

    </div>
    <button type="submit" class="btn btn-primary">Update Cohort Data</button>

</form>

@endsection

@section('scripts')


<script>
const academyDropdown = document.getElementById('academyDropdown');
const cohortDropdown = document.getElementById('cohortDropdown');
const allCohorts = @json($cohorts);

academyDropdown.addEventListener('change', function() {
    const selectedAcademyId = this.value;
    cohortDropdown.innerHTML = '<option value="" disabled>Select Cohort Number</option>';

    allCohorts.forEach(cohort => {
        if (cohort.academy_id == selectedAcademyId) {
            const option = document.createElement('option');
            option.value = cohort.id;
            option.textContent = cohort.slug;
            cohortDropdown.appendChild(option);
        }
    });
});
</script>
</script>

@endsection