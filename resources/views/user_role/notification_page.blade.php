@extends('layouts.app')

@section('content')
    <style>
        /* =========================================
           KEEPING ORIGINAL TABLE STYLES
           ========================================= */
        .table tbody tr.unread-row > td {
            background-color: #fff8e1 !important;
        }

        .table-hover tbody tr.unread-row:hover > td {
            background-color: #fff3cd !important;
        }

        .table tbody tr.unread-row {
            border-left: 4px solid #ffc107;
        }

        .btn.mark-read-btn {
            text-decoration: none;
            font-size: 1.2rem;
        }

        /* =========================================
           PROFESSIONAL MODAL REDESIGN (FIXED)
           ========================================= */

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Header: Clean & Modern */
        .modal-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header-custom .modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Metadata Grid */
        .log-meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .meta-box {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .meta-box-label {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2px;
        }

        .meta-box-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #334155;
        }

        /* Property Sheet (Changes Section) */
        .data-sheet-container {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
        }

        .data-sheet-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-sheet-row:last-child {
            border-bottom: none;
        }

        .data-sheet-label {
            background: #fbfcfe;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            border-right: 1px solid #f1f5f9;
            text-transform: capitalize;
        }

        .data-sheet-value {
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: #1e293b;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            word-break: break-all;
        }

        /* Footer */
        .modal-footer-custom {
            padding: 1rem 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
        }

        .btn-modal-close {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .btn-modal-close:hover {
            opacity: 0.9;
            color: white;
        }

    </style>

    <div class="container py-4">
        <h4 class="mb-4">🔔 Activity Log</h4>

        @if($logs->count())
            {{-- Filter + Mark All --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <label for="actionFilter" class="me-2 fw-semibold">Filter by Action:</label>
                    <select id="actionFilter" class="form-select w-auto">
                        <option value="all">All</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                    </select>
                </div>

                <button id="markAllBtn" class="btn btn-sm btn-outline-success">✔ Mark all as seen</button>
            </div>

            {{-- Table --}}
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle mb-0" id="activityTable">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Table</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Read</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $index => $log)
                        <tr data-id="{{ $log->id }}" data-action="{{ $log->action }}" class="{{ $log->read == 0 ? 'unread-row' : '' }}">
                            <td>{{ $logs->firstItem() + $index }}</td>
                            <td class="fw-semibold text-primary">{{ $log->user ? $log->user->name : 'System' }}</td>
                            <td>
                                <span class="badge @if($log->action === 'created') bg-success @elseif($log->action === 'updated') bg-warning text-dark @else bg-danger @endif">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td>{{ $log->model }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#logModal{{ $log->id }}">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                            <td class="text-center fs-5">
                                <button class="btn p-0 mark-read-btn" data-id="{{ $log->id }}">
                                    @if($log->read == 0) ❌ @else ✅ @endif
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">{{ $logs->links() }}</div>

            {{-- Redesigned Modals --}}
            @foreach($logs as $log)
                <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header-custom">
                                <h5 class="modal-title">
                                    <i class="fa fa-history text-primary"></i> Activity Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="log-meta-grid">
                                    <div class="meta-box">
                                        <span class="meta-box-label">User</span>
                                        <span class="meta-box-value"> {{ $log->user ? $log->user->name : 'System' }}</span>
                                    </div>
                                    <div class="meta-box">
                                        <span class="meta-box-label">Action</span>
                                        <div>
                                            <span class="badge @if($log->action === 'created') bg-success @elseif($log->action === 'updated') bg-warning text-dark @else bg-danger @endif">
                                                {{ strtoupper($log->action) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="meta-box">
                                        <span class="meta-box-label">Table</span>
                                        <span class="meta-box-value">{{ $log->model }}</span>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark" style="font-size: 0.9rem;">
                                    <i class="fa fa-database me-2 opacity-50"></i>
                                    Changes details
                                </h6>

                                <div class="data-sheet-container">
                                    @php $changes = json_decode($log->changes, true) ?? []; @endphp
                                    @forelse($changes as $field => $value)
                                        @php
                                            if ($field === 'updated_at' || $field === 'created_at') {
                                                $value = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
                                            } elseif (is_array($value)) {
                                                $value = json_encode($value);
                                            }
                                        @endphp
                                        @if($log->model === 'Trainee')
                                            @once
                                                <div class="meta-box mb-3 p-3" style="background-color: #f0f4ff; border-radius: 8px;">
            <span class="meta-box-label d-block mb-1" style="font-size: 0.75rem; font-weight: 700; color: #64748b;">
                Trainee
            </span>
                                                    <span class="meta-box-value fw-bold text-primary" style="font-size: 0.9rem; line-height: 1.5;">
                @if($log->trainee)
                                                            {{ $log->trainee->first_name }} {{ $log->trainee->last_name }}<br>
                                                            <small class="text-muted">User ID: {{ $log->model_id }}</small>
                                                        @else
                                                            {{ $changes['trainee_name'] ?? 'Trainee deleted' }}
                                                        @endif
            </span>
                                                </div>
                                            @endonce
                                        @endif


                                        <div class="data-sheet-row">
                                            <div class="data-sheet-label">{{ str_replace('_',' ',$field) }}</div>
                                            <div class="data-sheet-value">{{ $value }}</div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-muted italic">No changes recorded.</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="modal-footer-custom">
                                <button class="btn btn-modal-close" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        @else
            <div class="alert alert-info">No activity recorded yet.</div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const badge = document.getElementById('navbarUnreadBadge');

            // FILTER
            document.getElementById('actionFilter').addEventListener('change', function () {
                const value = this.value;
                document.querySelectorAll('#activityTable tbody tr').forEach(row => {
                    row.style.display = value === 'all' || row.dataset.action === value ? '' : 'none';
                });
            });

            // SINGLE MARK
            document.querySelectorAll('.mark-read-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const row = this.closest('tr');

                    fetch(`/activity-log/${id}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.textContent = data.read ? '✅' : '❌';
                                row.classList.toggle('unread-row', !data.read);
                                if(badge) {
                                    badge.textContent = data.unreadCount;
                                    badge.style.display = data.unreadCount == 0 ? 'none' : 'inline-block';
                                }
                            }
                        });
                });
            });

            // MARK ALL
            document.getElementById('markAllBtn').addEventListener('click', function () {
                fetch(`/activity-log/mark-all-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelectorAll('.unread-row').forEach(row => {
                                row.classList.remove('unread-row');
                                row.querySelector('.mark-read-btn').textContent = '✅';
                            });
                            if(badge) badge.style.display = 'none';
                        }
                    });
            });
        });
    </script>
@endsection
