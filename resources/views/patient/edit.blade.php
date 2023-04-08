@extends('patient.layouts.app')
@section('page-title', 'Edit Account')
@section('content')
    <div class="alert alert-{{ Session::has('success') ? 'success' : 'info' }}" role="alert">
        @if (Session::has('success'))
            {{ Session::get('success') }}
        @else
            Optional password field. Fill if changing password.
        @endif
    </div>
    @if ($errors->any())
        <div class="text-danger">
            <div class="alert alert-danger">
                @include('templates.error')
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <span class="fw-bold">
                Account Information
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('account.settings.update', [Auth::user()]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Patient Number</label>
                    <input type="text" class="form-control" readonly value="{{ Auth::user()->patient_number }}">
                </div>

                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="{{ old('firstname') ?? Auth::user()->firstname }}">
                </div>

                <div class="form-group">
                    <label for="middlename">Middlename</label>
                    <input type="text" class="form-control" id="middlename" name="middlename"
                        value="{{ old('middlename') ?? Auth::user()->middlename }}">
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"
                        value="{{ old('lastname') ?? Auth::user()->lastname }}">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username') ?? Auth::user()->username }}">
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile No.</label>
                    <input type="text" class="form-control" id="mobile" name="mobile_no"
                        value="{{ old('mobile_no') ?? Auth::user()->mobile_no }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                </div>

                <hr>
                <div class="alert alert-info" role="alert">
                    Please fill the following fields to set an appointment.
                </div>


                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="{{ old('birthdate') ?? ($patient->info->birthdate ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" readonly class="form-control" id="age" name="age"
                        value="{{ old('age') ?? ($patient->info->age ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="martial_status">Martial Status</label>
                    @php
                        $martial_status = old('martial_status') ?? (@$patient->info->martial_status ?? '');
                    @endphp
                    <select class="form-control" id="martial_status" name="martial_status">


                        <option value="Single" {{ $martial_status === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ $martial_status === 'Married' ? 'selected' : '' }}>Married
                        </option>
                        <option value="Divorced" {{ $martial_status === 'Divorced' ? 'selected' : '' }}>Divorced
                        </option>
                        <option value="Widowed" {{ $martial_status === 'Widowed' ? 'selected' : '' }}>Widowed
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="sex">Gender</label>
                    <select class="form-control" id="sex" name="sex">
                        <option value="Female"
                            {{ old('sex') === 'Female' || @$patient->info->sex === 'Female' ? 'selected' : '' }}>
                            Female</option>
                        <option value="Male"
                            {{ old('sex') === 'Male' || @$patient->info->sex === 'Male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="Choose not to say"
                            {{ old('sex') === 'Choose not to say' || @$patient->info->sex === 'Choose not to say' ? 'selected' : '' }}>
                            Choose not to say</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation"
                        value="{{ old('occupation') ?? ($patient->info->occupation ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="home_address">Home Address</label>
                    <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10">{{ old('home_address') ?? ($patient->info->home_address ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <input type="file" id="profile" name="profile">
                </div>
                <hr>
                <input type="submit" value="Update" class="btn text-white btn-success float-end">
            </form>

        </div>
    </div>
    @push('page-scripts')
        <script>
            $('#birthdate').change(function(e) {
                console.log(e.target.value);
                let [birthYear, month, date] = e.target.value.split('-');
                let currentYear = new Date().getFullYear();
                $('#age').val(currentYear - birthYear);
            });
        </script>
    @endpush
@endsection
