@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h1>{{ $trainee->first_name }} Status History</h1>

    {{-- Show conflict message --}}
    @if(!empty($conflict))
    <div class="alert alert-warning">
        ⚠️ Conflict detected: You already entered a later date for this trainee.
    </div>
    @endif
</div>

<div class="container-fluid">
    <div class="scrollable-table">

        {{-- Case 1: If any status = Dropped → show ONLY Dropped logs --}}
        @if($logs->contains('status', 'Dropped'))
        <table id="dropped-table" class="table tablesorter mb-5">
            <thead class="cf">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Employee Status</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs->where('status', 'Dropped') as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->start_date }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-action="{{ route('employment-status.logs.destroy', [$trainee->id, $log->id]) }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Case 2: Otherwise → show full logs with Create/Export --}}
        @else
        <a href="{{ route('employment-status.logs.create', $trainee->id) }}" class="btn btn-sm btn-success">Create
            Log</a>
        <a href="{{ route('employment-status.logs.export', $trainee->id) }}" class="btn btn-sm btn-primary">Export
            Logs</a>

        <table id="logs-table" class="table tablesorter mb-5">
            <thead class="cf">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Employee Status</th>
                    <th scope="col">Company</th>
                    <th scope="col">Position</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->company }}</td>
                    <td>{{ $log->position }}</td>
                    <td>{{ $log->end_date }}</td>
                    <td>{{ $log->created_by }}</td>
                    <td>{{ $log->start_date }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-action="{{ route('employment-status.logs.destroy', [$trainee->id, $log->id]) }}">
                            Delete
                        </button>

                        <a href="{{ route('employment-status.logs.editForm', [$trainee->id, $log->id]) }}"
                            class="btn btn-sm btn-success">
                            Edit
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this log?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var action = button.getAttribute('data-action');
        var form = document.getElementById('deleteForm');
        form.setAttribute('action', action);
    });
});
</script>
@endsection
