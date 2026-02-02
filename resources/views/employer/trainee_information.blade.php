@extends('employer_layout.employer_app')

@section('content')
<style>
.card:hover {
    transform: scale(1.09);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

.btn:hover {
    transform: translateY(-2px);
}

.icon-style:hover {
    color: #ff7900;
    transform: scale(1.1);
}

.card-title:hover {
    color: #ff7900;
    transform: scale(1.1);
}

p:hover {
    transform: scale(1.1);
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2>
        <i class="fa-solid fa-circle-info text-primary"></i> <span>Candidate Information</span>
    </h2>
</div>
<div class="container d-flex justify-content-center align-items-center min-vh-70" style="max-width: 1200px;">

    <div class="card shadow-lg " style="max-width: 800px; margin: 20px; ">
        <div class="row g-0">
            <div class="col-md-6 d-flex flex-column justify-content-center">

                <div class="card-body ">
                    <h5 class="card-title">{{ $trainee->first_name }} {{ $trainee->last_name }}</h5>
                    <p class="card-text"><span class="text-primary">
                        Field: 
                    </span>{{ $trainee->field }}</p>
                    <p class="card-text"><span class="text-primary">
                      Trainee gender:
                        </span>
                        {{ $trainee->gender }}</p>
                    <p class="card-text">
                    <span class="text-primary">
                     City: 
                     </span>
                     {{ $trainee->city }}</p>
                    <p class="card-text"><span class="text-primary">
                     Technology Stack:
                     </span>
                         {{ $trainee->stack }}</p>
                    <div class="d-flex justify-content-between h4 mt-3">
                        <a href="tel:{{ $trainee->mobile }}" class="text-decoration-none"><i
                                class="fas fa-phone icon-style"></i></a>
                        <a href="mailto:{{ $trainee->email }}" class="text-decoration-none"><i
                                class="fas fa-envelope icon-style"></i></a>
                        <a href="{{ $trainee->git_hub }}" target="_blank" class="text-decoration-none"><i
                                class="fab fa-github icon-style"></i></a>
                        <a href="{{ $trainee->linkedin }}" target="_blank" class="text-decoration-none"><i
                                class="fab fa-linkedin icon-style"></i></a>
                    </div>
                    <div class="card-body text-center mt-3">
                        <a href="{{ asset('cvs/' . $trainee->trainee_cv) }}" class="btn btn-secondary more-info-btn mb-2" target="_blank"
                            style="transition: background-color 0.3s, transform 0.3s;">Download CV</a>
                        <form action="{{ route('employer.add_to_short_listed') }}" method="POST" id="shortlist-form"
                            class="d-inline">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ Auth::guard('employer')->user()->id }}">
                            <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
                            <button type="submit" class="btn btn-secondary" {{ $isShortlisted ? 'disabled' : '' }}
                                style="transition: background-color 0.3s, transform 0.3s;">Add As Short Listed</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/' . $trainee->personal_img) }}" class="img-fluid rounded-start" alt="Trainee Image"
                    style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</div>



@endsection