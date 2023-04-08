@extends('admin.layouts.app')
@section('page-title', 'Add new Patient')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            <span>his/her patient number is
                <strong>{{ Session::get('patient_no') }}</strong> do you want to add <b>Examination Record Chart?</b> 
                    <a href="{{ route('patient.examination.record.create', [Session::get('patient_id')]) }}">(Click this)</a>
            </span>
        </div>
    @else
        @if ($errors->any())
            <div class="alert alert-danger">
                @include('templates.error')
            </div>
        @endif
    @endif
    <div class="clearfix"></div>

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">Add New Patient</span>
        </div>
        <div class="card-body">

            <form action="{{ route('patient.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstname">Firstname <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="{{ old('firstname') }}">
                </div>

                <div class="form-group">
                    <label for="middlename">Middlename <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="middlename" name="middlename"
                        value="{{ old('middlename') }}">
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                </div>

                <div class="form-group">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="mobile" name="mobile_no"
                        value="{{ old('mobile_no') }}">
                </div>

                {{-- <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" id="password">
          </div>

          <div class="form-group">
            <label for="passwordConfirmation">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
          </div> --}}

                <div class="form-group hide">
                    <label for="nickname">Nickname <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}">
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="{{ old('birthdate') }}">
                </div>

                <div class="form-group">
                    <label for="age">Age <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="age" name="age" readonly
                        value="{{ old('age') }}">
                </div>

                <div class="form-group">
                    <label for="martial_status">Martial Status <span class="text-danger">*</span></label>
                    <select class="form-control" id="martial_status" name="martial_status">
                        <option value="Single" {{ old('martial_status') === 'Single' ? 'selected' : '' }}>Single
                        </option>
                        <option value="Married" {{ old('martial_status') === 'Married' ? 'selected' : '' }}>Married
                        </option>
                        <option value="Divorced" {{ old('martial_status') === 'Divorced' ? 'selected' : '' }}>
                            Divorced</option>
                        <option value="Widowed" {{ old('martial_status') === 'Widowed' ? 'selected' : '' }}>
                            Widowed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sex">Sex <span class="text-danger">*</span></label>
                    <select class="form-control" id="sex" name="sex">
                        <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Choose not to say" {{ old('sex') === 'Choose not to say' ? 'selected' : '' }}>Choose
                            not to say</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="occupation" name="occupation"
                        value="{{ old('occupation') }}">
                </div>

                <div class="form-group">
                    <label for="home_address">Home Address <span class="text-danger">*</span></label>
                    <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10">{{ old('home_address') }}</textarea>
                </div>

                <div class="float-end">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    @push('page-scripts')
        <script>
            $('#birthdate').keyup(function(e) {
                let birthYear = e.target.value.split('-')[0];
                let currentYear = new Date().getFullYear();
                $('#age').val(currentYear - birthYear);
            });
        </script>
    @endpush
@endsection
