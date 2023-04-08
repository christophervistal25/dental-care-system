@extends('patient.layouts.app')
@section('page-title', 'List of your appointments')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endprepend
@section('content')
    @if (Session::has('status'))
        <div class="alert alert-success" role='alert'>
            {{ Session::get('status') }}
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Important Message!</h4>
            You are only allowed to cancel/reschedule your appointment within 5 minutes of creating it.
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <span class="fw-bold">
                Complete Listing of your appointments
            </span>
        </div>
        <div class="card-body">
            <div class="d-grid">
                <a class="btn btn-primary btn-block float-end mb-2" href="{{ route('appointment.create') }}">Set new
                    Appointment</a>
            </div>
            <div class="clearfix"></div>

            <table class="table table-bordered display nowrap" id="datatable" width="100%">
                <thead>
                    <tr>
                        <th class="text-dark">Service</th>
                        <th class="text-dark">Service Fee</th>
                        <th class="text-dark">Service Duration</th>
                        <th class="text-dark">Doctor</th>
                        <th class="text-center text-dark">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patient->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->service->price }}</td>
                            <td class="text-center">{{ $appointment->start_date->diffInHours($appointment->end_date) }}
                                Hour/s</td>
                            <td>{{ $appointment->doctor->title . ' ' . ucfirst($appointment->doctor->firstname) . ' ' . ucfirst($appointment->doctor->lastname) }}
                            </td>
                            <td class="text-center">
                                <a href="/patient/appointment/confirmation/{{ $appointment->id }}"
                                    class="btn btn-primary btn-sm">Print confirmation</a>
                                @if ($appointment->pivot->created_at->addMinutes(5) > now())
                                    <a href="/patient/appointment/{{ $appointment->id }}/edit"
                                        class="btn btn-success btn-sm text-white">Reschedule</a>
                                @endif
                                {{-- @if ($appointment->pivot->created_at->addMinutes(5) > now()) --}}
                                <button id="btnCancel" data-id="{{ $appointment->id }}"
                                    class="btn btn-danger btn-sm text-white">Cancel</button>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @push('page-scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script>
            $("#datatable").DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                lengthChange: false,
                responsive: true
            });

            $('#btnCancel').click(function() {
                let id = $(this).attr('data-id');
                let messageElement = document.createElement('p');
                messageElement.innerHTML = `Are you sure you want to cancel this appointment?`;
                messageElement.classList.add('text-center');
                messageElement.classList.add('fw-bold');
                swal({
                    title: "",
                    content: messageElement,
                    icon: "info",
                    buttons: ["No", "Yes"],
                }).then((isConfirmed) => {
                    if (isConfirmed) {
                        window.location.href = `/patient/appointment/cancel/${id}`;
                    }
                });
            });
        </script>
    @endpush
@endsection
