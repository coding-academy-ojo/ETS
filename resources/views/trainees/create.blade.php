@extends('layouts.app')
@section('content')
  <div class="container-fluid">
  </div>
  <div class="container-fluid">
  <div id="localContainer" class="o-nav-local navbar-light">
    <nav role="navigation" class="container-fluid"  aria-label="News categories navigation" fixed-top>
    </nav>
  </div>
  <div class="container">
    <h1>Create New Trainee</h1>

    <form action="{{ route('employment-status.store') }}" method="post">
        @csrf

        <!-- Add your form fields here -->
        <!-- For example, you can use the same form fields as in the 'edit' form -->

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>


        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile">
        </div>


        <div class="form-group">
            <label for="graduated">Graduated</label>
            <input type="text" class="form-control" id="graduated" name="graduated">
        </div>

        <div class="form-group">
            <label for="certificat_type">Certificat_type</label>
            <input type="text" class="form-control" id="certificat_type" name="certificat_type">
        </div>

        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" class="form-control" id="nationality" name="nationality">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>

        <div class="form-group">
            <label for="id_img">Id Img</label>
            <input type="text" class="form-control" id="id_img" name="id_img">
        </div>















        <!-- Add more form fields as needed -->

        <button type="submit" class="btn btn-primary">Add Trainee</button>
    </form>
</div>
@endsection
