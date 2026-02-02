@extends('layouts.app')
@section('content')
<html>

    <body>
    <div class="container center " >
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img src="https://orange.jo/sites/default/files/styles/640x320/public/feeds/coding-academy_367.jpg">
        </div>
    <br class="row work_space ">
    <div class="col-8 align-items-center justify-content-center">
        <!-- form section -->
        <div class="form_section  ">
            </br>
            <h3 class="form_container">Please to answer the following questions:</h3>

            <hr class="background_hr"/>
            <form id="contact_form" action="{{ route('save.survey.data') }}" method="POST" autocomplete="off">
    @csrf
    <!-- Your form fields here -->

                <fieldset>

                    <!-- Student Full Name -->

                    <div class="mb-3">

                    <label for="studentFullName" class="form-label is-required">
                                    Full Name (First Middle Last)<span class="visually-hidden">(required)</span>
                                </label>
                                <select class="form-control" id="studentFullName" name="studentFullName" required>
                                    <option value="" disabled selected>Select Full Name</option>
                                    @foreach ($trainees as $trainee)
                                        <option value="{{ $trainee->first_name }} {{ $trainee->last_name }}">
                                            {{ $trainee->first_name }} {{ $trainee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                        <p class="validation_text message_phone1" id="">


                        </p>

                    </div>

                    <div class="mb-3">
    <label for="studentEmploymentStatus" class="form-label is-required">What is your employment Status?</label>
    <div class="form-check border"  >
        <!-- Add a hidden input field to hold the selected radio button value -->
        <input type="hidden" name="employment_status" id="employmentStatusInput" value="">
        
        <!-- Radio button options -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="availableEmpStatus" value="Available for opportunities">
            <label class="form-check-label" for="availableEmpStatus">Available for opportunities</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="employedFullTime" value="Employed - Full time Job">
            <label class="form-check-label" for="employedFullTime">Employed - Full time Job</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="employedPartTime" value="Employed - Part time job">
            <label class="form-check-label" for="employedPartTime">Employed - Part time job</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="paidInternTrainee" value="Paid Internship / Trainee">
            <label class="form-check-label" for="paidInternTrainee">Paid Internship / Trainee</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="Freelancer" value="Freelancing Job">
            <label class="form-check-label" for="Freelancer">Freelancing Job</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="SelfEmployee" value="Self Employee">
            <label class="form-check-label" for="SelfEmployee">Self Employee</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="empStatus" id="other" value="Other">
            <label class="form-check-label" for="other">Other</label>
            <!-- Add an input field for other_reason when 'Other' is selected -->
            <input type="text" name="other_reason" id="radioOtherOption" placeholder="Please specify" style="display: none;">
        </div>
    </div>
    <!-- Validation message -->
</div>


                    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all radio buttons with name 'empStatus'
        const radioButtons = document.querySelectorAll('input[name="empStatus"]');
        
        // Add event listener to each radio button
        radioButtons.forEach(function (radio) {
            radio.addEventListener('change', function () {
                // Update the hidden input value with the selected radio button's value
                document.getElementById('employmentStatusInput').value = this.value;
            });
        });
    });
</script>


                    <!--input for Company Name-->

                    <div class="mb-3">

                        <label for="requiredTextInput3" class="form-label is-required">Company Name (Employer)</label>

                        <input type="text" id="companyName" name="companyName" class="form-control" placeholder="Please Enter Your Company Name"  required/>

                     

                    </div>

                    <!-- input for positin   -->

                    <div class="mb-3">

                        <label for="requiredTextInput4" class="form-label is-required">

                            What is your position (Role)<span class="visually-hidden">

                    (required)</span></label>

                        <input type="text" id="position" name="position" class="form-control" placeholder="Please Enter Your Position" required/>

    

                    </div>

                    <!-- input for linkedIn link -->

                    <div class="mb-3">

                        <label for="requiredTextInput5" class="form-label is-required">

                            Pick your work joining date<span class="visually-hidden">

                    (required)</span></label>

                        <input type="date" id="joiningDate" name = "joiningDate" class="form-control" required/>

                    </div>

                    <div class="mb-3 mt-2">

                        <input type="submit" value="Submit" class="btn btn-primary">

                        <button type="reset" id="button_edit_page" class="btn btn-secondary float-end mb-3">

                            Cancel

                        </button>

                    </div>

                </fieldset>

            </form>

        </div>

    </div>

    </div>

    </div>
    </body>
</html>

@endsection
