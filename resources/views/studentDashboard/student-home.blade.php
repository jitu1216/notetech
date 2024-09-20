@extends('studentDashboard.layouts.master')
@section('content')
    <style>
        .owl-carousel {
            position: relative;
            /* To position arrows relative to the carousel */
        }

        /* Custom styles for navigation arrows */
        .owl-nav {
            position: absolute;
            /* Position arrows absolutely */
            top: 55%;
            /* Center vertically */
            width: 100%;
            /* Full width to position arrows */
            display: flex;
            /* Flex container for positioning arrows */
            justify-content: space-between;
            /* Space out arrows */
            transform: translateY(-50%);
            /* Adjust for vertical centering */
        }

        .owl-nav .owl-prev,
        .owl-nav .owl-next {
            background-color: #fff;
            color: #ffffff;
            line-height: 100px;
            text-align: center;
            border-radius: 50%;
            font-size: 30px;
            cursor: pointer;
            z-index: 10;
            transition: none;
        }

        .owl-nav .owl-prev,
        .owl-nav .owl-next:hover {
            background-color: #fff;
            /* Arrow background color */

        }

        .owl-nav .owl-prev {
            left: 10px;
            /* Position left arrow */
        }

        .owl-nav .owl-next {
            right: 10px;
            /* Position right arrow */
        }

        .owl-nav .owl-next span,
        .owl-prev span {
            font-size: 50px;
            margin: 5px;
        }

        .background-image {
            background-size: cover;
            background-position: center;
            aspect-ratio: 16 / 6.5 !important;
            display: flex;
            align-items: center;
            position: relative;
            justify-content: center;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .background-image img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            text-align: center;
            color: white;
            /* Adjust text color if needed */
        }
    </style>
    <div class="owl-carousel owl-theme">

        @foreach ($slider as $slideritem)
            <div class="item ">
                <div class="background-image">
                    <img src="{{ asset('slider/' . $slideritem->upload) }}" alt="slider image">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white">{{ $slideritem->title }}</h1>
                        <h2 class="text-white">{{ $slideritem->subtitle }}</h2>
                        <p class="text-white">{{ $slideritem->description }}</p>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="page-wrapper" style="margin: 0px; padding-top:10px;">
        <div class="content container-fluid">
            <div class="row">
                <div class="db-info">
                    <h4>Student Info</h4>
                </div>
                <div class="col-xl-4 col-sm-4 col-12 d-flex">
                    <div class="card bg-comman w-100"
                        style="background-image: linear-gradient(to right, rgb(15, 240, 27), rgb(27, 116, 0));">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6 style="color: yellow;">Student Name</h6>
                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Auth::guard('student')->User()->student_name }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate" style="font-size: 50px; color:white;"></i>
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
                                    <h6 style="color: rgb(255, 255, 10);">Class</h6>
                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Custom::getClass(Auth::guard('student')->User()->class_id)->classname }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-book-reader" style="font-size: 50px; color:white;"></i>
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
                                    <h6 style="color: yellow;">Class Teacher</h6>
                                    <h3 style="color: rgb(255, 255, 255);">{{ Custom::getclassTeacher() }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-chalkboard-teacher" style="font-size: 50px; color:white;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Custom::getStudentTotalFees() - Custom::getStudentDepositeFees() }}</h3>
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
                                    <h3 style="color: rgb(255, 255, 255);">220</h3>
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

                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Custom::getStudentAttendance()->where('attendance_type', 'P')->count() }}</h3>

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
                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ Custom::getStudentAttendance()->where('attendance_type', 'A')->count() }}</h3>
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

                                    <h3 style="color: rgb(255, 255, 255);">
                                        {{ 220 - Custom::getStudentAttendance()->count() }}</h3>

                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::schoototalpaidfees() --}}</h3>

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

                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::classtotalpaidfees() --}}</h3>

                                    <h3 style="color: rgb(255, 255, 255);">{{-- Custom::schoototalpaidfees() --}}</h3>

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

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            // animateOut: 'fadeOut',
            // animateIn: 'flipInX',
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
@endsection
