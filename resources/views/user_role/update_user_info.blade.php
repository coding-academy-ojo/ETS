@extends('layouts.app')

@section('content')

    <h1>Edit User Information</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('user.store_update', $user_info->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id"
                   value="" required>
            <div class="form-group">
                <label for="user_Name" class="is-required">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name"
                       value="{{ old('user_name', $user_info->name) }}" required>
            </div>

            <div class="form-group">
                <label for="user_pass">user password</label>
                <input type="password" class="form-control" id="user_pass" name="user_pass"
                       value="" >
            </div>
            <div class="form-group">
                <label for="user_pass_con">Confirmed password</label>
                <input type="password" class="form-control" id="user_pass_con" name="user_pass_con"
                       value="" >
            </div>


        </div>

        <button type="submit" class="btn btn-primary">Update User </button>
    </form>


@endsection
