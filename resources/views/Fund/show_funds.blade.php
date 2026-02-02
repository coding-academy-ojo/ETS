@extends('layouts.app')
@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="scrollable-table">
        <a href="{{ route('fund.createFund') }}" class="btn btn-sm btn-success mb-1">Create Fund</a>

        <table id="news-table" class="table tablesorter mb-2">
            <thead class="cf">
                <tr>
                    <th scope="col">Fund Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($funds as $fund)
                <tr>
                    <td>{{ $fund->fund_name }}</td>
                    <td>{{ $fund->start_date }}</td>
                    <td>{{ $fund->end_date ?? 'Present' }}</td> <!-- display 'Present' if null -->
                    <td>
                        <a href="{{ route('fund.fund_update_info', [$fund->id]) }}" class="btn btn-sm btn-success">Edit</a>
                        <a href="{{ route('fund.show_cohort_related_fund', [$fund->id]) }}" class="btn btn-sm btn-primary">Show</a>
                       
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    if(deleteModal){
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button clicked
            var action = button.getAttribute('data-action'); // URL from button
            var form = document.getElementById('deleteForm');
            form.setAttribute('action', action);
        });
    }
});
</script>

@endsection
