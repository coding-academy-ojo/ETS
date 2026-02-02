@extends('layouts.app')
<style>
    .progress {
        background-color: #e9ecef;
        position: relative;
    }

    .progress-text {
        position: absolute;
        width: 100%;
        text-align: center;
        color: white !important;
        font-weight: 600;
        top: 0;
        line-height: 25px; /* Match height of .progress */
        z-index: 2;
    }

</style>
@section('name')
<h3> Coding Academy </h3>
@endsection
@section('content')

<div class="row">
    <!-- Employment Rate Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card text-bg-dark mb-3 border border-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                            class="solaris-icon si-medal" viewBox="0 0 1000 1000">
                            <path
                                d="M667.678 357.322 925 100H625L517.678 207.322ZM500 425a200 200 0 1 1-141.421 58.579A198.7 198.7 0 0 1 500 425m0-75c-151.878 0-275 123.122-275 275s123.122 275 275 275 275-123.122 275-275-123.122-275-275-275M350 576.412 429.412 647l-26.471 105.882L500 699.941l97.059 52.941L570.588 647 650 576.412l-105.882-17.647L500 467l-44.118 91.765ZM500 325a298.8 298.8 0 0 1 129.164 29.164L375 100H75l268.819 268.819A298.6 298.6 0 0 1 500 325"
                                style="fill-rule:evenodd" />
                        </svg>
                    </div>
                    <div class="col-6 ">
                        <h5 class="custom_font card-title text-primary ">Employment Rate</h5>
                        <p class="card-text fs-3">{{$overallEmploymentRate}}%</p> Percentage
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Trainees Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card text-bg-dark mb-3 border border-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                            class="solaris-icon si-group" viewBox="0 0 1000 1000">
                            <path
                                d="M338 875V696.837A100.18 100.18 0 0 1 263 600V487.5a187.2 187.2 0 0 1 17.626-79.433 166.44 166.44 0 0 1-107.2-45.325A152.94 152.94 0 0 0 88 500v119.118C88 658.1 120.015 690 159 690v185a49.65 49.65 0 0 0 49.588 50h148.57A74.7 74.7 0 0 1 338 875m489.576-512.258a166.44 166.44 0 0 1-107.2 45.325A187.2 187.2 0 0 1 738 487.5V600a100.18 100.18 0 0 1-75 96.837V875a74.7 74.7 0 0 1-19.158 50h148.57A49.65 49.65 0 0 0 842 875V690c38.985 0 71-31.9 71-70.882V500a152.94 152.94 0 0 0-85.424-137.258M713 125a124.4 124.4 0 0 0-65.376 18.446c.9 1.913 1.769 3.84 2.6 5.794a162.38 162.38 0 0 1-24.162 166.435l7.231 3.564a187.9 187.9 0 0 1 66.676 55.086A125 125 0 1 0 713 125m-75 87.5A137.5 137.5 0 1 1 500.5 75 137.5 137.5 0 0 1 638 212.5m-15.763 129.164a177.47 177.47 0 0 1-243.474 0A162.5 162.5 0 0 0 288 487.5V600a75 75 0 0 0 75 75v200a50 50 0 0 0 50 50h175a50 50 0 0 0 50-50V675a75 75 0 0 0 75-75V487.5a162.5 162.5 0 0 0-90.763-145.836m-321.2 32.661a187.9 187.9 0 0 1 66.676-55.086l7.231-3.564A162.7 162.7 0 0 1 350.78 149.24c.827-1.954 1.7-3.881 2.6-5.794A125 125 0 1 0 288 375a126 126 0 0 0 13.035-.675Z"
                                style="fill-rule:evenodd" />
                        </svg>

                    </div>
                    <div class="col-6">
                        <h5 class="custom_font card-title text-primary ">Total Trainees</h5>
                        <p class="card-text fs-3  ">{{$totalTrainees}}</p> Trainees
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Trainees Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card text-bg-dark mb-3 border border-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                            class="solaris-icon si-training-session" viewBox="0 0 1000 1000">
                            <path
                                d="M848.963 713H150.038a25 25 0 0 0-22.971 34.848L175 863h24.991v75H800v-75h24.771l47.162-115.152A25 25 0 0 0 848.963 713m-228.38-271.592L499.887 538l-120.7-96.592A162.54 162.54 0 0 0 249.975 600.5V688H475v-32a49.869 49.869 0 1 1 50 0v32h225v-88c0-78.354-55.64-143.25-129.417-158.592M650 212l-141.858 49.6-8.255 2.89-8.256-2.89L350 212v101a150 150 0 0 0 300 0zm60-48 39.8-13.5L499.887 63l-249.912 87.5L499.887 238 690 171v167l-10.177 50H721l-11-50z"
                                style="fill-rule:evenodd" />
                        </svg>

                    </div>

                    <div class="col-6">
                        <h5 class="custom_font card-title text-primary">Available Trainees</h5>
                        <p class="card-text fs-3">{{$availableTrainees}}</p> Trainees
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card text-bg-dark mb-3 border border-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                            class="solaris-icon si-modifier-filled-tick" viewBox="0 0 1000 1000">
                            <path
                                d="M500 75C265.28 75 75 265.28 75 500s190.28 425 425 425 425-190.28 425-425S734.72 75 500 75m-33.97 597.11-85.86 85.87-85.86-85.87-128.8-128.79 85.86-85.86 128.8 128.79L723.62 242.8l85.86 85.86z" />
                        </svg>
                    </div>
                    <div class="col-6">
                        <h5 class="custom_font card-title text-primary">Completion Rate</h5>
                        <p class="card-text fs-3">{{$completionRate}}%</p> Percentage
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<h2>{{ $academy->name }} Cohorts Details</h2>
<center> <canvas id="cohortsChart" width="400" height="200"></canvas></center>
<div class="chart-container">

</div>

<div class="table-container">
    <h2>{{ $academy->name }} Cohorts Details</h2>
    <table id="news-table" class=" table table-sm table-custom table-striped table-bordered">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Cohort</th>
                <th scope="col">Total Trainees</th>
                <th scope="col">Total Female</th>
                <th scope="col">Total Male</th>
                <th scope="col">Total Graduates</th>
                <th scope="col">Employed Graduates</th>
                <th scope="col">Available</th>
                <th scope="col">Employment Rate</th>
                <th scope="col">View Trainees</th>
                <th scope="col">Cohort Insights</th>
                <!-- <th scope="col">Survey Status</th> -->
            </tr>
        </thead>
        @foreach($cohortsData as $cohort)
        <tr>
            <!-- <td>{{ $loop->iteration }}</td> -->
            <td>{{ $cohort['cohort'] }}</td>
            <td>{{$cohort['totalTrainees']}}</td>
            <td>{{$cohort['totalFemale']}}</td>
            <td>{{$cohort['totalMale']}}</td>
            <td>{{$cohort['totalGraduates']}}</td>

            <td>{{$cohort['employedTrainees']}}</td>
            <td>{{$cohort['totalAvailable']}}</td>
            <td>
                <div class="progress position-relative" style="height: 25px;">
                    <div class="progress-bar bg-success"
                         role="progressbar"
                         style="width: {{ $cohort['employmentRate'] }}%;"
                         aria-valuenow="{{ $cohort['employmentRate'] }}"
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <span class="progress-text">{{ $cohort['employmentRate'] }}%</span>
                </div>
            </td>
            <td>
                @if (($cohort['totalTrainees'] ?? 0) )
                <a class="btn btn-primary btn-sm"
                    href="{{ route('trainees.index', ['academy' => $academy, 'cohort' => $cohort['cohort_slug'] ]) }}">Details</a>
                @else
                <span class="text-muted">No trainees found</span>
                @endif
            </td>

            <td>
                @if (($cohort['totalTrainees'] ?? 0) )
                <a class="btn btn-primary btn-sm"
                    href="{{ route('traineeLog.index', ['academy' => $academy, 'cohort' => $cohort['cohort_slug'] ]) }}">Details</a>
                @else
                <span class="text-muted">No trainees found</span>
                @endif
            </td>



            <!-- <td>
                @if (($cohort['totalTrainees'] ?? 0) )
                <a class="btn btn-primary btn-sm"
                    href="{{ route('surveyResult', ['academyId' => $academy->id] ) }}">Survey Result</a>

                @else
                <span class="text-muted">No trainees found</span>
                @endif
            </td> -->


        </tr>
        @endforeach
    </table>

    {{--    @include('components.table')--}}
</div>

<style>
.chart-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 15px;
}

.chart {
    width: 100%;
}

canvas {
    width: 60% !important;
    height: 22rem !important;
}

.table-container {
    margin-top: 30px;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="//cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    $('#example').DataTable();
});
</script>
<script src="{{ asset('assets/js/line-chart.js') }}"></script>
<script>
const totalEmployed = {
    {
        $overallEmploymentRate
    }
};
const totalUnemployed = {
    {
        $availableTrainees
    }
};

const doughnutData = {
    labels: ["Employed", "Unemployed"],
    datasets: [{
        label: "Employment Status",
        data: [totalEmployed, totalUnemployed],
        backgroundColor: [
            "#492191",
            "#A885D8",
        ],
        hoverOffset: 4,
    }, ],
};

const doughnutCtx = document.getElementById("doughnutChart").getContext("2d");

new Chart(doughnutCtx, {
    type: "doughnut",
    data: doughnutData,
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cohortsData = @json($cohortsData);

    const labels = cohortsData.map(cohort => cohort.cohort);
    const totalTrainees = cohortsData.map(cohort => cohort.totalTrainees);
    const totalFemale = cohortsData.map(cohort => cohort.totalFemale);
    const totalMale = cohortsData.map(cohort => cohort.totalMale);
    const employedGraduates = cohortsData.map(cohort => cohort.employedTrainees);
    const employmentRate = cohortsData.map(cohort => cohort.employmentRate);

    const ctx = document.getElementById('cohortsChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar', // Base type of chart
        data: {
            labels: labels,
            datasets: [{
                    label: 'Total Female',
                    data: totalFemale,
                    backgroundColor: 'rgba(255, 182, 193, 1)',
                    stack: 'Gender'
                },
                {
                    label: 'Total Male',
                    data: totalMale,
                    backgroundColor: 'rgba(173, 216, 230, 1)',
                    stack: 'Gender'
                },
                {
                    label: 'Employed Graduates',
                    data: employedGraduates,
                    backgroundColor: 'rgba(123, 208, 144, 1)',
                    stack: 'Employment'
                },
                {
                    type: 'line', // Line type dataset
                    label: 'Employment Rate (%)',
                    data: employmentRate,
                    borderColor: '#ff4500',
                    backgroundColor: 'rgba(255, 69, 0, 0.2)',
                    fill: false,
                    yAxisID: 'yRate'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true // Stack the bars
                },
                y: {
                    beginAtZero: true,
                    stacked: true, // Stack the bars
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Trainees'
                    }
                },
                yRate: {
                    beginAtZero: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Employment Rate (%)'
                    },
                    grid: {
                        drawOnChartArea: false // Remove gridlines from employment rate axis
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
});
</script>


@endsection
