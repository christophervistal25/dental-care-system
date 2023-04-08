@extends('admin.layouts.app')
@section('page-title', 'Dashboard')
@section('content')
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xxl-3">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">doctors</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center">{{ $doctorsCount }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="chart chart-sm">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <span
                            class="f-w-7 f-h-7 p-2 bg-success-faded text-success rounded-circle d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                        </span>

                        <a href="{{ route('doctor.index') }}">
                            <span class="fw-bold text-success fs-9 ms-2">Click this to view</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Number Orders Widget-->

        <!-- Average Orders Widget-->
        <div class="col-12 col-sm-6 col-xxl-3">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">patients</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center">{{ $patientsCount }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="chart chart-sm">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span
                                class="f-w-7 f-h-7 p-2 bg-success-faded text-success rounded-circle d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                </svg>
                            </span>

                            <a href="{{ route('patient.index') }}">
                                <span class="fw-bold text-success fs-9 ms-2">Click this to view</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Average Orders Widget-->

        <!-- Pageviews Widget-->
        <div class="col-12 col-sm-6 col-xxl-3">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">Services</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold">{{ $services }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="chart chart-sm">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span
                                class="f-w-7 f-h-7 p-2 bg-success-faded text-success rounded-circle d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                </svg>
                            </span>

                            <a href="{{ route('service.index') }}">
                                <span class="fw-bold text-success fs-9 ms-2">Click this to view</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Pageviews Widget-->

        <!-- Number Refunds Widget-->
        <div class="col-12 col-sm-6 col-xxl-3">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">Close Days</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center">{{ $closeDaysCount }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="chart chart-sm">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <span
                            class="f-w-7 f-h-7 p-2 bg-success-faded text-success rounded-circle d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                        </span>

                        <a href="{{ route('close.index') }}">
                            <span class="fw-bold text-success fs-9 ms-2">Click this to view</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Number Refunds Widget-->
    </div>

    <div class="card mt-3">
        <div class="card-header fw-bold">
            Doctors who have an appointment scheduled for today
        </div>
        <div class="card-body">

            <table class="table table-striped border" id="datatable">
                <thead>
                    <tr>
                        <th class="text-dark border text-center">Doctor's fullname</th>
                        <th class="text-center text-dark border">No. of appointments</th>
                        <th class="text-center text-dark border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $doctor)
                        <tr>
                            <td class="border text-start">
                                <span class="mx-5 fw-bold">
                                    {{ $doctor->title }} {{ Str::ucfirst($doctor->firstname) . ' ' . Str::ucfirst($doctor->lastname) }}
                                </span>
                            </td>
                            <td class="text-center border"><strong> <span
                                        class="badge bg-primary">{{ $doctor->appointments_count }}</span></strong></td>
                            <td class="text-center border"> <a style="text-decoration: underline;"
                                    href="/admin/doctor/{{ $doctor->id }}">View
                                    {{ $doctor->appointments_count }}
                                    Appointments</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="3"><strong>No data
                                    available</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
