@extends('employer_layout.employer_app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="" style="background-color: #eeeeee; padding: 20px;">
        <div class="content-container container-lg my-5">
            <div class="row">
                <div class="col-md-11 col-12 left-column offset-md-1">
                    <section id="block-theme-bo osted-page-title" class="block clearfix">
                        <h1>Employer Dashboard</h1>
                    </section>
                    <section id="block-theme-boosted-content" class="block clearfix">
                        <article data-history-node-id="1162" class="node node_full page is-promoted full clearfix">
                            <div class="field--item">
                                <div class="full-width-background pb-4" style="background-color:#eeeeee">
                                    <h2 class="pt-4 text-primary"><span style="font-size:3.75rem;">Our Trainees</span></h2>

                                    <!-- Filters with Dropdowns -->
                                    <form id="filterForm">
                                        <div class="key_source">
                                            <div class="row pt-4">
                                                <!-- Education Filter -->
                                                <div class="col-md-4 col-sm-12">
                                                    <h6><i class="fas fa-graduation-cap me-2"></i> Education</h6>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="educationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select Education
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="educationDropdown">
                                                            <li><input class="form-check-input" type="checkbox" name="education[]" value="computerScience"> Computer Science</li>
                                                            <li><input class="form-check-input" type="checkbox" name="education[]" value="softwareEngineering"> Software Engineering</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- IT Background Filter -->
                                                <div class="col-md-3 col-sm-12">
                                                    <h6><i class="fas fa-laptop-code me-2"></i> IT Background</h6>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="backgroundDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select IT Background
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="backgroundDropdown">
                                                            <li><input class="form-check-input" type="checkbox" name="background[]" value="itBackground"> IT Background</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Nationality Filter -->
                                                <div class="col-md-3 col-sm-12">
                                                    <h6><i class="fas fa-globe me-2"></i> Nationality</h6>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="nationalityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select Nationality
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="nationalityDropdown">
                                                            <li><input class="form-check-input" type="checkbox" name="nationality[]" value="jordanian"> Jordanian</li>
                                                            <li><input class="form-check-input" type="checkbox" name="nationality[]" value="nonJordanian"> Non-Jordanian</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-4">
                                                <!-- Gender Filter -->
                                                <div class="col-md-2 col-sm-12">
                                                    <h6><i class="fas fa-venus-mars me-2"></i> Gender</h6>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="genderDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select Gender
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="genderDropdown">
                                                            <li><input class="form-check-input" type="checkbox" name="gender[]" value="female"> Female</li>
                                                            <li><input class="form-check-input" type="checkbox" name="gender[]" value="male"> Male</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Technology Filter -->
                                                <div class="col-md-4 col-sm-12">
                                                    <h6><i class="fas fa-cogs me-2"></i> Technology</h6>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="technologyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select Technology
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="technologyDropdown">
                                                            <li><input class="form-check-input" type="checkbox" name="technology[]" value="mernStack"> MERN Stack</li>
                                                            <li><input class="form-check-input" type="checkbox" name="technology[]" value="laravel"> Laravel</li>
                                                            <li><input class="form-check-input" type="checkbox" name="technology[]" value="aspNet"> ASP.NET</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Submit Filters Button -->
                                                <div class="col-md-4 col-sm-12">
                                                    <h6>&nbsp;</h6>
                                                    <input class="btn btn-primary w-100" type="button" value="Apply Filters" onclick="applyFilters()" style="border-radius: 3px;">
                                                </div>
                                            </div>

                                            <div class="key_source">&nbsp;</div>
                                            <div>&nbsp;</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="content-container container-lg my-5">
        <div class="row">
            <!-- Selected Filters Display -->
            <div class="col-md-11 col-12 left-column offset-md-1 mb-4">
                <h6>Applied Filters:</h6>
                <div id="selectedFilters" class="mb-4"></div>
            </div>

            <!-- Main content for Candidate Profile -->
            <div class="col-md-11 col-12 left-column offset-md-1">
                <div class="mb-4">
                    <h1>Trainee's Profiles</h1>
                </div>

                <div class="row" id="traineeList">
                    @foreach($trainees as $trainee)
                        <div class="col-lg-2 col-md-6 mb-4 trainee-card" data-education="{{ strtolower($trainee->education) }}" data-background="{{ strtolower($trainee->background) }}" data-nationality="{{ strtolower($trainee->nationality) }}" data-gender="{{ strtolower($trainee->gender) }}" data-technology="{{ strtolower($trainee->technology) }}">
                            <div class="card h-100 border-0">
                                <img src="{{ asset('images/' . $trainee->id_img) }}" class="card-img-top" alt="Trainee Image" style="width: 100%; height: auto;">
                                <div class="card-body px-0">
                                    <h6 class="card-title">{{ $trainee->first_name }} {{ $trainee->last_name }}</h6>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#traineeModal{{$trainee->id}}">
                                        More Info
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Trainee Details -->
                        <div class="modal fade" id="traineeModal{{$trainee->id}}" tabindex="-1" aria-labelledby="traineeModalLabel{{$trainee->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="traineeModalLabel{{$trainee->id}}">{{ $trainee->first_name }} {{ $trainee->last_name }}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Education:</strong> {{ $trainee->education }}</p>
                                        <p><strong>Background:</strong> {{ $trainee->background }}</p>
                                        <p><strong>Nationality:</strong> {{ $trainee->nationality }}</p>
                                        <p><strong>Gender:</strong> {{ $trainee->gender }}</p>
                                        <p><strong>Technology:</strong> {{ $trainee->stack }}</p>
                                        <!-- Additional trainee details can be added here -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            let selectedFilters = [];
            const formData = new FormData(document.getElementById('filterForm'));
            formData.forEach((value, key) => {
                selectedFilters.push(key + ": " + value);
            });
            document.getElementById('selectedFilters').innerHTML = selectedFilters.join(', ');

            // Filter trainees based on selected filters
            const trainees = document.querySelectorAll('.trainee-card');
            trainees.forEach(trainee => {
                const education = trainee.getAttribute('data-education');
                const background = trainee.getAttribute('data-background');
                const nationality = trainee.getAttribute('data-nationality');
                const gender = trainee.getAttribute('data-gender');
                const technology = trainee.getAttribute('data-technology');

                // Check if all selected filters match
                const matchesFilters = Array.from(formData.entries()).every(([key, value]) => {
                    if (key === 'education[]') return education.includes(value);
                    if (key === 'background[]') return background.includes(value);
                    if (key === 'nationality[]') return nationality.includes(value);
                    if (key === 'gender[]') return gender.includes(value);
                    if (key === 'technology[]') return technology.includes(value);
                    return true;
                });

                trainee.style.display = matchesFilters ? 'block' : 'none';
            });
        }
    </script>
@endsection
