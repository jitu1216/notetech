@extends('school.layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{ Session::get('name') }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ Session::get('name') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(15, 240, 27), rgb(27, 116, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Approved Students</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getApprovedStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(216, 195, 6), rgb(172, 154, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: rgb(255, 255, 10);">Pending Students</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getpendingStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-users" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 67, 54), rgb(185, 6, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Rejected Students</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getrejectedStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-graduation-cap" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(54, 253, 203), rgb(0, 132, 185));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Staff</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getStaff() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 54, 193), rgb(185, 0, 92));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Fees</h6>
                                    @if (Custom::getStaffRole() == 'Assistant Teacher')
                                        <h3 style="color: rgb(255, 255, 255);">{{ Custom::classtotalfees() }}</h3>
                                    @else
                                        <h3 style="color: rgb(255, 255, 255);">{{ Custom::schoototalfees() }}</h3>
                                    @endif
                                </div>
                                <div>
                                    <i class="fas fa-dollar-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(96, 149, 248), rgb(3, 59, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Today Collected Fees</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::todayfees() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-money-bill-alt" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(121, 39, 252), rgb(72, 3, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Paid Fees</h6>
                                    @if (Custom::getStaffRole() == 'Assistant Teacher')
                                        <h3 style="color: rgb(255, 255, 255);">{{ Custom::classtotalpaidfees() }}</h3>
                                    @else
                                        <h3 style="color: rgb(255, 255, 255);">{{ Custom::schoototalpaidfees() }}</h3>
                                    @endif
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 19, 242), rgb(165, 10, 30));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Pending Fees</h6>
                                    @if (Custom::getStaffRole() == 'Assistant Teacher')
                                    <h3 style="color: rgb(255, 255, 255);">
                                    {{ Custom::classtotalfees() - Custom::classtotalpaidfees()}} </h3>
                                    @else
                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Custom::schoototalfees() - Custom::schoototalpaidfees() }}</h3>
                                    @endif

                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(15, 240, 27), rgb(27, 116, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Student</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getApprovedStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(216, 195, 6), rgb(172, 154, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: rgb(255, 255, 10);">Today Present Students</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{Custom::getTodayAttendance()->where('attendance_type', 'P')->count() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-users" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 67, 54), rgb(185, 6, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Today Absent Students</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{Custom::getTodayAttendance()->where('attendance_type', 'A')->count() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-graduation-cap" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(54, 253, 203), rgb(0, 132, 185));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Today Student Attendance Pending</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getApprovedStudent() - Custom::getTodayAttendance()->count() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-lg-4">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Overview</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Teacher</li>
                                        <li><span class="circle-green"></span>Student</li>
                                        <li class="star-menus"><a href="javascript:;"><i
                                                    class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apexcharts-area"></div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-4">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Number of Students</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Girls</li>
                                        <li><span class="circle-green"></span>Boys</li>
                                        <li class="star-menus"><a href="javascript:;"><i
                                                    class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="bar"></div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 col-lg-4">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Overview</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Teacher</li>
                                        <li><span class="circle-green"></span>Student</li>
                                        <li class="star-menus"><a href="javascript:;"><i
                                                    class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apexcharts-area-new"></div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-12 d-flex">

                    <div class="card flex-fill student-space comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">Student List</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            {{-- <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox"
                                                    value="something">
                                            </div>
                                        </th> --}}
            {{-- <th>S.No.</th>
                                            <th>Logo</th> --}}
            {{-- <th>UserCode</th> --}}
            {{-- <th>Student Name</th> --}}
            {{-- <th>Account Start Date</th>
                                            <th>Account Expiry Date</th> --}}
            {{-- <th>User Name</th> --}}
            {{-- <th>Email</th> --}}
            {{-- <th>Mobile No.</th>
                                            <th>Address</th>
                                            <th>Action</th> --}}
            {{-- </tr>
                                    </thead>
                                    <tbody> --}}

            {{-- @foreach ($schoolList as $key => $value) --}}
            {{-- <tr> --}}

            {{-- <td>{{ ++$key }}</td> --}}
            {{-- <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::to('images') . '/' . $value->Logo }}"
                                                                alt="Logo" width="10" height="10"></a>
                                                    </h2>
                                                </td> --}}
            {{-- <td>{{ $value->UserCode }}</td> --}}
            {{-- <td>{{ $value->Name }}</td> --}}
            {{-- <td>{{ $value->Start_Date }}</td> --}}
            {{-- <td style="color:red;">{{ $value->Expiry_Date }}</td> --}}
            {{-- <td>{{ $value->Username }}</td> --}}
            {{-- <td>{{ $value->Email }}</td> --}}
            {{-- <td>{{ $value->Mobile }}</td>
                                                <td>{{ $value->Address }}</td>
                                                <td class="text-end"> --}}
            {{-- <div class="actions "> --}}
            {{-- <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "  style="background-color: rgb(5, 136, 197) !important; color:white !important;">
                                                            <i class="feather-eye"></i>
                                                        </a> --}}
            {{-- <a href="{{ route('updateSchool') . '/' . $value->id }}"
                                                            class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                            <i class="feather-edit"></i>
                                                        </a> --}}
            {{-- <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                            style="background-color: rgb(197, 0, 0) !important; color:white !important;">
                                                            <i data-src="{{ URL::to('images') . '/' . $value->Logo }}"
                                                                data-id="{{ $value->id }}"
                                                                data-name="{{ $value->Name }}"class="feather-trash-2 school_delete"></i>
                                                        </a> --}}
            {{-- <a href="javascript:;" class="btn btn-sm bg-success-light me-2"
                                                            style="background-color: rgb(67, 18, 245) !important; color:white !important;">
                                                            <i class="feather-log-in"></i> --}}
            {{-- </a>
                                                    </div>
                                                </td>
                                            </tr> --}}
            {{-- @endforeach --}}


            {{-- </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> --}}
            {{-- <div class="col-xl-6 d-flex">

                    <div class="card flex-fill comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title ">Student Activity </h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="activity-groups">
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="assets/img/icons/award-icon-01.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>1st place in "Chess”</h4>
                                        <h5>John Doe won 1st place in "Chess"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>1 Day ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="assets/img/icons/award-icon-02.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Participated in "Carrom"</h4>
                                        <h5>Justin Lee participated in "Carrom"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>2 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="assets/img/icons/award-icon-03.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Internation conference in "St.John School"</h4>
                                        <h5>Justin Leeattended internation conference in "St.John School"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>2 Week ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards mb-0">
                                    <div class="award-boxs">
                                        <img src="assets/img/icons/award-icon-04.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Won 1st place in "Chess"</h4>
                                        <h5>John Doe won 1st place in "Chess"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>3 Day ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
            {{-- </div> --}}

            {{-- <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill fb sm-box">
                        <div class="social-likes">
                            <p>Like us on facebook</p>
                            <h6>50,095</h6>
                        </div>
                        <div class="social-boxs">
                            <img src="assets/img/icons/social-icon-01.svg" alt="Social Icon">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill twitter sm-box">
                        <div class="social-likes">
                            <p>Follow us on twitter</p>
                            <h6>48,596</h6>
                        </div>
                        <div class="social-boxs">
                            <img src="assets/img/icons/social-icon-02.svg" alt="Social Icon">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill insta sm-box">
                        <div class="social-likes">
                            <p>Follow us on instagram</p>
                            <h6>52,085</h6>
                        </div>
                        <div class="social-boxs">
                            <img src="assets/img/icons/social-icon-03.svg" alt="Social Icon">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card flex-fill linkedin sm-box">
                        <div class="social-likes">
                            <p>Follow us on linkedin</p>
                            <h6>69,050</h6>
                        </div>
                        <div class="social-boxs">
                            <img src="assets/img/icons/social-icon-04.svg" alt="Social Icon">
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        $(document).ready(function() {



            if ($('#apexcharts-area-new').length > 0) {
                var options = {
                    chart: {
                        height: 350,
                        type: "line",
                        toolbar: {
                            show: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: "smooth"
                    },
                    series: [{
                        name: "Teachers",
                        color: '#3D5EE1',
                        data: [25, 60, 75, 51, 42, 42, 70]
                    }, {
                        name: "Students",
                        color: '#70C4CF',
                        data: [24, 48, 56, 32, 34, 52, 25]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    }
                }
                var chart = new ApexCharts(document.querySelector("#apexcharts-area-new"), options);
                chart.render();
            }

            if ($('#apexcharts-area').length > 0) {
                var options = {
                    chart: {
                        height: 350,
                        type: "line",
                        toolbar: {
                            show: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: "smooth"
                    },
                    series: [{
                        name: "Teachers",
                        color: '#3D5EE1',
                        data: [25, 60, 75, 51, 42, 42, 70]
                    }, {
                        name: "Students",
                        color: '#70C4CF',
                        data: [24, 48, 56, 32, 34, 52, 25]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    }
                }
                var chart = new ApexCharts(document.querySelector("#apexcharts-area"), options);
                chart.render();
            }
        });
    </script>
@endsection
