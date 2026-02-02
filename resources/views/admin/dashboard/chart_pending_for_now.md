<!-- HTML/CSS section -->
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

<div class="chart">
        <h2>Satisfaction Rate </h2>
        <canvas id="lineChart" width="400" height="200"></canvas>
    </div>
    <div class="chart">
        <h2>Employment Rate </h2>
        <canvas id="doughnutChart" width="500" height="200"></canvas>
    </div>



<!-- SCRIPT SECTION -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pass the PHP variable to JavaScript
    const cohorts = @json($cohorts);

    // Prepare data for the chart
    const labels = cohorts.map(cohort => cohort.name);
    const data = cohorts.map(cohort => parseFloat(cohort.cohort_Rate));

    const lineData = {
        labels: labels,
        datasets: [{
            label: "Satisfaction Rate Across Cohorts",
            backgroundColor: "rgba(75, 192, 192, 0.2)", // Lighter cyan background
            borderColor: "rgba(75, 192, 192, 1)", // Darker cyan border
            pointBackgroundColor: "rgba(255, 99, 132, 1)", // Red points
            pointBorderColor: "#fff", // White border around points
            pointHoverBackgroundColor: "#fff", // White background on hover
            pointHoverBorderColor: "rgba(255, 99, 132, 1)", // Red border on hover
            data: data,
            fill: true, // Fill area under the line
            tension: 0.4, // Smooth curve
            borderWidth: 2, // Thicker line
            pointRadius: 5, // Larger data points
            pointHoverRadius: 7, // Larger points on hover
        }, ],
    };

    const lineCtx = document.getElementById("lineChart").getContext("2d");

    new Chart(lineCtx, {
        type: "line",
        data: lineData,
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allows for flexible resizing
            plugins: {
                title: {
                    display: true,
                    text: "Cohort Satisfaction Rates",
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(173, 216, 230, 1)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 10,
                    caretPadding: 10
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Cohorts',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: true,
                        color: "rgba(173, 216, 230, 1)",
                        drawBorder: false
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Satisfaction Rate (%)',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        stepSize: 10 // Adjust this depending on your data range
                    },
                    grid: {
                        color: "rgba(200, 200, 200, 0.2)",
                        drawBorder: false
                    }
                }
            }
        }
    });
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