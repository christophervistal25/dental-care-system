@extends('admin.layouts.app')
@section('page-title', 'Daily Reports')
@prepend('page-css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"
        integrity="sha256-Fl1s8EQCc9mKf/njo8mWr0MPJR8TnOQb0h0rmVKRoP8=" crossorigin="anonymous" />
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
@endprepend
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-6 mb-2">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">total fees</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center" id="total-fees">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-6 mb-2">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">total patients</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center" id="total-patients">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <span class="fw-bold">Daily Report</span>
            <a href="{{ route('reports.daily.print') }}" class="btn btn-primary">PRINT</a>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div class="spinner-border text-primary text-center d-none" role="status" id="loader"></div>
            </div>
            <div class="d-none" id="reports-container">

                <div id="table-container"></div>
            </div>

        </div>
    </div>


    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"
            integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
        <script>
            (function() {
                let startDate = moment(new Date()).format('YYYY-MM-DD');
                let endDate = startDate;
                let totalFees = 0;
                let totalNoOfPatients = 0;
                $('#loader').removeClass('d-none');
                $('#reports-container').addClass('d-none');

                // Ajax request send to Controller
                $.ajax({
                    url: `/admin/reports/generate/${startDate}/${endDate}`,
                    type: 'GET',
                    success: function(patients) {
                        $('#reports-container').removeClass('d-none');
                        $('#loader').addClass('d-none');
                        $('#table-container').html('');

                        $('#records').html('');
                        for (let service in patients.reports) {
                            $('#table-container').append(`<h3>${service}</h3>`);
                            $('#table-container').append(`
                              <table class="table border">
                                    <thead>
                                      <tr>
                                          <th class="border text-dark">Patient name</th>
                                          <th class="border text-dark">Fee</th>
                                          <th class="border text-dark">Examination Date</th>
                                      </tr>
                                  </thead>
                                <tbody id='dynamic-${service}-data'>
                                </tbody>
                              </table>
                            `);
                            patients.reports[service].forEach((data) => {
                                $(`#dynamic-${service}-data`).append(`
                                      <tr>
                                        <td class="text-capitalize border">${data.patient.firstname} ${data.patient.middlename} ${data.patient.lastname}</td>
                                        <td class="border">${data.payments.fee}</td>
                                        <td class="border">${moment(data.created_at).format('LLL')}</td>
                                      </tr>
                              `);
                                totalFees += parseInt(data.payments.fee);
                            });
                        }

                        // $('#table-container').append(`<hr/>`);

                        patients.services.forEach((service) => {
                            $('#table-container').append(`<h3 class='text-danger'>${service}</h3>`);
                            $('#table-container').append(`
                              <table class="table border">
                                    <thead>
                                      <tr>
                                        <th class="border">&nbsp;</th>  
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td colspan='3' class='font-weight-bold text-center border'>No Available Data</td>
                                      </tr>
                                    </tbody>
                              </table>
                          `);

                        });
                        $('#total-fees').text(`${totalFees}.00`);
                        $('#total-patients').text(`${patients.total_count}`);
                    }
                });
            })();
        </script>
    @endpush
@endsection
