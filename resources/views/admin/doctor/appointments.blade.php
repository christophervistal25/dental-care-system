@extends('admin.layouts.app')
@section('page-title', $doctor->fullname . ' Appointments')
@prepend('page-css')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
@endprepend
@section('content')
    <div class="text-end">
        <button class="btn btn-primary mb-3" id="printDoctorAppointments">PRINT SCHEDULE</button>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">
                Appointments
            </span>
        </div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>

    <!-- Find Patient Modal -->
    <div class="modal fade bs-find-patient-modal" tabindex="-1" style="z-index: 9999;" role="dialog" aria-hidden="true"
        data-bs-backdrop="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="findPatient">Find Patient</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="patient_number"
                            placeholder="Search patient by using Patient ID/Firstname/Lastname" class="form-control"
                            id="searchPatient" autocomplete="off">
                    </div>
                    <table class="table border">
                        <thead>
                            <tr>
                                <th class="border text-dark text-center">Patient Number</th>
                                <th class="border text-dark text-center">Name</th>
                                <th class="border text-dark text-center">Mobile no</th>
                                <th class="border text-dark text-center">Registered on</th>
                                <th class="border text-dark text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="fetchedPatients">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Find Patient Modal -->

    <!-- Add Appointment -->
    <div class="modal fade bs-appointment-add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Appointment details for
                        {{ $doctor->title . ' ' . $doctor->firstname }} {{ $doctor->lastname }}</h4>
                </div>
                <form id="addAppointmentForm">
                    <div class="modal-body">
                        <div class="float-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('patient.create') }}">Entry New Patient</a>
                            <button type="button" class="btn btn-success btn-sm text-white" id="btnFindPatient">Find
                                Patient</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="alert alert-danger d-none" id="add-appointment-error-message"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="patient_no">Patient No.</label>
                                    <input type="text" id="patient_no" name="patient_no" readonly class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="patient_id" id="patientId">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" readonly class="form-control">
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile no.</label>
                                    <input type="text" id="mobile_no" name="mobile_no" readonly class="form-control">
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="age">Age.</label>
                                    <input type="text" id="age" name="age" readonly class="form-control">
                                </div>
                            </div>


                            <hr>
                            <div class="col-lg-12">
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <input type="text" id="doctor" name="doctor" readonly class="form-control"
                                        value="{{ $doctor->title }} {{ $doctor->firstname }} {{ $doctor->lastname }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <input type="hidden" name="service_id" id="serviceId">
                                    <select name="service" id="service" class="form-control">
                                        <option selected disabled>Select service</option>
                                        @foreach ($services as $service)
                                            <option data-src="{{ $service }}" value="{{ $service->id }}">
                                                {{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="serviceFee">Service Fee</label>
                                    <input type="text" name="price" id="serviceFee" readonly class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="serviceHour">Service Hour</label>
                                    <input type="text" name="duration" id="serviceHour" readonly
                                        class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="startTime">Start time</label>
                                    <input type="text" name="start_date" id="startTime" readonly class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="endTime">End time</label>
                                    <input type="text" name="end_date" id="endTime" readonly class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Appointment -->

    <!-- Edit Appointment -->
    <div class="modal fade bs-appointment-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Appointment details</h4>
                </div>
                <form id="editAppointmentForm">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="patient_no">Patient No.</label>
                                    <input type="text" id="editPatientNo" name="editPatientNo" readonly
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" id="appointmentId">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="editName" readonly class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile no.</label>
                                    <input type="text" id="editMobile_no" readonly class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="editAge" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <input type="text" id="editDoctor" readonly class="form-control"
                                        value="{{ $doctor->title }} {{ $doctor->firstname }} {{ $doctor->lastname }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <select name="service" id="editService" class="form-control">
                                        <option selected disabled>Select service</option>
                                        @foreach ($services as $service)
                                            <option data-src="{{ $service }}" value="{{ $service->id }}">
                                                {{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="serviceFee">Service Fee</label>
                                    <input type="text" id="editServiceFee" readonly class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="serviceHour">Service Hour</label>
                                    <input type="text" id="editServiceHour" readonly class="form-control">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="startTime">Start time</label>
                                    <input type="text" name="start_date" id="editStartTime" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="endTime">End time</label>
                                    <input type="text" name="end_date" id="editEndTime" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success text-white">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Appointment -->


    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
        <script>
            $('.printBtn').on('click', function() {
                window.print();
            });
        </script>
        <script>
            $(document).ready(function() {

                let doctorId = {{ $doctor->id }};

                let calendar = $('#calendar').fullCalendar({
                    editable: true,
                    height: "auto",
                    allDaySlot: false,
                    slotMinutes: 1,
                    minTime: '8:00:00',
                    maxTime: '18:00:00',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultView: 'agendaDay',
                    selectable: true,
                    selectHelper: true,
                    eventSources: [{
                        url: `/admin/doctorappointment/${doctorId}`,
                        method: 'GET',
                        failure: function() {
                            alert(
                                'there was an error while fetching events try to reload the page.'
                            );
                        },
                    }],
                    // eventAfterRender: function (event, $el, view) {
                    //       $el.removeClass('fc-short');
                    // },
                    select: function(start, end, allDay) {
                        swal({
                            title: '',
                            icon: 'info',
                            text: 'Do you want to add a appointment?',
                            buttons: ["No", "Yes"],
                        }).then((isConfirmed) => {
                            if (isConfirmed) {
                                let formatedStart = $.fullCalendar.formatDate(start,
                                    "Y-MM-DD HH:mm:ss");
                                let formatedEnd = $.fullCalendar.formatDate(end,
                                    "Y-MM-DD HH:mm:ss");
                                if (formatedStart != null && formatedEnd != null) {
                                    $('.bs-appointment-add-modal').modal('toggle');
                                    $('#startTime').val(formatedStart);
                                    $('#endTime').val(formatedEnd);
                                }
                            }
                        });

                    },
                    eventDrop: function(event) {
                        editEventInCalendar(event);
                    },
                    eventResize: function(info) {
                        editEventInCalendar(info);
                    },
                    eventClick: function(info) {
                        editEventInCalendar(info);
                    }

                });
            });

            // Edit Event in calendar.
            function editEventInCalendar(info) {
                swal({
                    title: '',
                    text: 'Do you want to edit this appointment?',
                    icon: 'info',
                    buttons: ["No", "Yes"],
                }).then((isConfirmed) => {
                    if (isConfirmed) {
                        let start = $.fullCalendar.formatDate(info.start, "Y-MM-DD HH:mm:ss");
                        let end = $.fullCalendar.formatDate(info.end, "Y-MM-DD HH:mm:ss");
                        const regex = /\(([^)]+)\)/;
                        const match = regex.exec(info.title);

                        if (match && match.length > 1) {
                            const result = match[1];
                            $('#editPatientNo').val(result);
                        }

                        $('#appointmentId').val(info.id);
                        $('#editName').val(info.patient.firstname + ' ' + info.patient.middlename + ' ' + info.patient
                            .lastname);
                        $('#editEmail').val(info.patient.email);
                        $('#editMobile_no').val(info.patient.mobile_no);
                        $('#editService').val(info.service.id);
                        $('#editServiceFee').val(info.service.price);
                        $('#editServiceHour').val(info.service.duration);
                        $('#editAge').val(info.patient.age);
                        $('#editStartTime').val(start);
                        $('#editEndTime').val(end);
                        $('.bs-appointment-edit-modal').modal('toggle');
                    }
                });

            }

            // Select option in add modal
            $('#service').change(function() {
                let service = JSON.parse($(this).children('option:selected').attr('data-src'));
                $('#serviceId').val(service.id);
                $('#serviceFee').val(service.price);
                $('#serviceHour').val(service.duration);
            });

            // Select option in edit modal
            $('#editService').change(function() {
                let service = JSON.parse($(this).children('option:selected').attr('data-src'));
                $('#editServiceFee').val(service.price);
                $('#editServiceHour').val(service.duration);
            });

            // When then add modal trigger the save changes button.
            $('#addAppointmentForm').submit(function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    url: '/admin/doctorappointment',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            let messageElement = document.createElement('p');
                            messageElement.innerHTML = `<br><br>Appointment set successfully`;
                            messageElement.classList.add('text-center');
                            messageElement.classList.add('fw-medium');
                            messageElement.classList.add('text-dark');

                            swal({
                                title: '',
                                content: messageElement,
                                icon: 'success',
                                buttons: false,
                                timer: 5000,
                            });

                            $('.bs-appointment-add-modal').modal('toggle');
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let messages = "";
                            Object.values(errors).forEach((error) => {
                                messages += `<li>${error}</li>`;
                            });
                            $('#add-appointment-error-message').html(messages);
                            $('#add-appointment-error-message').removeClass('d-none');
                        }
                    }
                });
            });

            $('#editAppointmentForm').submit(function(e) {
                e.preventDefault();
                let appointmentId = $('#appointmentId').val();
                let data = $(this).serialize();
                $.ajax({
                    url: `/admin/doctorappointment/${appointmentId}`,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            let messageElement = document.createElement('p');
                            messageElement.innerHTML = `<br><br>Appointment updated successfully`;
                            messageElement.classList.add('text-center');
                            messageElement.classList.add('fw-medium');
                            messageElement.classList.add('text-dark');

                            swal({
                                title: '',
                                content: messageElement,
                                icon: 'success',
                                buttons: false,
                                timer: 5000,
                            });
                            $('.bs-appointment-edit-modal').modal('toggle');
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    },

                });
            });

            // Method for display the fetched patient in add modal.
            function saveToAddAppointmentForm(buttonClicked) {
                let patient = JSON.parse($(buttonClicked).attr('data-src'));
                $('#patientId').val(patient.id);
                $('#name').val(patient.firstname + ' ' + patient.middlename + ' ' + patient.lastname);
                $('#patient_no').val(patient.patient_number);
                $('#mobile_no').val(patient.mobile_no);
                $('#age').val(patient.info.age);
                $('.bs-find-patient-modal').modal('hide');
            }

            function isUserPressEnter(e) {
                return e.keyCode === 13;
            }

            function isInputHasValue() {
                return $('#searchPatient').val().length !== 0;
            }

            // Search patient
            $('#searchPatient').keyup(function(e) {
                if (isUserPressEnter(e)) {
                    if (isInputHasValue()) {
                        $.ajax({
                            url: `/admin/patient/search/${$(this).val()}`,
                            type: 'GET',
                            success: function(patients) {
                                let tableBody = "";
                                $('#fetchedPatients').html('');
                                if (patients.length !== 0) {
                                    patients.forEach((patient) => {
                                        tableBody += `
                                            <tr>
                                            <td class="text-dark border text-center">${patient.patient_number}</td>
                                            <td class="text-dark border text-center">${patient.firstname} ${patient.middlename} ${patient.lastname}</td>
                                            <td class="text-dark border text-center">${patient.mobile_no}</td>
                                            <td class="text-dark border text-center">${patient.created_at}</td>
                                            <td class="text-center border"><button class='btn btn-sm btn-primary' onclick="saveToAddAppointmentForm(this)" data-src='${JSON.stringify(patient)}'>SELECT</button></td>
                                            </tr>
                                            `;
                                    });
                                } else {
                                    tableBody = `
                                        <tr>
                                        <td class='text-center' colspan="5">
                                                Can't find any record.
                                        </td>
                                        </tr>
                                    `;
                                }
                                $('#fetchedPatients').append(tableBody);
                            },
                        });
                    }
                }
            });

            $('#printDoctorAppointments').click(function() {
                // .fc-center h2 the displayed date in full calendar
                let d = new Date($('.fc-center h2').text());
                let doctorId = {{ $doctor->id }};
                let formattedDate = moment(d).format('MM-DD-YYYY');
                window.location = `/admin/doctor/appointment/${doctorId}/${formattedDate}`
            });

            $('#btnFindPatient').click(function() {
                $('.bs-find-patient-modal').modal('toggle')
            });
        </script>
    @endpush
@endsection
