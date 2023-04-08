@extends('admin.layouts.app')
@section('page-title', 'Edit your account')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @include('templates.error')
        </div>
    @else
        <div class="alert alert-{{ Session::has('success') ? 'success' : 'info' }}" role="alert">
            @if (Session::has('success'))
                {{ Session::get('success') }}
            @else
                You may choose to leave the password field and profile unchanged, as they are optional. However, if you wish
                to make any changes, simply add the desired values
            @endif
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">Edit your account</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.update.account.setting', [auth()->user()->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Fullname</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') ?? auth()->user()->name }}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username') ?? auth()->user()->username }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <input type="file" id="profile" name="profile">
                </div>

                <div class="float-end">
                    <input type="submit" value="Update" class="btn btn-success text-white">
                </div>
            </form>
        </div>
    </div>
@endsection
