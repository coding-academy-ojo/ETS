@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Create Fund</h1>

    <form action="{{ route('fund.store_new_Fund')}}" method="POST">
        @csrf

        <div class="form-group">
            <label for="employeeStatus" class="is-required">Fund Name</label>
           <input type="text" class="form-control" id="fund_name" name="fund_name" required>
        </div>


        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        @error('start_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label>
                <input type="checkbox" id="has_end_date" name="has_end_date">
                Has End Date
            </label>
        </div>

        <div class="form-group" id="end_date_container" style="display: none;">
            <label for="endDate">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>

<script>
const companySearch = document.getElementById('company-search');
const companySelect = document.getElementById('company');
const typingIndicator = document.getElementById('typing-indicator');

// Show typing indicator and filter options as the user types
companySearch.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    const options = companySelect.getElementsByTagName('option');

    // Update typing indicator
    typingIndicator.textContent = query.length ? `Showing results for: "${query}"` :
        'Start typing to filter companies...';

    // Filter dropdown options
    for (let i = 0; i < options.length; i++) {
        const option = options[i];
        const text = option.textContent.toLowerCase();
        option.style.display = text.includes(query) ? '' : 'none';
    }

    // Show the dropdown (expand size) if there are results
    companySelect.size = Math.min(options.length, 5);
});

// Allow selecting an option by clicking on it
companySelect.addEventListener('click', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        companySearch.value = selectedOption.textContent; // Set the input value to the selected option text
        companySelect.size = 1; // Collapse the dropdown
    }
});

// Auto-focus the search input when the select is focused
companySelect.addEventListener('focus', function() {
    companySearch.focus();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hasEndDateCheckbox = document.getElementById('has_end_date');
    const endDateContainer = document.getElementById('end_date_container');
    const endDateInput = document.getElementById('end_date');

    hasEndDateCheckbox.addEventListener('change', function() {
        if (hasEndDateCheckbox.checked) {
            endDateContainer.style.display = 'block';
            endDateInput.required = true; // Make it required when shown
        } else {
            endDateContainer.style.display = 'none';
            endDateInput.required = false; // Remove required when hidden
            endDateInput.value = ''; // Clear the value
        }
    });

    // Optional: Set a default end date if the checkbox is unchecked
    // You can modify this part according to your needs
    const form = hasEndDateCheckbox.closest('form');
    form.addEventListener('submit', function() {
        if (!hasEndDateCheckbox.checked) {
            endDateInput.value = ''; // Clear the value
        }
        if (hasEndDateCheckbox.checked && endDateInput.value < document.getElementById('start_date')
            .value) {
            alert('End date must be greater than start date');
            event.preventDefault();
        }
    });
});

</script>
@endsection

