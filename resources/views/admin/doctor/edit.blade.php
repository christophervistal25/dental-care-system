@extends('admin.layouts.app')
@section('page-title', 'Edit Doctor Information')
@prepend('page-css')
    <style>
        .invalid-feedback {
            color: red !important;
        }
    </style>
@endprepend
@section('title', 'Edit Doctor Information')
@section('content')
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Edit Doctor Information</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                id="firstname" name="firstname" value="{{ old('firstname', $doctor->firstname) }}">
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror"
                                id="middlename" name="middlename" value="{{ old('middlename', $doctor->middlename) }}">
                            @error('middlename')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                id="lastname" name="lastname" value="{{ old('lastname', $doctor->lastname) }}">
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="suffix">Suffix</label>
                            <input type="text" class="form-control @error('suffix') is-invalid @enderror" id="suffix"
                                name="suffix" value="{{ old('suffix', $doctor->suffix) }}">
                            @error('suffix')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="suffix">Contact no.</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror"
                                id="contact_no" name="contact_no" value="{{ old('contact_no', $doctor->contact_no) }}">
                            @error('contact_no')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $doctor->gender) == 'male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="female" {{ old('gender', $doctor->gender) == 'female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                id="birthdate" name="birthdate" value="{{ old('birthdate', $doctor->birthdate) }}">
                            @error('birthdate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $doctor->title) }}">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file"
                                class="form-control @error('image') is-invalid @enderror"name="image" id="image"
                                accept="image/*">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="active">Status</label>
                            <select class="form-control @error('active') is-invalid @enderror" id="active"
                                name="active">
                                <option value="active" {{ old('active', $doctor->active) == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="in-active"
                                    {{ old('active', $doctor->active) == 'in-active' ? 'selected' : '' }}>In-Active
                                </option>
                            </select>
                            @error('active')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="float-end text-white btn btn-success">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-scripts')
    @endpush
@endsection
