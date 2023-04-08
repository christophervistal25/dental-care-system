@extends('admin.layouts.app')
@section('page-title', 'List of Service')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endprepend
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between align-items-center">
                <span class="fw-bold">Complete Listing of Services</span>
                <div>
                    <button class="btn btn-primary" id="btnAddService">Add Service</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border" id="datatable">
                        <thead>
                            <tr>
                                <td class="border">Name</td>
                                <td class="border">Price</td>
                                <td class="text-center">Per Each</td>
                                <td class="text-center border">Service Duration</td>
                                <td class="text-center border">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td class="border">
                                        <span class="mx-3">
                                            {{ $service->name }}
                                        </span>
                                    </td>
                                    <td class="border text-center"><b>{{ $service->price }}</b></td>
                                    <td class="text-center border">
                                        <span
                                            @class([
                                                'badge',
                                                'bg-success' => $service->per_each == 1,
                                                'bg-primary' => $service->per_each == 0,
                                            ])><b>{{ $service->per_each ? 'Yes' : 'No' }}</b></span>
                                    </td>
                                    <td class="border text-center"><b>{{ $service->duration }}</b></td>
                                    <td class="border text-center">
                                        <button class="btn btn-success btn-sm btn-edit-service text-white"
                                            data-src="{{ $service }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-delete-service text-white"
                                            data-src="{{ $service }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <!-- Add Service modal -->
    <div class="modal fade bs-add-service-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="AddService">Add Service</h4>
                </div>
                <form id="addServiceForm">
                    <div class="modal-body">
                        <div class="alert alert-danger d-none" id="add-service-error-message"></div>
                        <div class="form-group">
                            <label for="serviceName">Service Name</label>
                            <input type="text" id="serviceName" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="servicePrice">Service Price</label>
                            <input type="number" id="servicePrice" class="form-control" name="price">
                        </div>

                        <div class="form-group">
                            <label for="duration">Service Hour/s</label>
                            <select name="duration" id="duration" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="isServicePerEach">Price per each</label>
                            <select name="per_each" id="isServicePerEach" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            id="btnAddModalClose">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Service -->


    <!-- Edit Service modal -->
    <div class="modal fade bs-edit-service-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="EditService">Edit Service</h4>
                </div>
                <form id="editServiceForm">
                    <div class="modal-body">
                        <div class="alert alert-danger d-none" id="edit-service-error-message"></div>
                        <div class="form-group">
                            <label for="editServiceName">Service Name</label>
                            <input type="text" id="editServiceName" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="editServicePrice">Service Price</label>
                            <input type="number" id="editServicePrice" class="form-control" name="price">
                        </div>

                        <div class="form-group">
                            <label for="editDuration">Service Hour/s</label>
                            <select name="duration" id="editDuration" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editIsServicePerEach">Price per each</label>
                            <select name="per_each" id="editIsServicePerEach" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            id="btnCloseEditModal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Service -->

    @push('page-scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
        <script>
            let serviceId;

            $('#btnAddService').click(function(e) {
                $('.bs-add-service-modal').modal('toggle');
            });

            $('#addServiceForm').submit(function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    url: '/admin/service',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            let message = document.createElement('p');
                            message.innerHTML =
                                `Successfully save all the changes, this will page automatically reload to apply any changes.`;
                            message.classList.add('text-center');
                            message.classList.add('fw-medium');
                            swal({
                                title: 'Well Done!',
                                content : message,
                                icon: 'success',
                                timer: 5000,
                                button: false,
                            }).then(() => location.reload());
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let messages = "";
                            Object.values(errors).forEach((error) => {
                                messages += `<li class="mx-3">${error}</li>`;
                            });
                            $('#add-service-error-message').html(messages);
                            $('#add-service-error-message').removeClass('d-none');
                        }
                    }
                })
            });

            $('.btn-edit-service').click(function(e) {
                let service = JSON.parse($(this).attr('data-src'));
                serviceId = service.id;
                $('#editServiceName').val(service.name);
                $('#editServicePrice').val(service.price);
                $('#editIsServicePerEach').val(service.per_each);
                $('#editDuration').val(service.duration);
                $('.bs-edit-service-modal').modal('toggle');
            });

            $('#editServiceForm').submit(function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    url: `/admin/service/${serviceId}`,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            let message = document.createElement('p');
                            message.innerHTML =
                                `Successfully save all the changes, this will page automatically reload to apply any changes.`;
                            message.classList.add('text-center');
                            message.classList.add('fw-medium');
                            swal({
                                title: 'Well Done!',
                                content: message,
                                icon: 'success',
                                timer: 5000,
                                button: false,
                            }).then(() => location.reload());
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let messages = "";
                            Object.values(errors).forEach((error) => {
                                messages += `<li class="mx-3">${error}</li>`;
                            });
                            $('#edit-service-error-message').html(messages);
                            $('#edit-service-error-message').removeClass('d-none');
                        }
                    }
                })
            });

            $('.btn-delete-service').click(function(e) {
                let service = JSON.parse($(this).attr('data-src'));

                swal({
                    title: "Are you sure?",
                    text: "This service will be deleted!",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: `/admin/service/${service.id}`,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    let message = document.createElement('p');
                                    message.innerHTML = `Service deleted successfully, this page will automatically refresh to apply all the changes`;
                                    message.classList.add('text-center');
                                    message.classList.add('fw-medium');
                                    message.classList.add('mt-3');

                                    swal({
                                        title: 'Well Done!',
                                        content: message,
                                        icon: 'success',
                                        timer: 5000,
                                        buttons: false,
                                    }).then(() => location.reload());
                                }
                            }
                        })
                    }
                });


            });

            $('#btnAddModalClose').click(function() {
                $('.bs-add-service-modal').modal('toggle');
            });

            $('#btnCloseEditModal').click(function() {
                $('.bs-edit-service-modal').modal('toggle');
            });
        </script>
    @endpush
@endsection
