@extends('layouts.app')
<style>
   h1{color:red;}
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;

        }
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            width: 50%;
            position: relative;
        }
        .stepper-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }
        .stepper-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -50%;
            transform: translateY(-50%);
            height: 4px;
            background-color: #dcdcdc;
            width: 100%;
            z-index: -1;
        }
        .step-counter {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #dcdcdc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: #fff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        .step-name {
            font-size: 1rem;
            text-align: center;
            color: #333;
        }
        .stepper-item.completed .step-counter {
            background-color: #28a745;
        }
        .stepper-item.completed .step-name {
            font-weight: bold;
            color: #28a745;
        }
        .stepper-item.completed:not(:last-child)::after {
            background-color: #28a745;
        }
    </style>
</style>
@section('content')
<!-- tracking system -->
<div class="main">
<div class="stepper-wrapper">
  <div class="stepper-item completed">
    <div class="step-counter">1</div>
    <div class="step-name">Three Month</div>
  </div>
  <div class="stepper-item completed">
    <div class="step-counter">2</div>
    <div class="step-name">Six Month</div>
  </div>
  <div class="stepper-item completed">
    <div class="step-counter">3</div>
    <div class="step-name">Nine Month</div>
  </div>
  
</div>
</div>


<!-- table section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Response</th>
                    </tr>
                </thead>
                <tr>
            <td>Three Month</td>
            <td><a class="btn btn-primary btn-sm" href="{{ route('tableSurveyDetails', ['academy' => $academy->id, 'academy_slug' => $academy->slug, 'cohort_id' => 0]) }}">Survey Result</a></td>
        </tr>
        <tr>
            <td>Six Month</td>
            <td><a class="btn btn-primary btn-sm" href="{{ route('tableSurveyDetails', ['academy' => $academy->id, 'academy_slug' => $academy->slug, 'cohort_id' => 1]) }}">Survey Result</a></td>
        </tr>
        <tr>
            <td>Nine Month</td>
            <td><a class="btn btn-primary btn-sm" href="{{ route('tableSurveyDetails', ['academy' => $academy->id, 'academy_slug' => $academy->slug, 'cohort_id' => 2]) }}">Survey Result</a></td>
        </tr>
            </table>
        </div>
    </div>
</div>



@endsection
