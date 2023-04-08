@extends('admin.layouts.app')
@section('page-title', 'List of Patients')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endprepend
@section('content')
    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <span class="fw-bold">Complete Listing of Patients</span>
            <div>
                <a class="btn btn-success text-white" href="{{ route('patient.list-print') }}">
                    Print</a>
                <a class="btn btn-primary text-white" href="{{ route('patient.create') }}">Add New Patient</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table border" id="datatable">
                <thead>
                    <tr>
                        <th class="text-dark border text-center">Patient Number</th>
                        <th class="text-dark border text-center">Name</th>
                        <th class="text-dark border text-center">Username</th>
                        <th class="text-dark border text-center">Mobile</th>
                        <th class="text-dark border text-center">Registered at</th>
                        <th class="text-center text-dark border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="text-center border font-weight-bold">{{ $patient->patient_number }}</td>
                            <td class="text-start border">
                                <span class="mx-2">
                                    {{ $patient->firstname . ' ' . $patient->middlename . ' ' . $patient->lastname }}
                                </span>
                            </td>
                            <td class="text-center border">{{ $patient->username }}</td>
                            <td class="text-center border">{{ $patient->mobile_no }}</td>
                            <td class="text-center border">{{ $patient->created_at->format('l jS \\of F Y') }}</td>
                            <td class="text-center border">
                                <button class="btn btn-sm text-white btn-success btn-edit-info" data-src="{{ $patient }}"><i
                                        class="fa fa-user"></i> Information</button>
                                <a class="btn btn-primary btn-sm mx-3" href="{{ route('patient.examination.record.create', [$patient->id]) }}"> <i class="fas fa-plus"></i> Add Examination Record</a>
                                <a class="btn btn-info btn-sm text-white" href="{{ route('patient.examination.history', [$patient->id]) }}"> <i
                                        class="fas fa-history"></i> Examination Record History <span class="badge bg-primary mx-2">{{ $patient->examinations_count }}</span> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- Edit Patient Information modal --}}
    {{-- DON'T REMOVE THE CLASS OF THIS OR ELSE THE MODAL WILL NOT DISPLAY --}}
    {{-- ALSO DON'T CHANGE SOME NAME ATTRIBUTES OF THE FIELDS FILLABLES IN PATIENT MODEL MUST BE EQUAL TO THE NAME ATTRIBUTES OF INPUT FIELDS --}}
    <div class="modal bs-edit-patient-info-modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editPatientInfo">Patient Information</h4>
                </div>
                <form id="editPatientInfoForm">
                    <div class="modal-body" id="informationContainer">
                        <div class="alert alert-danger d-none" id="edit-patient-error-message"></div>
                        <div class="form-group">
                            <label for="firstname">Firstname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>

                        <div class="form-group">
                            <label for="middlename">Middlename <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mobile" name="mobile_no">
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>

                        <div class="form-group">
                            <label for="age">Age <span class="text-danger">*</span></label>
                            <input type="number" readonly class="form-control" id="age" name="age">
                        </div>

                        <div class="form-group">
                            <label for="martial_status">Martial Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="martial_status" name="martial_status">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sex">Sex <span class="text-danger">*</span></label>
                            <select class="form-control" id="sex" name="sex">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                                <option value="Choose not to say">Choose not to say</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="occupation">Occupation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="occupation" name="occupation">
                        </div>

                        <div class="form-group">
                            <label for="home_address">Home Address <span class="text-danger">*</span></label>
                            <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /modals -->

    @push('page-scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                let patientInformation;

                $('#datatable').DataTable({});

                $('.btn-edit-info').click(function() {
                    patientInformation = JSON.parse($(this).attr('data-src'));
                    // Get all the input fields in edit modal
                    let inputFields = $('#informationContainer').children().find('input');

                    $('#home_address').val(patientInformation.info.home_address);

                    inputFields.map((index, element) => {
                        let name = $(element).attr('name');
                        if (patientInformation.hasOwnProperty(name)) {
                            // set field values for basic information of patient.
                            $(element).val(patientInformation[name]);
                        } else {
                            // Set field values for patient other information.
                            // console.log(patientInformation);
                            $(element).val(patientInformation.info[name]);
                        }
                        $('#sex').val(patientInformation.info['sex']);
                        $('#martial_status').val(patientInformation.info['martial_status']);
                    });

                    // Open the modal
                    $('.bs-edit-patient-info-modal').modal('toggle');
                });

                $('#editPatientInfoForm').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: `/admin/patient/${patientInformation.id}`,
                        type: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                swal({
                                    title: '',
                                    text: 'Successfully update the informatrion of patient this page will automatically reload to apply changes.',
                                    icon: 'success',
                                    buttons: false,
                                    timer: 1000,
                                }).then(() => location.reload());
                            }
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;
                                let messages = "";
                                Object.values(errors).forEach((error) => {
                                    messages += `<li>${error}</li>`;
                                });
                                $('#edit-patient-error-message').html(messages);
                                $('#edit-patient-error-message').removeClass('d-none');
                            }
                        }
                    });
                });

                $('#birthdate').keyup(function(e) {
                    let birthYear = e.target.value.split('-')[0];
                    let currentYear = new Date().getFullYear();
                    $('#age').val(currentYear - birthYear);
                });
            });
        </script>
    @endpush
@endsection
