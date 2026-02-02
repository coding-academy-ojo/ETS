@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <h1>Survey Tool</h1>
    <div class="container mt-5">
        <form id="surveyForm">
            <div class="form-group mb-3">
                <label for="academyDropdown">Select Academy:</label>
                <!-- Academy Dropdown -->
                <select class="form-control" id="academyDropdown" name="academy" required>
                    <option value="" disabled selected>Select an Academy</option>
                    @foreach ($academies as $academy)
                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                    @endforeach
                </select>

                <!-- Cohort Dropdown -->
                <div class="form-group mt-3">
                    <label for="cohortDropdown">Select Cohort Number:</label>
                    <select class="form-control" id="cohortDropdown" name="cohort" required>
                        <option value="" disabled selected>Select Cohort Number</option>
                    </select>

                    <!-- Embed all cohorts as JSON -->
                    <script>
                    const allCohorts = @json($cohorts);
                    </script>
                </div>
                <button type="button" id="showTraineesBtn" class="btn btn-primary mt-3">Show Trainees List</button>
        </form>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Trainees List</h2>
        <button type="button" id="selectToggleBtn" class="btn btn-secondary mb-3">Select All</button>
        <div class="table-container" style="height: 300px; overflow-y: auto;">
            <table id="traineesTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Select</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Trainees data will be populated here -->
                </tbody>
            </table>
        </div>

        <div class="form-group mb-6 mt-3">
            <label for="surveyDropdown">Select Survey:</label>
            <select class="form-control" id="surveyDropdown" name="survey" required>
                <option value="" selected>Select Survey</option>
                <option value="1">Three Month Survey</option>
                <option value="2">Six Month Survey</option>
                <option value="3">Nine Month Survey</option>
            </select>
        </div>

        <div id="sendButtonContainer" style="display: none;">
            <button type="submit" id="sendNotificationBtn" class="btn btn-primary mt-3">Send Email Notification</button>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
    document.getElementById('showTraineesBtn').addEventListener('click', function(event) {
        event.preventDefault();

        const academyId = document.getElementById('academyDropdown').value;
        const cohortId = document.getElementById('cohortDropdown').value;

        fetch(`/api/trainees?academy_id=${academyId}&cohort_id=${cohortId}`)
            .then(response => response.json())
            .then(data => {
                const traineesTable = document.getElementById('traineesTable');
                const tbody = traineesTable.querySelector('tbody');
                tbody.innerHTML = ''; // Clear existing rows

                data.forEach(trainee => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${trainee.id}</td>
                        <td>${trainee.first_name + ' ' + trainee.last_name}</td>
                        <td>${trainee.email}</td>
                        <td><input type="checkbox" name="traineeCheckbox" class="trainee-checkbox" value="${trainee.id}"></td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching trainees:', error));
    });

    const surveyDropdown = document.getElementById('surveyDropdown');
    const sendButtonContainer = document.getElementById('sendButtonContainer');
    const sendNotificationBtn = document.getElementById('sendNotificationBtn');

    surveyDropdown.addEventListener('change', function() {
        if (surveyDropdown.value !== '') {
            sendButtonContainer.style.display = 'block';
        } else {
            sendButtonContainer.style.display = 'none';
        }
    });

    sendNotificationBtn.addEventListener('click', function() {
        const selectedTrainees = document.querySelectorAll('input[name="traineeCheckbox"]:checked');
        if (selectedTrainees.length === 0) {
            alert('Please select at least one trainee to send email notification.');
            return;
        }

        const traineeIds = Array.from(selectedTrainees).map(checkbox => checkbox.value);
        alert('Sending email notifications to trainees with IDs: ' + traineeIds.join(', '));

        // Wait for the alert to be closed

    });

    document.getElementById('selectToggleBtn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.trainee-checkbox');
        const selectAll = this.textContent === 'Select All';
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll;
        });
        this.textContent = selectAll ? 'Deselect All' : 'Select All';
    });
    </script>
    <script>
    const academyDropdown = document.getElementById('academyDropdown');
    const cohortDropdown = document.getElementById('cohortDropdown');

    academyDropdown.addEventListener('change', function() {
        const selectedAcademyId = this.value;

        // Clear current options
        cohortDropdown.innerHTML = '<option value="" disabled selected>Select Cohort Number</option>';

        // Filter and append matching cohorts
        allCohorts.forEach(cohort => {
            if (cohort.academy_id == selectedAcademyId) {
                const option = document.createElement('option');
                option.value = cohort.id;
                option.textContent = cohort.slug;
                cohortDropdown.appendChild(option);
            }
        });
    });
    </script>

    @endsection