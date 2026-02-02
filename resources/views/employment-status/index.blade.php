@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1>Trainees List </h1>
        <a href="{{ route('export.trainees', ['academy_id' => $academy->id, 'cohort_id' => $cohort->id]) }}" class="btn btn-success">Export Trainees</a>
        <form action="{{ route('trainees.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls,.csv">
            <button type="submit" class="btn btn-danger">Import Trainees</button>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mt-3">
            @foreach($trainees as $trainee)
                <div class="col mb-4">
                    <div class="card">
                        <img src="{{ $trainee->personal_img }}" class="card-img-top" alt="Trainee Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $trainee->first_name }} {{ $trainee->last_name }}</h5>
                            <p class="card-text">ID: {{ $trainee->id }}</p>
                            <!-- Add more details as needed -->
                            <a href="{{ route('employment-status.logs', ['id' => $trainee->id]) }}" class="btn btn-sm btn-info">
                                History
                            </a>
                            <a href="{{ route('employment-status.edit', $trainee->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('employment-status.destroy', $trainee->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this trainee?')">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('trainees.profile', ['id' => $trainee->id]) }}" class="btn btn-sm btn-info">
                                Info
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
