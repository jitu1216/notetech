@extends('school.layouts.master')
<style>
    table {
        background-color: white;
    }

    .print-header {
        /* display: none; */
        margin-top: -30px !important;
    }

    .print-header h4 {
        text-align: center;
        margin-top: 10px;
    }

    .school {
        width: auto;
        display: flex;
        flex-direction: row;
    }

    .logo-container {
        flex: 2;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: right;
    }

    .main-container {
        flex: 8;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-left: -20px !important;
    }

    .main-container h3 {
        font-weight: 800 !important;
        margin-bottom: -2px;
        color: rgb(219, 0, 0);

    }

    .main-container h6 {
        margin-bottom: -2px;
        font-weight: 600 !important;
        color: blue;
    }

    .main-container span {
        font-size: 12px;
        color: black;
        margin-right: 10px;
    }

    .top {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .content {
        flex: 8;
        margin-top: 40px !important;
    }

    .student-image {
        flex: 2
    }

    .container-fluid {
        max-width: 900px !important;
    }

    .header-section {
        display: flex;
        flex-direction: row;
    }

    .header-section a {
        width: 100px;
        flex: 2;
    }

    #cancelbtn {
        flex: 2;
    }

    #extra {
        flex: 6;
    }

    #printbtn {
        flex: 2;
    }

    .content p {
        margin-left: 30px;
        margin-right: 60px;
    }

    @media only screen and (max-width: 450px) {

        .main-container {
            flex: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-container h3 {
            font-size: 16px;
        }

        .main-container h6 {
            font-size: 11px;
            margin-top: 2px;
        }

        .main-container p span {
            font-size: 9px;
        }

        .content p {
            font-size: 12px;
            margin: 0;
        }

    }



    @media print {

        .header-section {
            display: none !important;
        }

        .page-wrapper {
            margin-top: -80px !important;
        }

        .table {
            font-size: 10px;
        }

        .header {
            display: none;
        }

        nav {
            display: none;
        }

        .main-container h6 {
            margin-bottom: -3px;
            font-weight: 600 !important;
            color: rgb(67, 169, 253);
        }

        .main-container h3 {
            margin-bottom: -2px;
        }

        .print-header {
            display: inline !important;
        }

        .page-header,
        .action {
            display: none;
        }

        footer {
            display: none;
        }

    }
</style>
@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid border border-primary ">
            <div class="header-section">
                <a id="cancelbtn" href="{{ route('pendinglist') }}" class=" btn btn-primary"
                    style="margin-left:20px;">Cancel</a>
                <a id="extra" href="" class="" style="margin-left:20px;"></a>
                <a id="printbtn" href="" class=" btn btn-success" style="margin-left:20px;">Print</a>

            </div>

            <div class="print-header m-3">
                <div class="school">
                    <div class="logo-container">
                        <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="60" height="60">
                    </div>
                    <div class="main-container">
                        <h3>{{ Custom::getSchool()->Name }}</h3>
                        <h6>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                            ({{ Custom::getSchool()->State }})</h6>
                        {{-- <h6>Kainchu Tanda, Amaria Distt. Pilibhit (U.P.)-262121 Mob. 9411484111</h5> --}}
                        <p><span>Email.{{ Custom::getSchool()->Email }}</span> <span>Mobile No.
                                {{ Custom::getSchool()->Mobile }}</span>
                        </p>

                    </div>
                </div>
                <div class="top">
                    <div class="content">
                        <span style="color:rgb(207, 4, 4);">The Principle</span>
                        <h6>Madam/Sir,</h6>
                        <p style="">
                            I request you to admit my son/daughter/ to
                            class...........{{ $schoolclass->classname }}.............
                            of your school, The necessary particulars are given below.
                        </p>


                    </div>
                    <div class="student-image" style="margin-top: 70px;">
                        <img src="{{ URL::to('student-photos') . '/' . $student->image }}" alt="" width="100"
                            height="130">
                    </div>
                </div>
                <div class="middle-section">
                    <div class="application" style="margin-top: -30px;">
                        <div class="d-flex flex-row">
                            <h6 class="col-3" style="margin-left:0px; margin-right:-70px;"><span
                                    style="font-weight: 600;">Application No:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-2 text-center">
                                {{ $student->application_no }}
                            </h6>
                            <h6 class="col-3" style="margin-left:25px; margin-right:-20px;"><span
                                    style="font-weight: 600;">Application Date:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-2 text-center">
                                {{ $student->application_date }}
                            </h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="col-2"><span style="font-weight: 600;" >Student Name:</span></h6>
                            <h6 id="stdname" style="border-bottom:1px solid rgb(59, 59, 59); " class="col-7 text-center">
                                {{ $student->student_name }}
                            </h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="col-3" style="margin-left: 0px; margin-right:-40px;"><span
                                    style="font-weight: 600;">Class:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $schoolclass->classname }}
                            </h6>
                            <h6 class="col-3" style="margin-left: 30px; margin-right:-40px;"><span
                                    style="font-weight: 600;">Roll No:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->roll_no }}
                            </h6>

                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="col-3" style="margin-left:0px; margin-right:-70px;"><span
                                    style="font-weight: 600;">Date of Birth:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->dob }}
                            </h6>
                            <h6 class="col-3" style="margin-left:25px; margin-right:0px;"><span
                                    style="font-weight: 600;">Session Year:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ Session::get('academic_session') }}
                            </h6>
                        </div>

                    </div>
                    <div class="content-name">
                        <div class="d-flex flex-row">
                            <h6 class="col-2"><span style="font-weight: 600;">Father Name:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->father_name }}
                            </h6>
                            <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span
                                    style="font-weight: 600;">Mother Name:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-5 text-center">
                                {{ $student->mother_name }}
                            </h6>
                        </div>
                    </div>
                    <div class="content-name">
                        <div class="d-flex flex-row">
                            <h6 class="col-2"><span style="font-weight: 600;">Aadhar No.:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->aadhar_no }}
                            </h6>
                            <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span
                                    style="font-weight: 600;">Gender:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-5 text-center">
                                {{ $student->gender }}
                            </h6>
                        </div>
                    </div>
                    <div class="content-name">
                        <div class="d-flex flex-row">
                            <h6 class="col-3"><span style="font-weight: 600;">Address: Vill. & Locality</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->village }}
                            </h6>
                            <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span
                                    style="font-weight: 600;">Post/Town:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                                {{ $student->town }}
                            </h6>
                        </div>

                        <div class="d-flex flex-row">
                            <h6 class="col-1"><span style="font-weight: 600;">District</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->district }}
                            </h6>
                            <h6 class="col-1" style="margin-left: 0px; margin-right: -20px;"><span
                                    style="font-weight: 600;">State:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->state }}
                            </h6>
                            <h6 class="col-1" style="margin-left:20px; margin-right:0px;"><span
                                    style="font-weight: 600;">Pincode:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->pincode }}
                            </h6>
                        </div>

                    </div>
                    <div class="content-name">
                        <div class="d-flex flex-row">
                            <h6 class="col-1"><span style="font-weight: 600;">Nationality:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->nationality }}
                            </h6>
                            <h6 class="col-1" style="margin-left: 0px; margin-right: -20px;"><span
                                    style="font-weight: 600;">Caste:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->caste }}
                            </h6>
                            <h6 class="col-1" style="margin-left:20px; margin-right:0px;"><span
                                    style="font-weight: 600;">Religion:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                {{ $student->religion }}
                            </h6>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <h6 class="col-2" style="margin-left:0px; margin-right:-30px;"><span style="font-weight: 600;">Category:</span></h6>
                        <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-2 text-center">
                            {{ $student->category  }}
                        </h6>
                        <h6 class="col-4" style="margin-left: 25px; margin-right: 0px;"><span style="font-weight: 600;">Name of the last school attended:</span></h6>
                        <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                            {{ $student->last_institute }}
                        </h6>
                    </div>
                    <div class="content-name mt-3">
                        <h6 style="color: rgb(172, 0, 0) !important; padding:7px; background-color:rgb(189, 189, 189);">
                            Father/Mother Particulars</h6>
                    </div>
                    <div class="content-name mt-3">
                        <div class="d-flex flex-row">
                            <h6 class="col-2" style="margin-left:0px; margin-right: 0px;"><span style="font-weight: 600;">Name:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-10 text-center">
                                {{ $student->father_name  }}
                            </h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="col-2" style="margin-left:0px; margin-right: 0px;"><span style="font-weight: 600;">Profession:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-10 text-center">
                                {{ $student->father_occupation  }}
                            </h6>
                        </div>

                        <div class="d-flex flex-row">
                            <h6 class="col-2"><span style="font-weight: 600;">Mobile No:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                {{ $student->mobile }}
                            </h6>
                            <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span style="font-weight: 600;">Email:</span></h6>
                            <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-5 text-center">
                                {{ $student->email }}
                            </h6>
                        </div>
                    </div>
                    <div class="content-name mt-2">
                        <h6 style="color: rgb(172, 0, 0) !important; padding:7px; background-color:rgb(189, 189, 189);">
                            Subjects</h6>
                    </div>
                    <div class="content-name mt-1">
                        <h6 class="mt-2">
                             @php
                                $subject_array = (explode(",",$student->subject_id))
                            @endphp
                            @foreach ($subject as $key => $value)
                                    @if (in_array($value->id, $subject_array ))
                                    <span style="margin-right:40px;">({{ ++$key }}) {{ $value->subject_name }}</span>
                                    @endif

                            @endforeach
                        </h6>
                    </div>
                    <div class="content-name mt-3">
                        <h6><span style="font-weight: 600;">Declaration
                            </span></h6>
                        <p>I...................................Son/Daughter/Wife
                            of..................................R/O.......................... .My
                            Child.............................I swear by God. All the above information is true and I have
                            not got my child admitted in any school. My Child will follow the rules. If any error is found
                            in it.I will be resonsible for it.</p>
                        <span>Your Faithfully
                        </span>
                    </div>
                    <div class="content-name mt-3 pt-4">
                        <h6 class="mt-4"><span style="margin-right:30px; color:rgb(207, 4, 4)">Signature of
                                Parent/Guardian </span>
                            <span style="margin-right:30px; color:rgb(207, 4, 4)">Student's Sign & Thamb</span>
                            <span style="margin-right:30px; color:rgb(207, 4, 4)">Class Teacher</span>
                            <span style="margin-right:20px; color:rgb(207, 4, 4)">Clerk</span>
                            <span style="margin-left:30px; color:rgb(207, 4, 4)">Principal</span>


                    </div>

                </div>

            </div>
        </div>
    </div>
    <script>
        $('#printbtn').on('click', function() {
            event.preventDefault();
            var name = $('#stdname').text();
            document.title= name;
            window.print()
        });
    </script>
@endsection
