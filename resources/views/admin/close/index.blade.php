@extends('admin.layouts.app')
@section('page-title', 'Complete listing of Close Days')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endprepend
@section('content')

    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <span class="fw-bold">Complete listing of close days</span>
            <button class="btn btn-success text-white mb-2" id="btnAddCloseDay"><i class="fa fa-plus"></i> Add Close
                day</button>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th class="border text-dark text-center">Date</th>
                        <th class="border text-dark text-center">All Day</th>
                        <th class="border text-dark text-center">Close For</th>
                        <th class="border text-dark text-center">Created on</th>
                        <th class="border text-dark text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dates as $date)
                        <tr>
                            <td class="text-center border"><b>{{ $date->start->format('F d, Y h:i A') }} to
                                    {{ $date->end->format('F d, Y h:i A') }}</b></td>
                            <td class="text-center border">
                                @if ($date->all_day)
                                    <span class="badge bg-primary">YES</span>
                                @else
                                    <span class="badge bg-success">NO</span>
                                @endif
                            </td>
                            <td class="text-center border">{{ $date->start->diffInHours($date->end) }} Hour/s</td>
                            <td class="text-center border">{{ $date->created_at->diffForHumans() }}</td>
                            <td class="text-center border">
                                <button data-src="{{ $date }}"
                                    class="btn btn-success btn-edit-close-day text-white btn-sm"><i
                                        class="fas fa-pen"></i></button>
                                <button data-src="{{ $date->id }}"
                                    class="btn btn-danger btn-delete-close-day text-white btn-sm"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Close day modal -->
    <div class="modal fade bs-add-close-day-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addCloseDay">Add Close Day</h4>
                </div>
                <form id="addCloseDayForm">
                    <div class="modal-body">

                        <div class="alert alert-danger d-none" id="add-close-day-error-message"></div>
                        <div class="alert alert-success" role="alert">
                            Please review your inputs this data will effect in patient setting an appointment.
                        </div>

                        <div class="form-group">
                            <label for="date">Start</label>
                            <input type='date' id="dateTimeStart" name="start" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="date">End</label>
                            <input type='date' name="end" class="form-control" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                            id="btnCloseAddModal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Close day -->

    <!-- Edit Close day modal -->
    <div class="modal fade bs-edit-close-day-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editCloseDay">Edit Close Day</h4>
                </div>
                <form id="editCloseDayForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Start</label>
                            <input type="date" name="start" class="form-control" id="editStartDate" />
                        </div>

                        <div class="form-group">
                            <label for="date">End</label>
                            <input type="date" name="end" class="form-control" id="editEndDate" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal" id="btnEditCloseDayModal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Close day -->

    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"
            integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $('#datatable').DataTable();

            let closeDayId;
            let startTemp = null;
            let endTemp = null;

            const datetimepickerOptions = {
                todayHighlight: true,
                minDate: new Date(),
            };

            // $('#editDatetimepicker1, #editDatetimepicker2').datetimepicker(datetimepickerOptions);

            // $('#datetimepicker2, #datetimepicker1').datetimepicker(datetimepickerOptions);

            $('#addCloseDayForm').submit(handleAddCloseDayFormSubmit);

            $('.btn-edit-close-day').click(handleEditCloseDayButtonClick);

            $('#editCloseDayForm').submit(handleEditCloseDayFormSubmit);

            $('.btn-delete-close-day').click(handleDeleteCloseDayButtonClick);

            $("#btnAddCloseDay").click(function() {
                $('.bs-add-close-day-modal').modal('toggle');
            })

            function handleAddCloseDayFormSubmit(e) {
                e.preventDefault();
                const data = $(this).serialize();
                $.ajax({
                    url: '/admin/close',
                    type: 'POST',
                    data,
                    success: handleAddCloseDaySuccess,
                    error: handleAddCloseDayError,
                });
            }

            function handleAddCloseDaySuccess(response) {
                if (response.success) {
                    let messageElement = document.createElement('p');
                    messageElement.innerHTML =
                        `Successfully add new close day, this page will automatically reload to apply any changes.`;
                    messageElement.classList.add('text-center');

                    swal({
                        title: "Success",
                        content: messageElement,
                        icon: 'success',
                        buttons: false,
                        timer: 5000,
                    }).then(() => location.reload());
                }
            }

            function handleAddCloseDayError(response) {
                if (response.status === 422) {
                    const errors = response.responseJSON.errors;
                    let messages = '';
                    Object.values(errors).forEach((error) => {
                        messages += `<li>${error}</li>`;
                    });
                    $('#add-close-day-error-message').html(messages);
                    $('#add-close-day-error-message').removeClass('d-none');
                } else if (response.status === 400) {
                    $('#add-close-day-error-message').html(response.responseJSON.message);
                    $('#add-close-day-error-message').removeClass('d-none');
                }
            }

            function handleEditCloseDayButtonClick(e) {
                const data = JSON.parse($(this).attr('data-src'));
                closeDayId = data.id;
                console.log(moment(data.start).format('YYYY-MM-DD'));
                $('#editStartDate').val(moment(data.start).format('YYYY-MM-DD'))
                $('#editEndDate').val(moment(data.end).format('YYYY-MM-DD'))
                $('.bs-edit-close-day-modal').modal('toggle');
            }

            function handleEditCloseDayFormSubmit(e) {
                e.preventDefault();
                const data = $(this).serialize();
                $.ajax({
                    url: `/admin/close/${closeDayId}`,
                    type: 'PUT',
                    data,
                    success: handleEditCloseDaySuccess,
                });
            }

            function handleEditCloseDaySuccess(response) {
                if (response.success) {
                    let messageElement = document.createElement('p');
                    messageElement.innerHTML =
                        `Successfully update the close day, this page will automatically reload to apply any changes.`;
                    messageElement.classList.add('text-center');
                    swal({
                        title: "Success",
                        content: messageElement,
                        icon: 'success',
                        type: "success",
                        buttons: false,
                        timer: 5000,
                    }).then(() => location.reload());
                }
            }

            function handleDeleteCloseDayButtonClick(e) {
                const id = $(this).attr('data-src');
                swal({
                    title: '',
                    icon: 'warning',
                    text: 'Do you want to remove this date?',
                    dangerMode: true,
                    buttons: ["No", "Yes"]
                }).then((confirmed) => {
                    if (confirmed) {
                        $.ajax({
                            url: `/admin/close/${id}`,
                            type: 'DELETE',
                            success: handleDeleteCloseDaySuccess,
                        });
                    }
                });
            }


            function handleDeleteCloseDaySuccess(response) {
                let messageElement = document.createElement('p');
                messageElement.innerHTML =
                    `Successfully delete the date, this page will automatically reload to apply any changes.`;
                messageElement.classList.add('text-center');
                swal({
                    title: "Success!",
                    content: messageElement,
                    icon: "success",
                    buttons: false,
                    timer: 5000,
                }).then(() => location.reload());
            }

            $('#btnCloseAddModal').click(function() {
                $('.bs-add-close-day-modal').modal('toggle');
            });

            $('#btnEditCloseDayModal').click(function() {
                $('.bs-edit-close-day-modal').modal('toggle');
            });
        </script>
    @endpush
@endsection
