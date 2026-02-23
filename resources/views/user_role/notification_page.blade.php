@extends('layouts.app')

@section('content')
    <style>
        /* Table & Layout */
        .table tbody tr.unread-row > td { background-color: #fff8e1 !important; }
        .table-hover tbody tr.unread-row:hover > td { background-color: #fff3cd !important; }
        .table tbody tr.unread-row { border-left: 4px solid #ffc107; }
        .btn.mark-read-btn { text-decoration: none; font-size: 1.2rem; cursor: pointer; border: none; background: none; }

        /* Modal UX Redesign */
        .modal-content { border: none; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
        .modal-header-custom { background: #ffffff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-radius: 16px 16px 0 0; }
        
        /* Identity Header */
        .trainee-header-card {
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
            color: white; padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 15px;
        }

        /* Property Sheet */
        .data-sheet-container { border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #ffffff; }
        .data-sheet-row { display: grid; grid-template-columns: 180px 1fr; border-bottom: 1px solid #f1f5f9; transition: background 0.2s; }
        .data-sheet-row:hover { background: #f8fafc; }
        .data-sheet-label { background: #fbfcfe; padding: 0.75rem 1rem; font-size: 0.75rem; font-weight: 700; color: #64748b; border-right: 1px solid #f1f5f9; text-transform: uppercase; }
        .data-sheet-value { padding: 0.75rem 1rem; font-size: 0.85rem; color: #1e293b; font-weight: 500; word-break: break-all; }

        /* Pagination */
        .pagination-wrapper { margin-top: 2rem; display: flex; justify-content: center; }
        .page-link { color: #4f46e5; border-radius: 6px; margin: 0 2px; }
        .page-item.active .page-link { background-color: #4f46e5; border-color: #4f46e5; color: white; }
        
        /* Total Badge */
        #totalRecordsBadge { background: #e0e7ff; color: #4338ca; font-size: 0.75rem; vertical-align: middle; }
    </style>

    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 fw-bold text-dark">
                🔔 Activity Log 
                <span id="totalRecordsBadge" class="badge rounded-pill ms-2">0 records</span>
            </h4>
            <button id="markAllBtn" class="btn btn-sm btn-outline-success px-3">✔ Mark all as seen</button>
        </div>
<!-- upgrade to version 10 -->
        @if($logs->count())
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-auto d-flex align-items-center">
                            <i class="fa fa-filter text-muted me-2"></i>
                            <label class="me-2 fw-semibold small text-muted text-uppercase">Filters:</label>
                        </div>
                        <div class="col-md-auto">
                            <select id="actionFilter" class="form-select form-select-sm border-0 bg-light fw-bold">
                                <option value="all">All Actions</option>
                                <option value="created">Created</option>
                                <option value="updated">Updated</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                        <div class="col-md-auto">
                            <select id="userFilter" class="form-select form-select-sm border-0 bg-light fw-bold">
                                <option value="all">All Users</option>
                                @foreach($logs->unique('user_id') as $uniqueLog)
                                    <option value="{{ $uniqueLog->user ? $uniqueLog->user->name : 'System' }}">
                                        {{ $uniqueLog->user ? $uniqueLog->user->name : 'System' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive shadow-sm rounded-3">
                <table class="table table-hover align-middle mb-0 bg-white" id="activityTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th class="text-center">Details</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $index => $log)
                        @php $userName = $log->user ? $log->user->name : 'System'; @endphp
                        <tr data-id="{{ $log->id }}" 
                            data-action="{{ strtolower($log->action) }}" 
                            data-user="{{ $userName }}"
                            class="activity-row {{ $log->read == 0 ? 'unread-row' : '' }}">
                            <td class="ps-3 text-muted small">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2 bg-light rounded-circle text-center" style="width:30px; height:30px; line-height:30px;">
                                        <i class="fa fa-user text-primary" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <span class="fw-bold">{{ $userName }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 @if($log->action === 'created') bg-success @elseif($log->action === 'updated') bg-warning text-dark @else bg-danger @endif">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="text-muted fw-medium">{{ $log->model }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#logModal{{ $log->id }}">
                                    <i class="fa fa-search-plus text-primary"></i> View
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="mark-read-btn" data-id="{{ $log->id }}">
                                    {!! $log->read == 0 ? '<span title="Mark as Read">❌</span>' : '<span title="Read">✅</span>' !!}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <ul class="pagination" id="paginationList"></ul>
            </div>

            {{-- Modals Loop --}}
            @foreach($logs as $log)
                @php $changes = json_decode($log->changes, true) ?? []; @endphp
                <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header-custom">
                                <h5 class="modal-title">Activity Reference: #{{ $log->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="trainee-header-card">
                                    <i class="fa fa-user-circle fa-3x opacity-50"></i>
                                    <div>
                                        <div class="small opacity-75 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Target Reference</div>
                                        <h4 class="mb-0 fw-bold">
                                            @if($log->model === 'EmploymentLog' || $log->model === 'Trainee')
                                                {{ $changes['trainee_name'] ?? ($log->trainee ? $log->trainee->first_name . ' ' . $log->trainee->last_name : 'N/A') }}
                                            @else System Reference @endif
                                        </h4>
                                    </div>
                                </div>
                                <div class="data-sheet-container shadow-sm">
                                    @forelse($changes as $field => $value)
                                        @if($field === 'trainee_name' || $field === 'created_at') @continue @endif
                                        <div class="data-sheet-row">
                                            <div class="data-sheet-label">{{ str_replace('_',' ',$field) }}</div>
                                            <div class="data-sheet-value">{{ is_array($value) ? json_encode($value) : ($value ?? 'N/A') }}</div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-muted italic">No changes recorded.</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="modal-footer-custom">
                                <button class="btn btn-modal-close shadow-sm" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rowsPerPage = 10;
        let currentPage = 1;
        
        const tableBody = document.querySelector('#activityTable tbody');
        const allRows = Array.from(tableBody.querySelectorAll('.activity-row'));
        const actionFilter = document.getElementById('actionFilter');
        const userFilter = document.getElementById('userFilter');
        const paginationList = document.getElementById('paginationList');
        const totalRecordsBadge = document.getElementById('totalRecordsBadge');

        let filteredRows = allRows;

        function applyFilters() {
            const actionVal = actionFilter.value.toLowerCase();
            const userVal = userFilter.value;

            filteredRows = allRows.filter(row => {
                const matchesAction = (actionVal === 'all' || row.dataset.action === actionVal);
                const matchesUser = (userVal === 'all' || row.dataset.user === userVal);
                return matchesAction && matchesUser;
            });

            currentPage = 1;
            updateTableUI();
        }

        function updateTableUI() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            allRows.forEach(row => row.style.display = 'none');
            filteredRows.slice(start, end).forEach(row => row.style.display = '');

            // Update Total Count Badge
            totalRecordsBadge.textContent = `${filteredRows.length} ${filteredRows.length === 1 ? 'record' : 'records'}`;

            renderPagination();
        }

        function renderPagination() {
            paginationList.innerHTML = '';
            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.onclick = (e) => { e.preventDefault(); currentPage = i; updateTableUI(); };
                paginationList.appendChild(li);
            }
        }

        actionFilter.addEventListener('change', applyFilters);
        userFilter.addEventListener('change', applyFilters);

        // Mark Single
        document.querySelectorAll('.mark-read-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`/activity-log/${id}/mark-read`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.innerHTML = data.read ? '✅' : '❌';
                        this.closest('tr').classList.toggle('unread-row', !data.read);
                    }
                });
            });
        });

        // Mark All
        document.getElementById('markAllBtn')?.addEventListener('click', function () {
            fetch(`/activity-log/mark-all-read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(() => {
                allRows.forEach(r => {
                    r.classList.remove('unread-row');
                    const b = r.querySelector('.mark-read-btn');
                    if(b) b.innerHTML = '✅';
                });
            });
        });

        updateTableUI();
    });
</script>
@endsection