@include('templates.header')

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a class="site_title text-center">
                            {{-- <i class="fas fa-hospital"></i> --}}
                            <span>{{ config('app.name') }}</span></a>
                    </div>

                    <div class="clearfix"></div>
                    @auth('patient')
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset(auth()->user()->profile) }}" alt="Patient Profile Image"
                                    class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2 class="text-capitalize">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                                </h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fas fa-home"></i> Appointments <span
                                                class="fas fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ route('appointment.create') }}">Set Appointment</a></li>
                                            <li><a href="{{ route('appointment.index') }}">View Appointments <span
                                                        class="badge">{{ App\Patient::getAppointments(Auth::user()->id)->appointments->count() }}
                                                    </span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fas fa-bars"></i></a>
                            </div>



                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ asset(auth()->user()->profile) }}" alt="">
                                        <span class="text-capitalize">
                                            {{ auth()->user()->firstname . ' ' . auth()->user()->middlename . ' ' . auth()->user()->lastname }}
                                        </span>
                                        <span class=" fas fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <a href="{{ route('account.settings') }}">
                                                <span>Account setting</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.auth.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out pull-right"></i>Logout</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('patient.auth.logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span
                                            class="badge bg-green">{{ is_null(request()->user()->info) ? '1' : '' }}</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        @if (is_null(request()->user()->info))
                                            <li>
                                                <a href="{{ route('account.settings') }}">
                                                    <span class="image"><i class="fa fa-user"></i></span>
                                                    <span>
                                                        <span>Incomplete profile</span>
                                                    </span>
                                                    <span class="message">
                                                        Please complete your profile to easily set an appointment.
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->
            @endauth

            @auth('admin')
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ asset(auth()->user()->profile) }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard </a>
                            </li>
                        </ul>
                        <ul class="nav side-menu">
                            <li><a><i class="fas fa-user-md"></i> Maintenance <span
                                        class="pull-right fas fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('doctor.index') }}">Doctors</a></li>
                                    <li><a href="{{ route('service.index') }}">Services</a></li>
                                    <li><a href="{{ route('patient.index') }}">Patients</a></li>
                                    <li><a href="{{ route('close.index') }}">Close days</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav side-menu">
                            <li><a><i class="fas fa-newspaper"></i> Reports <span
                                        class="pull-right fas fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('reports.index') }}">Generate Report</a></li>
                                    <li><a href="{{ route('reports.daily') }}">Daily Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset(auth()->user()->profile) }}" alt="">{{ Auth::user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{ route('admin.account.setting') }}"><i class="fas fa-profile"></i> Account
                                        Settings</a></li>
                                <li>
                                    <a href="{{ route('admin.auth.logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i>Logout</a>
                                </li>
                                <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-envelope"></i>
                                <span class="badge bg-green">{{ $noOfAppointmentsToday }}</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                @foreach ($appointmentsToday as $appointment)
                                    <li>
                                        <a href="/admin/doctor/{{ $appointment->doctor_id }}">
                                            <span class="image"><img
                                                    src="{{ $appointment->patients[0]->profile }}"></span>
                                            <span>
                                                <span><b>{{ $appointment->patients[0]->firstname }}
                                                        {{ $appointment->patients[0]->middlename }}
                                                        {{ $appointment->patients[0]->lastname }}</b></span>
                                                {{-- <span class="time">3 mins ago</span> --}}
                                            </span>
                                            <span class="message">
                                                Have an appointment at
                                                <b>{{ $appointment->start_date->format('h:i:s A') }}</b> -
                                                <b>{{ $appointment->end_date->format('h:i:s A') }}</b> to
                                                {{ $appointment->doctor->title }} {{ $appointment->doctor->fullname }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
    @endauth
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>@yield('title')</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            @yield('content')
        </div>
    </div>
    <!-- /page content -->


    @include('templates.footer')
