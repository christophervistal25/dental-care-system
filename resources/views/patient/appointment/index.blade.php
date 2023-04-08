@extends('patient.layouts.app')
@section('page-title', 'List of your appointments')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endprepend
@section('content')
    @if (Session::has('status'))
        <div class="alert alert-success" role='alert'>
            {{ Session::get('status') }}
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            You can only cancel an appointment 5 minutes before the scheduled time.
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <span class="fw-bold">
                Complete Listing of your appointments
            </span>
        </div>
        <div class="card-body">
            <a class="btn btn-primary float-end mb-2" href="{{ route('appointment.create') }}">Set new Appointment</a>
            <div class="clearfix"></div>
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th class="text-dark">Service</th>
                        <th class="text-dark">Service Fee</th>
                        <th class="text-dark">Service Duration</th>
                        <th class="text-dark">Doctor</th>
                        <th class="text-dark">Date</th>
                        <th class="text-center text-dark">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patient->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->service->price }}</td>
                            <td class="text-center">{{ $appointment->start_date->diffInHours($appointment->end_date) }} Hour/s</td>
                            <td>{{ $appointment->doctor->title . ' ' . ucfirst($appointment->doctor->firstname) . ' ' . ucfirst($appointment->doctor->lastname) }}
                            </td>
                            <td class="text-center">
                                <b>{{ $appointment->start_date->format('l jS \\of F Y h:i A') . ' to ' . $appointment->end_date->format('h:i A') }}</b>
                            </td>
                            <td class="text-center">
                                <a href="/patient/appointment/confirmation/{{ $appointment->id }}"
                                    class="btn btn-primary">Print confirmation</a>
                                <a href="/patient/appointment/{{ $appointment->id }}/edit"
                                    class="btn btn-success text-white">Reschedule</a>
                                @if ($appointment->pivot->created_at->addMinutes(5) > \Carbon\Carbon::now())
                                    <a href="{{ route('appointment.cancel', [$appointment]) }}"
                                        class="btn btn-danger text-white">Cancel</a>
                                @endif
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
        <script>
            $("#datatable").DataTable({});
        </script>
    @endpush
@endsection
