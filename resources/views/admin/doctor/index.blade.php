@extends('admin.layouts.app')
@section('page-title', 'List of Doctors')
@prepend('page-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endprepend
@section('content')
    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <span class="fw-bold">
                Complete listing of Doctors
            </span>
            <a class="btn btn-primary" href="{{ route('doctor.create') }}">Add Doctor</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th class="text-dark text-center border">ID</th>
                            <th class="text-dark text-center border">Fullname</th>
                            <th class="text-dark text-center border">Gender</th>
                            <th class="text-dark text-center border">Contact No.</th>
                            <th class="text-dark text-center border">Status</th>
                            <th class="text-dark text-center border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td class="text-dark text-center border">{{ $doctor->id }}</td>
                                <td class="text-start text-dark border">
                                    <span class="mx-5">
                                        <b>{{ $doctor->title . ' ' . $doctor->lastname . ', ' . $doctor->firstname }}</b>
                                    </span>
                                </td>
                                <td class="text-center text-uppercase text-dark border">
                                    {{ $doctor->gender }}
                                </td>
                                <td class="text-center text-uppercase text-dark border">
                                    {{ $doctor->contact_no }}
                                </td>
                                <td class="text-center text-uppercase text-dark border">
                                    {{ $doctor->active }}
                                </td>
                                <td class="text-center text-dark border">
                                    <a class="btn btn-success text-white btn-sm"
                                        href="{{ route('doctor.edit', $doctor) }}">Edit</a>
                                    <a href="{{ route('doctor.show', [$doctor]) }}"
                                        class="btn-sm btn btn-primary text-white">Appointments</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
@endsection
