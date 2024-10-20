<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/logo.jpeg') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
     <!-- Owl Carousel CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     <link rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
      <!-- Owl Carousel JS -->
      <script src="{{ URL::to('assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>



</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left w-50">
                <span class="user-img">
                    <a href="{{ route('school') }}" class="logo">
                        <img class="rounded-circle" src="{{ URL::to('images') . '/' . Custom::getSchool()->Logo }}"
                            alt="Logo">
                    </a>
                </span>
                <div class="row">
                    <div class="col-12">
                        <h6 style="margin-left: 20px; margin-bottom:-12px;">{{ Custom::getSchool()->Name }}</h6>
                    </div>
                    <div class="col-12">
                        <p style="margin-left: 20px; margin-top:10px; margin-bottom:-6px; font-size:12px;">
                            {{ Custom::getSchool()->Address . ' ' . Custom::getSchool()->City . ' (' . Custom::getSchool()->State . ')' }}
                        </p>
                    </div>
                </div>
                {{-- <a href="{{ route('school') }}" class="logo logo-small">
                    <img src="{{ URL::to('assets/img/avtar.jpg') }}" alt="Logo" width="180" height="180">
                </a> --}}
            </div>
            {{-- <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div> --}}

            {{-- <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div> --}}
            {{-- <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a> --}}
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <div class="user-text">
                                <h6>Session Year</h6>
                                <p class="text-muted mb-0">{{ Session::get('academic_session') }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        {{ Custom::academicSession() }}
                        @foreach (Session::get('all_academic_session') as $value)
                            <a class="dropdown-item"
                                href="{{ route('changesession') . '/' . $value->session_date }}">{{ $value->session_date }}</a>
                        @endforeach
                    </div>
                </li>
                @if (Custom::checkProfile(Custom::getUser()->id) == 1)
                    @if (Route::current()->getName() != 'schoolprofile')
                        <script>
                            window.location.href = "{{ route('schoolprofile') }}";
                        </script>
                    @endif
                @endif


                {{-- <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <img src="assets/img/icons/header-icon-05.svg" alt="">
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="assets/img/profiles/avatar-02.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                    approved <span class="noti-title">your estimate</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-11.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">International Software Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-17.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone XR</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-13.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Mercury Software Inc</span> added a new product <span class="noti-title">Apple MacBook Pro</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li> --}}

                {{-- <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="assets/img/icons/header-icon-04.svg" alt="">
                    </a>
                </li> --}}

                <li class="nav-item dropdown has-arrow new-user-menus">

                    @if (Custom::getUser()->role_name == 'School')
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle"
                                    src="{{ URL::to('images') . '/' . Custom::getSchool()->Logo }}"
                                    width="31"alt="{{ Session::get('name') }}">
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Custom::getSchool()->Usertype }}</p>
                                </div>
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ URL::to('images') . '/' . Custom::getSchool()->Logo }}"
                                        alt="{{ Session::get('name') }}" class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Custom::getSchool()->Usertype }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('schoolprofile') }}">My Profile</a>
                            {{-- <a class="dropdown-item" href="inbox.html">Inbox</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    @elseif (Custom::getUser()->role_name == 'Super Admin')
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="{{ URL::to('assets/img/avtar.jpg') }}"
                                    width="31"alt="{{ Session::get('name') }}">
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                                </div>
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ URL::to('assets/img/avtar.jpg') }}" alt="{{ Session::get('name') }}"
                                        class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('schoolprofile') }}">My Profile</a>
                            {{-- <a class="dropdown-item" href="inbox.html">Inbox</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        @elseif (Custom::getUser()->role_name == 'Staff')
                            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                <span class="user-img">
                                    <img class="rounded-circle"
                                        src="{{ URL::to('images') . '/' . Custom::getStaffDetail()->image }}"
                                        width="31"alt="{{ Session::get('name') }}">
                                    <div class="user-text">
                                        <h6>{{ Session::get('name') }}</h6>
                                        <p class="text-muted mb-0">
                                            {{ Custom::getStaffDetail()->appointment_position }}</p>
                                    </div>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ URL::to('images') . '/' . Custom::getStaffDetail()->image }}"
                                            alt="{{ Session::get('name') }}" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>{{ Session::get('name') }}</h6>
                                        <p class="text-muted mb-0">
                                            {{ Custom::getStaffDetail()->appointment_position }}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ route('schoolprofile') }}">My Profile</a>
                                {{-- <a class="dropdown-item" href="inbox.html">Inbox</a> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    @endif

                </li>
            </ul>
        </div>



        <div class="modal fade contentmodal" id="popupbox" tabindex="-3" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content doctor-profile">
                    <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="feather-x-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="{{ route('deletestudent') }}" method="POST">
                            @csrf
                            <div class="delete-wrap text-center">
                                {{-- <div class="del-icon">
                                    <i class="feather-x-circle"></i>
                                </div> --}}
                                <input type="hidden" name="id" class="id" value="">
                                <h6 style="color:rgb(107, 107, 107)">You are Not Authorized to View This Page ?</h6>
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-12">
                                        <a href="https://www.freeiconspng.com/img/25253"
                                            title="Image from freeiconspng.com"><img
                                                src="https://www.freeiconspng.com/uploads/round-error-icon-16.jpg"
                                                width="50" height="50" alt="round error icon" /></a>
                                    </div>
                                    <div class="col-md-8 mt-2">
                                        <h5 class="name text-left">Please Contact your Admin !</h5>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    {{-- <button type="submit" class="btn btn-success me-2">Yes</button> --}}
                                    {{-- <a class="btn btn-danger" data-bs-dismiss="modal">No</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- side bar --}}
        @include('school.sidebar.sidebar')
        {{-- content page --}}
        @yield('content')
        <footer class="mt-4">
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="avatar avatar-sm subject">
                    <img src="{{ URL::to('assets/img/avtar.jpg') }}" alt="{{ Session::get('name') }}"
                        class="avatar-img rounded-circle" style="height:30px; width:30px; margin-top:5px;">
                </div>
                <p style="margin-left:10px;">Copyright © 2023 NoteTech Software Company</p>
            </div>

        </footer>

    </div>


    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ URL::to('assets/js/calander.js') }}"></script>
    <script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>

    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <script>
        $('.popup').on('click', function() {
            $('#popupbox').modal('show');
        });
    </script>
    @yield('script')
</body>

</html>
