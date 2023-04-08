@extends('patient.layouts.app')
@section('page-title', 'Reschedule Appointment')

@prepend('meta')
    <meta name="close-days" content="{{ $closeDays }}">
@endprepend
@prepend('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"
        integrity="sha256-Fl1s8EQCc9mKf/njo8mWr0MPJR8TnOQb0h0rmVKRoP8=" crossorigin="anonymous" />
@endprepend
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    Reschedule Appointment
                </div>
                <div class="card-body">

                    @if (is_null(auth()->user()->info))
                        <h3 class="text-center">Sorry but you can't set an appoint please complete your profile first. <a
                                href="/patient/edit" class="btn btn-success btn-sm">Update profile</a></h3>
                    @else
                        <div class="alert alert-danger" style="color :white;" role="alert">
                            <b>NOTE: There are some disabled dates which means on that date the clinic is close.</b>
                        </div>
                        <form id="setAppointmentForm">

                            <div class="form-group col-lg-12">
                                <label for="date">Select Date (click the icon to select date)</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" readonly />
                                    <span class="input-group-addon">
                                        <div
                                            class="d-flex flex-column justify-content-center align-items-center btn btn-primary p-3 rounded">
                                            <i class="fa-solid fa-calendar fa-1x"></i>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div id="recommendTime" class="hide">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-dark border">Time</th>
                                            <th class="text-center text-dark border">Status</th>
                                            <th class="text-center text-dark border">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vacants"></tbody>

                                </table>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"
            integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
        <script>
            String.prototype.replaceAll = function(search, replacement) {
                var target = this;
                return target.replace(new RegExp(search, 'g'), replacement);
            };

            let closeDays = JSON.parse($('meta[name="close-days"]').attr('content'));
            let closeDates = closeDays.map(data => moment(data.start).format('MM/D/Y'));

            let dp = $('#datetimepicker1').datetimepicker({
                pickTime: false,
                // todayHighlight: true,
                startDate: new Date(),
                minDate: new Date(),
                daysOfWeekDisabled: [0, 7],
                disabledDates: closeDates,
            });

            // To already show the datetimepicker dates.
            $('.input-group-addon').trigger('click');
            // Immediately Display all vacant time for today.
            getRecommendedTime();

            function alreadySelectATime(e) {
                let messageElement = document.createElement("p");
                messageElement.innerHTML = `<p>Have you reviewed and verified all the details of your appointment?</p>`;
                messageElement.classList.add('text-center');
                messageElement.classList.add('fw-medium');
                swal({
                    title: "",
                    content: messageElement,
                    icon: "info",
                    buttons: ["No", "Yes"],
                }).then((confirmation) => {
                    if (confirmation) {
                        let selectedStart = e.getAttribute('data-start');
                        let selectedEnd = e.getAttribute('data-end');
                        let data = $('#setAppointmentForm').serialize();

                        $.ajax({
                            url: '/patient/appointment/{{ $appointment->id }}',
                            type: 'PUT',
                            data: `${data}&start_date=${selectedStart}&end_date=${selectedEnd}`,
                            success: function(response) {
                                if (response.success) {
                                  swal({
                                    title : "",
                                    text : "Successfully rescheduled your appointment",
                                    icon : "success",
                                    timer : 5000,
                                    buttons : false,
                                  }).then((isProceed) => window.location.href = '/patient/appointment/');
                                }
                            }
                        });
                    }
                });


            }

            let displayVacantsTime = (response) => {
                let vacants = "";
                response.availables.forEach((data) => {
                    let [start, end, status] = data.split('|');
                    if (status === 'exists') {
                        alert(
                            `${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')} is not available.`
                        );
                        vacants += `  <tr>
                              <td class="text-center text-dark border"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                              <td class="text-center text-dark border"><b><span class="badge bg-danger text-white">Not Available</span></b></td>
                              <td class="text-center text-dark border"></td>
              </tr>`;
                    } else {
                        vacants += `  <tr>
                              <td class="text-center text-dark border"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                              <td class="text-center text-dark border"><b><span class="badge bg-success text-white">Available</span></b></td>
                              <td class="text-center text-dark border"><button onclick="alreadySelectATime(this)" class="btn btn-sm btn-primary" type="button" data-start="${start}" data-end="${end}">Select</button></td>
              </tr>`;
                    }

                });
                $('#vacants').append(vacants);
                $('#recommendTime').removeClass('hide');
            };


            function getRecommendedTime() {
                let selectedDate = $('#datetimepicker1').find('input').val().replaceAll('/', '-');
                let doctorId = {{ $appointment->doctor->id }};
                let service = {{ $appointment->service->id }};
                $('#vacants').html('');
                $.ajax({
                    url: `/patient/appointment/available/${selectedDate}/${doctorId}/${service}`,
                    type: 'GET',
                    success: function(response) {
                        displayVacantsTime(response);
                    },
                });
            }

            $('#datetimepicker1').datetimepicker().on('dp.change', function() {
                getRecommendedTime();
            });
        </script>
    @endpush
@endsection
