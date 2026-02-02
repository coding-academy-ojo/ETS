@extends('layouts.app')

@section('content')

<h1>Edit Fund</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<form action="{{ route('fund.update', $fund_details->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <input type="hidden" class="form-control" id="id" name="id" 
                   value="{{($fund_details->id) }}" required>
        <div class="form-group">
            <label for="fundName" class="is-required">Fund Name</label>
            <input type="text" class="form-control" id="fund_name" name="fund_name" 
                   value="{{ old('fund_name', $fund_details->fund_name) }}" required>
        </div>

        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" 
                   value="{{ old('start_date', $fund_details->start_date) }}" required>
        </div>
        @error('start_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>
                <input type="checkbox" id="has_end_date" name="has_end_date" 
                       {{ $fund_details->end_date ? 'checked' : '' }}>
                Has End Date
            </label>
        </div>

        <div class="form-group" id="end_date_container" 
             style="{{ $fund_details->end_date ? '' : 'display: none;' }}">
            <label for="endDate">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" 
                   value="{{ old('end_date', $fund_details->end_date) }}">
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update Fund</button>
</form>

<script>
    // Toggle end_date container based on checkbox
    document.getElementById('has_end_date').addEventListener('change', function() {
        var container = document.getElementById('end_date_container');
        container.style.display = this.checked ? '' : 'none';
    });
</script>

@endsection
