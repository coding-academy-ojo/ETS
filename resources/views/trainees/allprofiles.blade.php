@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-3">
                    @foreach ($trainees as $trainee)
                        <div class="col mb-4">
                            <div class="card">
                                <img src="{{ $trainee->personal_img }}" class="card-img-top" alt="Avatar">
                                <div class="card-body text-center p-1">
                                    <h5 class="card-title fs-5">{{ $trainee->first_name }} {{ $trainee->last_name }}</h5>
                                    <p class="card-text fs-6">{{ $trainee->email }}</p>
                                    <a href="#" class="btn btn-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $trainees->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
