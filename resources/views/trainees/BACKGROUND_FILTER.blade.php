@extends('layouts.app')

@section('content')
<style>
    /* --- BRANDED UX VARIABLES --- */
    :root {
        --orange-brand: #FF7900;
        --charcoal: #2D2D2D;
        --bg-body: #F9FAFB;
        --border-soft: #E5E7EB;
        --orange-subtle: #FFF5ED;

        /* Status Colors */
        --success-bg: #ECFDF5;
        --success-text: #059669;
        --danger-bg: #FEF2F2;
        --danger-text: #DC2626;
    }

    .container-fluid-custom {
        padding: 2rem;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .page-header {
        margin-bottom: 2rem;
        border-left: 4px solid var(--orange-brand);
        padding-left: 1.5rem;
    }

    .search-card {
        background: #ffffff;
        padding: 1.25rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid var(--border-soft);
        margin-bottom: 1.5rem;
    }

    .search-input {
        height: 48px;
        border-radius: 8px;
        border: 1px solid var(--border-soft);
        padding: 0 0.75rem;
        font-size: 0.85rem;
        background-color: #fff;
    }

    .search-input:focus {
        border-color: var(--orange-brand);
        box-shadow: 0 0 0 4px rgba(255, 121, 0, 0.1);
        outline: none;
    }

    select.search-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%234B5563'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1.1em;
    }

    .table-container {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid var(--border-soft);
        overflow: hidden;
    }

    .table-custom thead th {
        background: #FBFBFC;
        font-size: .75rem;
        text-transform: uppercase;
        padding: 1rem 1.5rem;
    }

    .table-custom tbody td {
        padding: 1rem 1.5rem;
        font-size: .9rem;
    }

    /* Hover effect for name links */
    .trainee-link {
        color: var(--charcoal);
        text-decoration: none;
        transition: all 0.2s ease;
        border-bottom: 1px solid transparent;
    }

    .trainee-link:hover {
        color: var(--orange-brand);
        border-bottom: 1px solid var(--orange-brand);
    }

    .academy-badge {
        background: var(--charcoal);
        color: #fff;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: .7rem;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: .75rem;
        font-weight: 600;
    }

    .status-employed { background: var(--success-bg); color: var(--success-text); }
    .status-unemployed { background: var(--danger-bg); color: var(--danger-text); }
    .status-default { background: var(--orange-subtle); color: var(--orange-brand); }

    .page-btn {
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid var(--border-soft);
        cursor: pointer;
        background: #fff;
    }

    .page-btn.active { background: var(--orange-brand); color: #fff; border-color: var(--orange-brand); }
</style>

<div class="container-fluid container-fluid-custom">
    <header class="page-header">
        <h2 class="fw-bold m-0">Trainee Records</h2>
        <p class="text-muted small">Orange Digital Center • Employee Dashboard</p>
    </header>

    {{-- SEARCH + FILTERS (Cohort Filter Removed) --}}
    <div class="search-card">
        <div class="row g-2">
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-1 d-block">Keyword</label>
                <input type="text" id="search_input" class="form-control search-input" placeholder="Search name...">
            </div>

            <div class="col-md-2">
                <label class="small fw-bold text-muted mb-1 d-block">Status</label>
                <select id="status_filter" class="form-control search-input">
                    <option value="">All Statuses</option>
                    <option value="employed">Employed</option>
                    <option value="unemployed">Unemployed</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="small fw-bold text-muted mb-1 d-block">Academy</label>
                <select id="academy_filter" class="form-control search-input">
                    <option value="">All Academies</option>
                    @foreach($trainees->pluck('academy.name')->unique()->filter() as $academy)
                    <option value="{{ $academy }}">{{ $academy }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="small fw-bold text-muted mb-1 d-block">Background</label>
                <select id="background_filter" class="form-control search-input">
                    <option value="">All Backgrounds</option>
                    <option value="it_background">IT</option>
                    <option value="non_it_background">Non-IT</option>
                </select>
            </div>

            <div class="col-md-3 text-md-end align-self-end">
                <span class="text-muted small fw-medium d-block mb-2" id="page_info"></span>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Academy</th>
                    <th>Background</th>
                    <th>Cohort</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody id="table_body"></tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        <div class="d-flex gap-2" id="pagination"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const allData = @json($trainees);
    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredData = [...allData];

    function applyFilters() {
        const q = document.getElementById('search_input').value.toLowerCase();
        const status = document.getElementById('status_filter').value.toLowerCase();
        const academy = document.getElementById('academy_filter').value;
        const bg = document.getElementById('background_filter').value.toLowerCase();

        filteredData = allData.filter(t => {
            const fullName = `${t.first_name} ${t.last_name}`.toLowerCase();
            const matchesSearch = fullName.includes(q);
            const matchesStatus = !status || (t.employment_status ?? '').toLowerCase() === status;
            const matchesAcademy = !academy || (t.academy?.name ?? '') === academy;
            const matchesBg = !bg || (t.educational_background ?? '').toLowerCase() === bg;

            return matchesSearch && matchesStatus && matchesAcademy && matchesBg;
        });

        currentPage = 1;
        renderTable();
        renderPagination();
    }

    function renderTable() {
        const start = (currentPage - 1) * rowsPerPage;
        const pageData = filteredData.slice(start, start + rowsPerPage);
        const tbody = document.getElementById('table_body');
        tbody.innerHTML = '';

        if (!pageData.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-5">No records found</td></tr>`;
            document.getElementById('page_info').innerText = "Showing 0 records";
            return;
        }

        pageData.forEach(t => {
            const status = t.employment_status ?? 'Active';
            const statusClass = status.toLowerCase() === 'employed' ? 'status-employed' : (status.toLowerCase() === 'unemployed' ? 'status-unemployed' : 'status-default');
            const bgText = (t.educational_background ?? 'N/A').replace(/_/g, ' ').toUpperCase();

            // Construct Profile URL based on the route: /trainees/{id}/profile
            const profileUrl = `/trainees/${t.id}/profile`;

            tbody.innerHTML += `
                <tr>
                    <td class="fw-semibold">
                        <a href="${profileUrl}" target="_blank" class="trainee-link">
                            ${t.first_name} ${t.last_name}
                        </a>
                    </td>
                    <td><span class="academy-badge">${t.academy?.name ?? 'ODC'}</span></td>
                    <td class="text-muted small">${bgText}</td>
                    <td class="text-muted">${t.cohort?.name ?? '-'}</td>
                    <td><span class="status-badge ${statusClass}">${status}</span></td>
                </tr>`;
        });

        document.getElementById('page_info').innerText = `Showing ${start + 1} – ${Math.min(start + rowsPerPage, filteredData.length)} of ${filteredData.length}`;
    }

    function renderPagination() {
        const totalPages = Math.ceil(filteredData.length / rowsPerPage);
        const container = document.getElementById('pagination');
        container.innerHTML = '';
        if (totalPages <= 1) return;

        container.innerHTML += `<div class="page-btn" onclick="goToPage(${currentPage - 1})">❮</div>`;
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || Math.abs(i - currentPage) <= 1) {
                container.innerHTML += `<div class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</div>`;
            } else if (Math.abs(i - currentPage) === 2) {
                container.innerHTML += `<div class="px-1 text-muted">...</div>`;
            }
        }
        container.innerHTML += `<div class="page-btn" onclick="goToPage(${currentPage + 1})">❯</div>`;
    }

    function goToPage(page) {
        const total = Math.ceil(filteredData.length / rowsPerPage);
        if (page < 1 || page > total) return;
        currentPage = page;
        renderTable();
        renderPagination();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Event Listeners
    document.getElementById('search_input').addEventListener('input', applyFilters);
    document.getElementById('status_filter').addEventListener('change', applyFilters);
    document.getElementById('academy_filter').addEventListener('change', applyFilters);
    document.getElementById('background_filter').addEventListener('change', applyFilters);

    // Initial Render
    renderTable();
    renderPagination();
</script>
@endsection
