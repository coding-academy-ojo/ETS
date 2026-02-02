@extends('layouts.app')

@section('content')

    <style>
        .container-fluid-custom {
            padding: 5px;
            border-radius: 10px;
        }

        .table-custom {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-custom th,
        .table-custom td {
            vertical-align: middle;
        }

        .table-custom th {
            color: #000;
            border-bottom: 2px solid #0056b3;
            cursor: pointer;
        }

        .table-custom thead th {
            position: sticky;
            top: 0;
            background-color: #cce5ff; /* match .table-primary */
            z-index: 2;
        }

        .table-custom tbody tr:hover {
            background-color: #f1f1f1;
        }

        .chart-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-box {
            flex: 1 1 48%;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px;
        }

        canvas {
            width: 100% !important;
            height: 300px !important;
        }
        #pagination button {
            min-width: 35px;
        }

        .fa-solid{
            color:black;
        }
        @media (max-width: 768px) {
            .chart-box {
                flex: 1 1 100%;
            }
        }
        /* small spacing for arrow icon */
        th .employed-icon { margin-left: 6px; }
    </style>

    <div class="row">
        <!-- (cards code unchanged) -->
        <!-- ... keep your existing cards here ... -->
    </div>

    <div class="col-6">
        <h3>Overview logs for Students on
            @foreach($academis as $academy)
                {{ $academy->location }}
            @endforeach
            @foreach($cohort_nams as $cohort_nam)
                Cohort {{ explode('-', $cohort_nam->slug)[1] ?? '' }}
            @endforeach
        </h3>
    </div>

    <div class="container-fluid d-flex justify-content-end mb-3 ps-0">
        <button id="male_fem_stat" class="btn btn-primary">
            <i class="fa fa-chart-bar me-1"></i> Show Gender Statistics
        </button>
    </div>

    <div class="w-100">
        <canvas id="mainChart" class="w-100" style="max-height: 300px;"></canvas>
    </div>

    <div class="mt-lg-4 mb-4">
        <h2 class="mb-3">Company and Monthly Statistics</h2>

        <!-- Filter Dropdown -->
        <div class="mb-2">
            <label for="company_filter" class="me-2">Filter by Students Employed:</label>
            <select id="company_filter" class="form-select d-inline-block w-auto">
                <option value="">All</option>
                @php
                    $uniqueNumbers = array_unique($companyData);
                    rsort($uniqueNumbers);
                @endphp
                @foreach($uniqueNumbers as $number)
                    <option value="{{ $number }}">{{ $number }}</option>
                @endforeach
            </select>
        </div>

        <div class="chart-row">
            <!-- Company Table -->
            <div class="chart-box" style="flex:1 1 48%; max-height:350px; padding:0; display:flex; flex-direction:column;">
                <div style="overflow-y:auto; flex:1; width:100%;">
                    <table id="company-table" class="table table-striped table-bordered table-sm text-center align-middle table-custom mb-0" style="width:100%;">
                        <thead class="table-primary">
                        <tr>
                            <!-- Company header: sortable but no icon -->
                            <th data-sort="company" class="sortable">Company</th>

                            <!-- Students Employed header: only arrow icons (initially descending) -->
                            <th data-sort="employed" class="sortable">
                                Students Employed
                                <i class="fa-solid fa-arrow-down employed-icon" id="employedSortIcon"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($companyLabels as $index => $company)
                            <tr>
                                <td>{{ $company }}</td>
                                <td>{{ $companyData[$index] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Monthly Chart -->
            <div class="chart-box">
                <canvas id="newChart2"></canvas>
            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-6">
            <h3>Cohort Logs View</h3>
        </div>
        <div class="col-6 text-end">
            <label for="log_filter" class="me-2">Filter by Status:</label>
            <select id="log_filter" class="form-select d-inline-block w-auto">
                <option value="">All</option>
                <option value="job offer">Job Offer</option>
                <option value="internship for employment">Internship for Employment</option>
                <option value="freelance">Freelance</option>
                <option value="available">Available</option>
                <option value="Dropped">Dropped</option>
            </select>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="news-table" class="table table-sm table-striped table-bordered align-middle table-custom">
                        <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Student Status</th>
                            <th>Company</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($trainees as $trainee)
                            <tr>
                                <td>{{ $trainee->id }}</td>
                                <td>{{ $trainee->first_name }} {{ $trainee->last_name }}</td>
                                @if ($trainee->employment_logs->isNotEmpty())
                                    <td class="status">
                                        {{ $trainee->employment_logs->first()->status === 'internship_for_Employment'
                                            ? 'Internship for Employment'
                                            : $trainee->employment_logs->first()->status }}
                                    </td>
                                    <td>{{ $trainee->employment_logs->first()->company }}</td>
                                    <td>{{ $trainee->employment_logs->first()->start_date }}</td>
                                    <td>{{ $trainee->employment_logs->first()->end_date ?? 'Present' }}</td>
                                @else
                                    <td class="status"><span class="text-muted">No status assigned</span></td>
                                    <td><span class="text-muted">No company recorded</span></td>
                                    <td><span class="text-muted">No start date</span></td>
                                    <td><span class="text-muted">No end date</span></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JS (sorting, filtering, pagination, charts) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // === Pagination for Cohort Logs Table ===
            const rowsPerPage = 10;
            const table = document.querySelector("#news-table tbody");
            let allRows = Array.from(table.querySelectorAll("tr"));
            let filteredRows = [...allRows];
            let currentPage = 1;

            function renderTable() {
                allRows.forEach(r => r.style.display = "none");

                const start = (currentPage - 1) * rowsPerPage;
                const end = currentPage * rowsPerPage;

                filteredRows.slice(start, end).forEach(r => (r.style.display = ""));
                renderPagination();
            }

            function renderPagination() {
                const existing = document.getElementById("pagination");
                if (existing) existing.remove();

                const pagination = document.createElement("div");
                pagination.id = "pagination";
                pagination.className = "mt-3 d-flex gap-1 flex-wrap";
                document.querySelector("#news-table").parentNode.appendChild(pagination);

                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                if (totalPages <= 1) return;

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement("button");
                    btn.className = `btn btn-sm ${i === currentPage ? "btn-primary" : "btn-outline-primary"}`;
                    btn.innerText = i;
                    btn.addEventListener("click", () => {
                        currentPage = i;
                        renderTable();
                    });
                    pagination.appendChild(btn);
                }
            }

            function applyFilter() {
                const filter = document.getElementById("log_filter").value.toLowerCase();

                filteredRows = allRows.filter(row => {
                    const statusEl = row.querySelector(".status");
                    const status = statusEl ? statusEl.innerText.trim().toLowerCase() : '';

                    if (!filter) return true;

                    if (filter === "available") {
                        return status.includes("available") || status.includes("no status");
                    }

                    return status === filter;
                });

                currentPage = 1;
                renderTable();
            }

            document.getElementById("log_filter").addEventListener("change", applyFilter);

            // initialize cohort logs table
            renderTable();

            // === Company Table Sorting & Filter (Students Employed column uses only arrows) ===
            const companyTableBody = document.querySelector("#company-table tbody");
            const companyRows = Array.from(companyTableBody.querySelectorAll("tr"));
            const companyFilter = document.getElementById("company_filter");

            // Current sort directions
            let employedDirection = 'desc'; // initial: descending (largest first)
            let companyDirection = 'asc';

            // Utility to get cell text
            const cellText = (row, idx) => row.children[idx].innerText.trim();

            // Sort function for employed (numeric)
            function sortByEmployed(direction) {
                companyRows.sort((a, b) => {
                    const aVal = parseInt(cellText(a, 1)) || 0;
                    const bVal = parseInt(cellText(b, 1)) || 0;
                    return direction === 'asc' ? aVal - bVal : bVal - aVal;
                });
                // append sorted rows
                companyRows.forEach(r => companyTableBody.appendChild(r));
            }

            // Sort function for company (alphabetical)
            function sortByCompany(direction) {
                companyRows.sort((a, b) => {
                    const aVal = cellText(a, 0).toLowerCase();
                    const bVal = cellText(b, 0).toLowerCase();
                    if (aVal === bVal) return 0;
                    return direction === 'asc' ? (aVal > bVal ? 1 : -1) : (aVal < bVal ? 1 : -1);
                });
                companyRows.forEach(r => companyTableBody.appendChild(r));
            }

            // Header elements
            const companyHeader = document.querySelector('#company-table th[data-sort="company"]');
            const employedHeader = document.querySelector('#company-table th[data-sort="employed"]');
            const employedIcon = document.getElementById('employedSortIcon');

            // Click company header -> alphabetical sort (no icons shown)
            companyHeader.addEventListener('click', function () {
                companyDirection = companyDirection === 'asc' ? 'desc' : 'asc';
                sortByCompany(companyDirection);
                // Keep employed icon state unchanged
            });

            // Click employed header -> numeric sort and toggle arrow icon
            employedHeader.addEventListener('click', function () {
                // toggle direction
                employedDirection = employedDirection === 'asc' ? 'desc' : 'asc';

                // perform sort
                sortByEmployed(employedDirection);

                // update icon: up for asc, down for desc
                if (employedDirection === 'asc') {
                    employedIcon.className = 'fa-solid fa-arrow-up employed-icon';
                } else {
                    employedIcon.className = 'fa-solid fa-arrow-down employed-icon';
                }
            });

            // Company filter dropdown
            companyFilter.addEventListener("change", function () {
                const selectedValue = this.value;
                companyRows.forEach(row => {
                    const employedValue = row.children[1].innerText.trim();
                    if (!selectedValue || employedValue === selectedValue) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });

            // Initial sort: Students Employed descending (largest first)
            sortByEmployed('desc');
            employedIcon.className = 'fa-solid fa-arrow-down employed-icon';

            // === Charts code (unchanged, just moved inside DOMContentLoaded) ===
            const totalGraduates = @json($totalGraduates);
            const employedGraduates = @json($employedGraduates);
            const available = @json($available);
            const employmentRate = @json($employmentRate);
            const genderStats = @json($genderStats);

            const overallStats = [totalGraduates, employedGraduates, available, employmentRate];

            const genderSplit = {
                male: [genderStats.male.totalGraduates, genderStats.male.employedGraduates, genderStats.male.available, genderStats.male.employmentRate],
                female: [genderStats.female.totalGraduates, genderStats.female.employedGraduates, genderStats.female.available, genderStats.female.employmentRate]
            };

            const categories = ["Total Graduates", "Employed Graduates", "Available", "Employment Rate (%)"];
            const chartColors = ['rgba(255, 99, 132, 0.6)','rgba(54, 162, 235, 0.6)','rgba(255, 206, 86, 0.6)','rgba(153, 102, 255, 0.6)'];
            const chartBorderColors = chartColors.map(c => c.replace("0.6","1"));

            const ctx = document.getElementById("mainChart").getContext("2d");
            let showingGender = false;

            const mainChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: categories,
                    datasets: [{
                        label: "",
                        data: overallStats,
                        backgroundColor: chartColors,
                        borderColor: chartBorderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return categories[context.dataIndex] + ": " + context.dataset.data[context.dataIndex];
                                }
                            }
                        }
                    },
                    scales: { y: { beginAtZero: true } }
                }
            });

            const legendContainer = document.createElement("div");
            legendContainer.classList.add("d-flex", "justify-content-center", "mt-2", "flex-wrap");
            document.getElementById("mainChart").parentNode.insertBefore(legendContainer, document.getElementById("mainChart"));

            function updateLegend(isGender) {
                legendContainer.innerHTML = "";
                if (!isGender) {
                    categories.forEach((cat, i) => {
                        const item = document.createElement("div");
                        item.classList.add("d-flex", "align-items-center", "me-3", "mb-1");
                        item.innerHTML = `<span style="display:inline-block;width:15px;height:15px;background:${chartColors[i]};margin-right:5px;border-radius:3px;border:1px solid #000;"></span><small>${cat}</small>`;
                        legendContainer.appendChild(item);
                    });
                } else {
                    const genderLabels = ["Male", "Female"];
                    const colors = ['rgba(75, 192, 192, 0.6)', 'rgba(255, 159, 64, 0.6)'];
                    genderLabels.forEach((label, i) => {
                        const item = document.createElement("div");
                        item.classList.add("d-flex", "align-items-center", "me-3", "mb-1");
                        item.innerHTML = `<span style="display:inline-block;width:15px;height:15px;background:${colors[i]};margin-right:5px;border-radius:3px;border:1px solid #000;"></span><small>${label}</small>`;
                        legendContainer.appendChild(item);
                    });
                }
            }
            updateLegend(showingGender);

            document.getElementById("male_fem_stat").addEventListener("click", () => {
                showingGender = !showingGender;
                if (showingGender) {
                    mainChart.data = {
                        labels: categories,
                        datasets: [
                            { label: "Male", data: genderSplit.male, backgroundColor: 'rgba(75, 192, 192, 0.6)', borderColor: 'rgba(75, 192, 192, 1)', borderWidth: 1 },
                            { label: "Female", data: genderSplit.female, backgroundColor: 'rgba(255, 159, 64, 0.6)', borderColor: 'rgba(255, 159, 64, 1)', borderWidth: 1 }
                        ]
                    };
                    document.getElementById("male_fem_stat").innerHTML = 'Overall Satistic ';
                } else {
                    mainChart.data = {
                        labels: categories,
                        datasets: [{ label: "", data: overallStats, backgroundColor: chartColors, borderColor: chartBorderColors, borderWidth: 1 }]
                    };
                    document.getElementById("male_fem_stat").innerHTML = '<i class="fa fa-chart-bar me-1"></i> Show Gender Statistics';
                }
                updateLegend(showingGender);
                mainChart.update();
            });

            // New chart 2
            const employmentMonths = @json($employmentMonths);
            const employmentCounts = @json($employmentCounts);

            const newCtx2 = document.getElementById("newChart2").getContext("2d");
            const newChart2 = new Chart(newCtx2, {
                type: 'line',
                data: {
                    labels: employmentMonths,
                    datasets: [{
                        label: 'Employment (6 Months After Academy End)',
                        data: employmentCounts,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: true } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        }
                    }
                }
            });

        }); // end DOMContentLoaded
    </script>

    <!-- Chart.js CDN (ensure available in layout) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
