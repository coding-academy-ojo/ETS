@extends('employer_layout.employer_app')

@section('content')
<style>
      .card:hover {
       
        box-shadow: 0 9px 4px rgba(0, 0, 0, 0.3);
    }
    .btn:hover {
        background-color: #595959;
        color:white;
        transform: translateY(-2px);
    }
    .icon-style:hover {
        color: #ff7900;
        transform: scale(1.1);
    }
    .card-title:hover{
        color: #ff7900;
        transform: scale(1.1);
    }
    p:hover{
        transform: scale(1.1);
    }
</style>
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h2>
    <i class="fa-regular fa-star text-primary"></i>
    <span class="h2">Candidate Shortlisted</span>
</h2>
    

</div>
<div class="container ">
    <div class="row ">


        <div class="container text-center">
            @if($trainees->count() > 0)
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($trainees as $trainee)
                <div class="col">
                    <div class="card h-100 custom-card ">
                        <img src="{{ $trainee['personal_img'] }}" class="card-img-top img_show_emp" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">{{ $trainee['first_name'] }} {{ $trainee['last_name'] }}</h3>
                            <p class="card-text fw-bold mb-4">Technology Stack: {{$trainee['stack'] }}</p>
                            <a href="{{ route('employer.showTraineeListUpdate', ['id' => $trainee['id']]) }}"
                                class="btn btn-secondary more-info-btn  d-flex align-items-center" style="transition: background-color 0.3s, transform 0.3s;">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

</div>

@endsection