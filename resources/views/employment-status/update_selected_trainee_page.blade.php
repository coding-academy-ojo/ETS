@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Update {{ $trainee_info->first_name }}</h1>

    <form action="{{ route('trainee.updateLog', $trainee_log_info->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Hidden IDs -->
    <input type="hidden" name="trainee_id" value="{{ $trainee_info->id }}">
    <input type="hidden" name="log_id" value="{{ $trainee_log_info->id }}">

    <!-- Employment Status -->
    <div class="form-group">
        <label for="employeeStatus" class="is-required">Employee Status</label>
        <select class="form-control" id="employeeStatus" name="status" required>
            <option value="job offer" {{ $trainee_log_info->status == 'job offer' ? 'selected' : '' }}>Job offer</option>
            <option value="internship_for_Employment" {{ $trainee_log_info->status == 'internship_for_Employment' ? 'selected' : '' }}>Internship for Employment</option>
            <option value="freelance" {{ $trainee_log_info->status == 'freelance' ? 'selected' : '' }}>Freelance</option>
            <option value="available" {{ $trainee_log_info->status == 'available' ? 'selected' : '' }}>Available</option>
            <option value="Dropped" {{ $trainee_log_info->status == 'Dropped' ? 'selected' : '' }}>Dropped</option>
            <option value="Internship" {{ $trainee_log_info->status == 'Internship' ? 'selected' : '' }}>Internship</option>
        </select>
    </div>

    <!-- Company + IT Position -->
    <div id="company_position_fields">
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" id="company-search" class="form-control" placeholder="Type to search companies">

            <select class="form-control" id="company" name="company">
                <option value="" disabled>Select Company</option>
                @foreach($names_companies as $company)
                    <option value="{{ $company->company_name }}"
                        {{ $trainee_log_info->company == $company->company_name ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="position">IT Position</label>
            <input type="text" class="form-control" id="position" name="position"
                   value="{{ $trainee_log_info->position }}">
        </div>
    </div>

    <!-- Start Date -->
    <div class="form-group mt-2">
        <label for="startDate">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date"
               value="{{ $trainee_log_info->start_date }}" required>
    </div>

    <!-- End Date -->
    @php $hasEndDate = !is_null($trainee_log_info->end_date); @endphp
    <div class="form-group">
        <label>
            <input type="checkbox" id="has_end_date" name="has_end_date" {{ $hasEndDate ? 'checked' : '' }}>
            Has End Date
        </label>
    </div>

    <div class="form-group" id="end_date_container" style="{{ $hasEndDate ? '' : 'display:none;' }}">
        <label for="endDate">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date"
               value="{{ $trainee_log_info->end_date }}">
    </div>

    <!-- Created By -->


    <!-- Submit -->
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>


</div>

{{-- JS Section --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusSelect = document.getElementById("employeeStatus");
        const companyFields = document.getElementById("company_position_fields");
        const searchInput = document.getElementById("company-search");
        const companySelect = document.getElementById("company");

        // --- Load companies from Blade into JS array ---
        // $names_companies is expected to be a collection/array of objects with company_name
        const companies = @json($names_companies->pluck('company_name'));

        // Helper: (re)build the select options from an array of names
        function buildCompanyOptions(list, selectedValue = "") {
            // Clear current options
            companySelect.innerHTML = "";

            // Placeholder disabled option
            const placeholder = document.createElement("option");
            placeholder.value = "";
            placeholder.disabled = true;
            placeholder.textContent = "Select Company";
            companySelect.appendChild(placeholder);

            if (!list.length) {
                const noRes = document.createElement("option");
                noRes.value = "";
                noRes.disabled = true;
                noRes.textContent = "No results";
                companySelect.appendChild(noRes);
                return;
            }

            list.forEach(name => {
                const opt = document.createElement("option");
                opt.value = name;
                opt.textContent = name;
                if (selectedValue && selectedValue === name) {
                    opt.selected = true;
                }
                companySelect.appendChild(opt);
            });
        }

        // --- Toggle company fields based on employment status ---
        function toggleCompanyFields() {
            const selected = statusSelect.value.toLowerCase();
            if (selected === "available" || selected === "dropped") {
                companyFields.style.display = "none";
            } else {
                companyFields.style.display = "block";
            }
        }

        // Initial build using full companies list and preserve existing selected value from blade
        const currentSelected = @json($trainee_log_info->company ?? '');
        buildCompanyOptions(companies, currentSelected);

        toggleCompanyFields();
        statusSelect.addEventListener("change", toggleCompanyFields);

        // --- Filter companies on input and rebuild select ---
        searchInput.addEventListener("input", function() {
            const q = searchInput.value.toLowerCase().trim();

            if (q === "") {
                // empty query -> show all
                buildCompanyOptions(companies, currentSelected);
                return;
            }

            const filtered = companies.filter(name => name.toLowerCase().includes(q));
            buildCompanyOptions(filtered, filtered.includes(currentSelected) ? currentSelected : "");
            // Keep focus in input so typing continues naturally
            searchInput.focus();
        });

        // Optional: on Enter, if there's at least one non-placeholder option, select the first real result
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                // find first selectable option (skip placeholder)
                const firstOption = Array.from(companySelect.options).find(o => !o.disabled && o.value !== "");
                if (firstOption) {
                    companySelect.value = firstOption.value;
                }
            }
        });
    });
</script>


@endsection
