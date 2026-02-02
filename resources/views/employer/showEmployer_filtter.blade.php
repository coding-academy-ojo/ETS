@extends('employer_layout.employer_app')

@section('content')

<style>
.card {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);

}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 11px 20px rgba(0, 0, 0, 0.2);
}

.pagination .page-link svg {
    display: none;
}
</style>
<div class="row">
    <nav id="sidebarMenu" class="col-md- col-lg-2 d-md-block sidebar collapse position-fixed">
        <div class="position-sticky pt-3 nav flex-column flex-nowrap vh-100 overflow-auto ">

            <h6 class="sidebar-heading d-flex align-items-center justify-content-center px-3 mt-4 mb-1 text-primary">
                <i class="fa-solid fa-gauge"></i><span class="ms-2 ">Filters</span>
            </h6>
            <form action="{{ route('employer.filters') }}" method="POST" id="filter_form" class="mt-3 d-grid gap-3">
                @csrf
                <ul class="list-unstyled ps-0">
                    <li class="mb-1 ">
                        <button class="btn btn-toggle align-items-center collapsed w-100" data-bs-toggle="collapse"
                            data-bs-target="#education-collapse" aria-expanded="false" type="button">
                            <i class="fa fa-table"></i> <span class="ms-2">Education</span>
                        </button>
                        <div class="collapse ms-4 mt-2" id="education-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 fs-6">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="IT" value="IT" id="IT">
                                    <label class="form-check-label small fw-bold" for="it_background">
                                        IT Background
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>
                      <!-- Major-->
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center w-100 collapsed " data-bs-toggle="collapse"
                            data-bs-target="#major-collapse" aria-expanded="false" type="button">
                            <i class="fa-solid fa-school"></i><span class="ms-2">Major</span>
                        </button>
                        <div class="collapse ms-2 mt-1" id="major-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1  fs-6">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Computer_Science"
                                        value="Computer_Science" id="Computer_Science">
                                    <label class="form-check-label small fw-bold" for="Computer_Science">
                                        Computer Science
                                    </label>
                                </li>
                                <li>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Software_Engineering"
                                        value="Software_Engineering" id="Software_Engineering">
                                    <label class="form-check-label small fw-bold" for="Software_Engineering">
                                        Software Engineering
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Nationality -->
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center w-100 collapsed" data-bs-toggle="collapse"
                            data-bs-target="#nationality-collapse" aria-expanded="false" type="button">
                            <i class="fa-solid fa-building-flag"></i><span class="ms-2">Nationality</span>
                        </button>
                        <div class="collapse ms-4 mt-1 ms-4" id="nationality-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 fs-6 ">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Jordanian" value="Jordanian"
                                        id="Jordanian">
                                    <label class="form-check-label" for="Jordanian">
                                        Jordanian
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Non-Jordanian"
                                        value="Non-Jordanian" id="Non-Jordanian">
                                    <label class="form-check-label" for="Non-Jordanian">
                                        Non-Jordanian
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Gender -->
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center w-100 collapsed" data-bs-toggle="collapse"
                            data-bs-target="#gender-collapse" aria-expanded="false" type="button">
                            <i class="fa-solid fa-venus-mars"></i><span class="ms-2">Gender</span>
                        </button>
                        <div class="collapse ms-4 mt-1" id="gender-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 fs-6">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Female" value="Female"
                                        id="Female">
                                    <label class="form-check-label" for="Female">
                                        Female
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Male" value="Male" id="Male">
                                    <label class="form-check-label" for="Male">
                                        Male
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>
                     <!-- place of residence-->
                    <!-- <li class="mb-1">
                        <button class="btn btn-toggle align-items-center w-100 collapsed " data-bs-toggle="collapse"
                            data-bs-target="#place-collapse" aria-expanded="false" type="button">
                            <i class="fa-solid fa-city"></i><span class="ms-2">City</span>
                        </button>
                        <div class="collapse ms-4 mt-1 fs-1" id="place-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 fs-6">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Amman" value="Amman"
                                        id="Amman">
                                    <label class="form-check-label" for="Amman">
                                        Amman
                                    </label>
                                </li>
                                <li>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Irbid" value="Irbid"
                                        id="Irbid">
                                    <label class="form-check-label" for="Irbid">
                                        Irbid
                                    </label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Aqaba" value="Aqaba"
                                        id="Aqaba">
                                    <label class="form-check-label" for="Aqaba">
                                        Aqaba
                                    </label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Zarqa" value="Zarqa"
                                        id="Zarqa">
                                    <label class="form-check-label" for="Zarqa">
                                        Zarqa
                                    </label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Balqa" value="Balqa"
                                        id="Balqa">
                                    <label class="form-check-label" for="Balqa">
                                        Balqa
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <!-- Stack -->
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center w-100 collapsed " data-bs-toggle="collapse"
                            data-bs-target="#stack-collapse" aria-expanded="false" type="button">
                            <i class="fa fa-tasks"></i><span class="ms-2">Stack</span>
                        </button>
                        <div class="collapse ms-4 mt-1" id="stack-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 fs-6">
                                <li>
                                    <input class="form-check-input" type="checkbox" name="Mern_Stack" value="Mern_Stack"
                                        id="Mern_Stack">
                                    <label class="form-check-label" for="Mern_Stack">
                                        Mern Stack
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="laravel" value="laravel"
                                        id="laravel">
                                    <label class="form-check-label" for="laravel">
                                        Laravel
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="asp_net" value="asp_net"
                                        id="asp_net">
                                    <label class="form-check-label" for="asp_net">
                                        Asp.net
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <button type="submit" class="btn btn-secondary 
                    align-items-center w-100 
                    more-info-btn justify-content-center">Submit</button>
                </ul>

            </form>

        </div>
    </nav>

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-3 ">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 ms-3">

            <h1 class="h2">Candidate Profile</h1>

        </div>

        <div class="album ">
            @if($trainees->count() > 0)
            <div class="container">
                <div class="row row-cols-1 row-cols-md-5 g-3 text-center ">
                    @foreach($trainees as $trainee)
                    <div class="col">
                        <div class="card border-secondary rounded-3">
                            <img src="{{ asset('images/' . $trainee->personal_img) }}" class="bd-placeholder-img card-img-top"
                                width="100%" height="225" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">{{ $trainee['first_name'] }} {{ $trainee['last_name'] }}</h3>

                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('trainee.information', ['id' => $trainee['id']]) }}"
                                        class="btn btn-secondary more-info-btn">
                                        More Information
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                {{ $trainees->links() }}
                </div>
            </div>
            @endif
        </div>

    </main>
</div>

@endsection