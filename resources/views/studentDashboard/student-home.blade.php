@extends('studentDashboard.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="row">
                <div class="db-info">
                   <h4>Fees Status</h4>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(15, 240, 27), rgb(27, 116, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Fees</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getStudentTotalFees() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-dollar-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(216, 195, 6), rgb(172, 154, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: rgb(255, 255, 10);">Total Deposit Fees</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getStudentDepositeFees() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 67, 54), rgb(185, 6, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Pending Fees</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{Custom::getStudentTotalFees() - Custom::getStudentDepositeFees() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="db-info">
                    <figcaption class="blockquote-footer">
                        Back Fees Status
                      </figcaption>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(15, 240, 27), rgb(27, 116, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Back Fees</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getApprovedStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(216, 195, 6), rgb(172, 154, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: rgb(255, 255, 10);">Total Back Fees Deposit</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getpendingStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right,  rgb(253, 67, 54), rgb(185, 6, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: rgb(255, 255, 10);">Total Back Fees Pending</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getpendingStudent() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-rupee-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="db-info">
                    <h4>Attendance Status</h4>
                </div>
                <div class="col-xl-3 col-sm-3 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(54, 253, 203), rgb(0, 132, 185));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Attendance</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::getStaff() --}}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-3 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 54, 193), rgb(185, 0, 92));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Present</h6>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalfees() --}}</h3>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::schoototalfees() --}}</h3>

                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-3 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(96, 149, 248), rgb(3, 59, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Absent</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::todayfees() --}}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-3 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(121, 39, 252), rgb(72, 3, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Total Pending Attendance</h6>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalpaidfees()--}}</h3>

                                        <h3 style="color: rgb(255, 255, 255);">{{--Custom::schoototalpaidfees() --}}</h3>

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
                <div class="db-info">
                      <div class="db-info">
                        <h4> More Information</h4>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(54, 253, 203), rgb(0, 132, 185));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Test Marks</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::getStaff() --}}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-table" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 54, 193), rgb(185, 0, 92));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Class Teacher</h6>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalfees() --}}</h3>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::schoototalfees() --}}</h3>

                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(96, 149, 248), rgb(3, 59, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Staff</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::todayfees() --}}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(54, 253, 203), rgb(0, 132, 185));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Intitute Rules</h6>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalpaidfees()--}}</h3>

                                        <h3 style="color: rgb(255, 255, 255);">{{--Custom::schoototalpaidfees() --}}</h3>

                                </div>
                                <div>
                                    <i class="fas fa-book" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(253, 54, 193), rgb(185, 0, 92));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Transport Fees Info</h6>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalfees() --}}</h3>

                                        <h3 style="color: rgb(255, 255, 255);">{{-- Custom::schoototalfees() --}}</h3>

                                </div>
                                <div>
                                    <i class="fas fa-dollar-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(96, 149, 248), rgb(3, 59, 163));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Hostel Fees Info</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::todayfees() --}}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-dollar-sign" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         </div>
    </div>
@endsection
