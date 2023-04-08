@extends('patient.layouts.app')
@section('page-title', 'Set Appointment')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"
        integrity="sha256-Fl1s8EQCc9mKf/njo8mWr0MPJR8TnOQb0h0rmVKRoP8=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endprepend
@section('content')
    <div class="alert alert-danger" role="alert">
        <b>There are some disabled dates which means on that date the clinic is close.</b>
    </div>
    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <div>
                <span class="fw-bold">Set an appointment</span>
            </div>
        </div>
        <div class="card-body">
            @if (is_null(auth()->user()->info))
                <h4 class="text-center">
                    Sorry but you can't set an appoint please complete your profile first.
                </h4>
                <div class="text-center">
                    <a href="/patient/edit" class="btn btn-success text-white">Update profile</a>
                </div>
            @else
                <form id="setAppointmentForm">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="services">Select service</label>
                            <select name="service_id" id="services" class="form-control multiple-service" multiple>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table border table-sm service-table">
                                    <thead>
                                        <tr>
                                            <th class="border text-dark text-center">Service</th>
                                            <th class="border text-dark text-center">Fee</th>
                                            <th class="border text-dark text-center">Per each</th>
                                            <th class="border text-dark text-center"># of tooth</th>
                                            <th class="border text-dark text-center">Hour/s</th>
                                        </tr>
                                    </thead>
                                    <tbody id="service-container-dynamic">
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="doctors">Select doctor</label>
                        <select name="doctor" id="doctors" class="form-control">
                            <option selected disabled>Select doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->title . ' ' . ucfirst($doctor->firstname) . ' ' . ucfirst($doctor->lastname) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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
                    <div id="recommendTime" class="d-none">
                        <table class="table table-bordered border">
                            <thead>
                                <tr>
                                    <td class="text-center">Time</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="vacants"></tbody>
                        </table>
                    </div>
                </form>
            @endif
        </div>
    </div>
    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"
            integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                const SERVICES = @json($services);
                const CLOSE_DAYS = @json($closeDays);
                let serviceTracker = [];

                $('.multiple-service').select2({
                    placeholder: 'Select a service',
                });

                let closeDates = CLOSE_DAYS.map(data => moment(data.start).format('MM/D/Y'));

                let dp = $('#datetimepicker1').datetimepicker({
                    pickTime: false,
                    todayHighlight: true,
                    startDate: new Date(),
                    minDate: new Date(),
                    daysOfWeekDisabled: [0, 7],
                    disabledDates: closeDates,
                });

                const isUserSelectServiceAndDoctor = () => $('#services').val() && $('#doctors').val();

                const computeServiceFee = (services) => {
                    let totalServiceFee = 0;
                    services.map((service) => totalServiceFee += parseFloat(service.price));
                    return totalServiceFee;
                };

                const computeServiceDuration = (services) => {
                    let totalServiceDuration = 0;
                    services.map((service) => totalServiceDuration += parseInt(service.duration));
                    return totalServiceDuration;
                };

                const displayVacantsTime = (response) => {
                    let vacants = "";
                    response.availables.forEach((data) => {
                        let [start, end, status] = data.split('|');
                        if (status === 'exists') {
                            vacants += `
                                <tr>
                                        <td class="border text-center"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                                        <td class="border text-center fw-bold text-danger">
                                            <span class="badge bg-danger">Not Available</span>    
                                        </td>
                                        <td class="border text-center"></td>
                                </tr>`;
                        } else {
                            vacants += `
                            <tr>
                                    <td class="border text-center"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                                    <td class="border fw-bold text-center">
                                        <span class="badge bg-success text-white">Available</span></b>
                                    </td>
                                    <td class="border text-center">
                                        <button class="btn btn-sm btn-primary btn-time-selected" type="button" data-start="${start}" data-end="${end}">Select</button>
                                    </td>
                            </tr>`;
                        }

                    });

                    $('#vacants').append(vacants);
                    $('#recommendTime').removeClass('d-none');
                };

                const getRecommendedTime = () => {
                    let selectedDate = $('#datetimepicker1').find('input').val().replaceAll('/', '-');
                    let doctorId = $('#doctors').children('option:selected').val();
                    let serviceDuration = $('#service-duration-total').text().trim();
                    $('#vacants').html('');
                    $.ajax({
                        url: `/patient/appointment/available/${selectedDate}/${doctorId}/${serviceDuration}`,
                        type: 'GET',
                        success: function(response) {
                            displayVacantsTime(response);
                        },
                    });
                }

                $(document).on('keyup', '.no-of-teeth', function() {
                    let total = 0;
                    let id = $(this).attr('data-id');
                    let price = $(this).attr('data-price');
                    let noOfTeeth = $(this).val();

                    if (noOfTeeth) {
                        total = parseFloat(price) * parseInt(noOfTeeth);
                        $(`#service-price-${id}`).text((total).toFixed(2));

                        // Reading all the value of service fee column in table
                        let totalServiceFee = 0;
                        $('.service-price').each((index, element) => totalServiceFee += parseFloat($(element)
                            .text()));
                        $('#service-fee-total').find('span').text(totalServiceFee.toFixed(2));
                    }
                });


                $('.multiple-service').change(function() {
                    let selectedIds = $(this).val();

                    if (selectedIds) {
                        let selectedServiceIds = selectedIds.map((serviceID) => parseInt(serviceID));
                        let selectedService = SERVICES.filter((service) => selectedServiceIds.includes(service
                            .id));

                        if (selectedIds.length > serviceTracker.length) {
                            selectedService.forEach((service) => {
                                if (serviceTracker.includes(service.id)) {
                                    return;
                                }

                                $('#service-container-dynamic').append(`
                                    <tr class="" data-service-id="${service.id}">    
                                        <td class="border text-dark">
                                            <span class="mx-5">${service.name}</span>    
                                        </td>
                                        <td class="border text-dark text-end">
                                            <span class="mx-5 service-price" id="service-price-${service.id}">${service.price}</span>
                                        </td>
                                        <td class="border text-dark text-center">
                                            ${service.per_each == 1 ? '<span class="badge bg-primary">Yes</span>' : '<span class="badge bg-danger">No</span>'}    
                                        </td>
                                        <td class="border text-dark">
                                            <input class="form-control no-of-teeth" data-id="${service.id}" data-price="${service.price}" ${service.per_each == 1 ? 'value="1"' : 'value=""'} placeholder="Enter how many teeth" ${service.per_each == 0 ? 'disabled' : ''}>    
                                        </td>
                                        <td class="border text-dark text-center">
                                            ${service.duration}
                                        </td>
                                    </tr>
                            `);
                            });
                        } else {
                            let removedServiceIds = serviceTracker.filter((serviceID) => !selectedServiceIds
                                .includes(
                                    serviceID));

                            removedServiceIds.forEach((serviceID) => {
                                $(`#service-container-dynamic tr[data-service-id="${serviceID}"]`)
                                    .remove();
                            });
                        }


                        // To track the selected service we need to store it to a global array variable
                        serviceTracker = selectedServiceIds;

                        // total
                        let totalServiceFee = computeServiceFee(selectedService);
                        let totalServiceDuration = computeServiceDuration(selectedService);
                        $('.service-table > tfoot').html(`
                            <tr class="bg-primary">
                                <td class="border text-white border-primary">
                                </td>
                                <td class="border border-primary text-white text-end" id="service-fee-total">
                                    <span class="mx-5 fw-bold">${totalServiceFee.toFixed(2)}</span>
                                </td>
                                <td class="border border-primary text-white text-center">
                                </td>
                                <td class="border text-white border-primary">
                                </td>
                                <td class="border text-white text-center fw-bold border-primary" id="service-duration-total">
                                    ${totalServiceDuration}
                                </td>
                            </tr>
                        `);
                    }
                    getRecommendedTime();
                });


                $(document).on('click', '.btn-time-selected', function() {
                    let messageElement = document.createElement("p");
                    messageElement.innerHTML =
                        `<p>Have you reviewed and verified all the details of your appointment?</p>`;
                    messageElement.classList.add('text-center');
                    messageElement.classList.add('fw-medium');

                    swal({
                        title: "",
                        content: messageElement,
                        icon: "info",
                        buttons: ["Cancel", "Yes"],
                    }).then((confirmation) => {
                        if (confirmation) {
                            let selectedStart = $(this).attr('data-start');
                            let selectedEnd = $(this).attr('data-end');
                            let data = $('#setAppointmentForm').serialize();

                            $.ajax({
                                url: '/patient/appointment',
                                type: 'POST',
                                data: `${data}&start_date=${selectedStart}&end_date=${selectedEnd}`,
                                success: function(response) {
                                    if (response.success) {
                                        swal({
                                            title: "",
                                            text: "Successfully set an appointment",
                                            buttons: false,
                                            icon: "success",
                                        }).then((isClicked) => window.location
                                            .href = '/patient/appointment/');
                                    }
                                }
                            });
                        }
                    });
                });

                $('#doctors').change(getRecommendedTime);

                $('#datetimepicker1').datetimepicker().on('dp.change', function() {
                    // If the user already select a service and doctor.
                    if (isUserSelectServiceAndDoctor()) {
                        getRecommendedTime();
                    } else {
                        swal({
                            title: "",
                            text: "Please select a service and doctor first",
                            icon: "warning",
                            buttons: false,
                            timer: 5000,
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
