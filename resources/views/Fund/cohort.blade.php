@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h1>Show Realated fund related to {{$fund_cohort->fund_name}}</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
</div>

<div class="container-fluid">
    <div class="scrollable-table">
        <a href="{{ route('fund.create_cohort_fund',$fund_cohort->id)}}" class="btn btn-sm btn-success">Add New
            Cohort</a>

        <table id="news-table" class="table tablesorter mb-5">
            <thead class="cf">
                <tr>
                    <th scope="col">Cohort ID</th>
                    <th scope="col">Cohort Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataCohorts as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ str_replace('-', ' ', $data->slug) }}</td>
                    <td>{{ $data->start_date }}</td>
                    <td>{{ $data->end_date }}</td>
                    <td>
                        {{-- 
                    <button type="button" class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal" 
                            data-action="{{ route('fund.destroy_fund', [$data->id]) }}">
                        Delete
                    </button>
                        --}}

                    <a href="{{ route('fund.edit_cohort_fund', [$data->id]) }}" class="btn btn-sm btn-primary">
                        Edit
                    </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        var button = event.relatedTarget; // Button clicked
        var action = button.getAttribute('data-action'); // URL from button
        var form = document.getElementById('deleteForm');
        form.setAttribute('action', action);
    });
});
</script>
@endsection