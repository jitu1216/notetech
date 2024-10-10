@extends('school.layouts.master')
@section('content')
    <style>
        .table tr,
        th,
        td {
            border: solid black 1px;

        }



        .invalid {
            border: solid red 1px;
        }

        .table tr>th {
            font-size: 15px;
            font-weight: 500;
        }


        .container {
            padding: 20px;
            margin: 0px;
            max-width: 100%;
            width: 100%;
        }

        .main-row {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 0px;
            /* justify-content: center;
                                            align-items: center; */
        }

        .main-card {
            margin: 10px;
            margin-bottom: 10px;
            border: solid blue;
            background: white;
            position: relative;
            /* width: 70vw; */
        }

        .main-card .logobig {
            position: absolute;
            z-index: 15;
            height: 500px;
            width: 500px;
            top: 28%;
            left: 30%;
        }

        .main-body {
            margin: 15px;
            z-index: 20;
            opacity: 0.9;

        }

        .page-header {
            background-color: white;
            padding: 10px
        }

        .head {
            margin: 8px;
            text-align: center;
        }

        h5 {
            font-weight: 600 !important;
            font-size: 20px;
            margin-bottom: -2px;
            color: rgb(219, 0, 0);
        }

        p {
            font-size: 10px;
            color: blue;
            margin-right: 5px;
        }

        .title {
            font-weight: bold;
            font-size: 20px;
            padding: 25px;
            padding-bottom: 0px;
            padding-top: 12px;
            text-align: center;
        }

        .content {
            font-weight: 600;
            font-size: 15px;
            text-align: left;
            padding: 10px;
        }

        .page-wrapper {
            margin-top: 0px !important;
            min-height: 0px !important;


        }

        .showdate {
            color: black !important;
        }

        @media print {


            .container {
                padding: 0px;
                margin: 0px;
            }

            select {
                outline: none;
                border: none;
            }

            .main-body {
                margin: 0px;
                padding: 0px
            }

            .main-card {
                margin: 0px;
                padding: 0px;
            }

            .title {
                font-weight: bold;
                font-size: 15px;
                padding-bottom: 0px;
            }

            .table {
                font-size: 12px;
            }

            table tr td{
                widows: 20px !important;
            }


            .table input::placeholder {
                color: transparent;

            }

            .header-section {
                display: none !important;
            }

            .page-wrapper {
                margin-top: 0px !important;
                min-height: 0px;

            }

            input[type="date"]::placeholder {
                color: transparent;
                /* Make the placeholder text transparent */
            }

            input[type="date"] {
                color: transparent;
                border: none;
                outline: none;
            }

            .form-control {
                border: solid white 1px;
                height: 30px;
            }

            .header {
                display: none;
            }

            nav {
                display: none;
            }

            .sel {
                display: none;
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

            .nodate{
                color: transparent;
            }


            .table>:not(caption)>*>* {
                padding: 7px 12px;
            }

        }
    </style>
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row p-4 align-item-center">
                    <div class="col ">
                        <h3>Transfer Certificate</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="">T.C.</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="search-student-btn">
                        <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:0px;">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('store_tc') }}" method="post">
            @csrf
            <div class="main-row">

                <div class="main-card">
                    <img class="logobig" src="{{ URL::to('images') . '/' . Custom::getSchool()->Logo }}">
                    <div class="card bg-common main-body">
                        <div class="card-header">
                            <div class="head">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ URL::to('images') . '/' . Custom::getSchool()->Logo }}" alt=""
                                            width="45" height="40" style="margin-left: 260px;">
                                    </div>
                                    <div class=" col-5 d-flex flex-column justify-content-center">
                                        <h5>{{ Custom::getSchool()->Name }}</h5>
                                        <p>{{ Custom::getSchool()->Address }}, {{ Custom::getSchool()->City }}
                                            ({{ Custom::getSchool()->State }})
                                            {{-- <br><span>Mobile No.
                                                {{ Custom::getSchool()->Mobile }}</span> --}}
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <label for="" class="me-3">T.C. No</label>
                                            <select name="tc_count" class="w-25">
                                                <option value="1"
                                                    {{ $tcdata?->tc_count == '1' ? 'selected' : 'selected' }}>1</option>
                                                <option value="2" {{ $tcdata?->tc_count == '2' ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ $tcdata?->tc_count == '3' ? 'selected' : '' }}>3
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="title ">Scholar's Register & Transfer Certificate</h3>
                        </div>
                        <div class="table-responsive background-white">
                            <table class="table pd-5 bordered">
                                <thead class=" no-wrap text-center justify-content-between">
                                    <tr>
                                        <th>Admission File No. </th>
                                        <th>Withdrawl File No.</th>
                                        <th>Transfer certificate No.</th>
                                        <th>S.R. No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="no-wrap text-center">
                                        <input hidden type="text" name="class_id" value="{{ $studentList->class_id }}">
                                        <input hidden type="text" name="student_id" value="{{ $studentList->id }}">
                                        <td><input type="text" name="admission_file_no"
                                                class=" form-control form-control-sm @error('admission_file_no') invalid @enderror "
                                                value="{{ $tcdata?->addmission_file_no ? $tcdata->addmission_file_no : old('admission_file_no') }}"
                                                placeholder="Enter Here"></td>
                                        <td><input name="withdraw_file_no" type="text"
                                                class=" form-control form-control-sm  @error('withdraw_file_no') invalid @enderror "
                                                value="{{ $tcdata?->withdrwal_file_no ? $tcdata->withdrwal_file_no : old('withdraw_file_no') }}"
                                                placeholder="Enter Here"></td>
                                        <td><input name="transfer_certificate_no" type="text"
                                                class=" form-control form-control-sm  @error('transfer_certificate_no') invalid @enderror "
                                                value="{{ $tcdata?->transfer_certificate_no ? $tcdata->transfer_certificate_no : old('transfer_certificate_no') }}"
                                                placeholder="Enter Here"></td>
                                        <td><span style="color: red; font-weight: bold;">{{ $studentList->sr_no }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive background-white">
                            <table class="table pd-5 bordered ">
                                <thead class="text-center">
                                    <tr>
                                        <th>Name of the Scholar with nationality
                                            <br> & caste if Hindu otherwise religion
                                        </th>
                                        <th>Name occcupation and address of
                                            <br> Parents, Guardian or Husband
                                        </th>
                                        <th>Date of birth of scholar</th>
                                        <th> last istitution attend by the scholar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="no-wrap text-center">
                                        <td> <span>{{ $studentList->student_name }},</span>
                                            <span>{{ $studentList->nationality }},</span>
                                            <span style="padding-left: 5px;">{{ $studentList->caste }}</span>
                                            <span style="padding-left: 5px;"> ( {{ $studentList->religion }} )</span>
                                        </td>
                                        <td>{{ $studentList->father_name }}
                                            <span style="padding-left: 5px;">( {{ $studentList->father_occupation }} )
                                            </span>
                                            <span>{{ $studentList->locality_type .
                                                ' ' .
                                                $studentList->village .
                                                ',' .
                                                $studentList->post_type .
                                                ' ' .
                                                $studentList->town .
                                                ' (' .
                                                $studentList->district .
                                                '),' }}
                                                <br> {{ $studentList->pincode . ' ' . $studentList->state }}</span>

                                        </td>
                                        <td> <span style="color: red; font-weight: bold;">{{ $studentList->dob }}</span>
                                        </td>
                                        <td >
                                            {{ $studentList->last_institute }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row content">
                            <div class="col-6 border border-secondary">Student Aadhar No- <span
                                    style="padding-left: 25px;">{{ $studentList->aadhar_no }}</span></div>
                            <div class="col-6 border border-secondary">Student Mother Name- <span
                                    style="padding-left: 25px;">{{ $studentList->mother_name }}</span> </div>
                        </div>
                        <div class="row content">
                            <div class="col-12 border border-secondary">Date of Birth in Words
                                <span style="padding-left: 25px;">{{ ucwords($dobFormatted) }}</span>
                            </div>
                        </div>
                        <div class="table-responsive background-white">
                            <table class="table pd-5 bordered ">
                                <thead class="text-center">
                                    <tr>
                                        <th>Class <span class="sel">Select</span> </th>
                                        <th>Date of <br> Admission</th>
                                        <th>Date of <br> Promotion </th>
                                        <th>Date of <br>removal</th>
                                        <th style="font-size: 12px; font-weight: bolder;">Causes of Romval
                                            <br>eg. nonpayment transfer of<br>family expulsion etc.
                                        </th>
                                        <th>Year</th>
                                        <th>Conduct</th>
                                        <th>Work</th>
                                        <th>Sign</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td>
                                                <select name="class_{{ $i }}"
                                                    class="form-control form-control-sm {{ $tcdata?->{'class_' . $i} ? 'showdate' : 'nodate'}}">
                                                    <option disabled selected>Select Class</option>
                                                    @foreach ($finalarray as $item)
                                                        <option
                                                            {{ $tcdata?->{'class_' . $i} == $item['id'] ? 'selected' : '' }}
                                                            value="{{ $item['id'] }}">{{ $item['classname'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input name="date_of_admission_{{ $i }}" type="date"
                                                    class="{{ $tcdata?->{'date_of_admission_' . $i} ? 'showdate' : 'nodate' }} form-control form-control-sm"
                                                    value="{{ $tcdata?->{'date_of_admission_' . $i} ? \Carbon\Carbon::parse($tcdata?->{'date_of_admission_' . $i})->format('Y-m-d') : '' }}"
                                                    placeholder="">
                                            </td>
                                            <td>
                                                <input name="date_of_promotion_{{ $i }}" type="date"
                                                    class=" {{ $tcdata?->{'date_of_promotion_' . $i} ? 'showdate' : 'nodate' }} form-control form-control-sm"
                                                    value="{{ $tcdata?->{'date_of_promotion_' . $i} ? \Carbon\Carbon::parse($tcdata?->{'date_of_promotion_' . $i})->format('Y-m-d') : '' }}">
                                            </td>
                                            <td>
                                                <input name="date_of_removal_{{ $i }}" type="date"
                                                    class=" {{ $tcdata?->{'date_of_removal_' . $i} ? 'showdate' : 'nodate' }} form-control form-control-sm"
                                                    value="{{ $tcdata?->{'date_of_removal_' . $i} ? \Carbon\Carbon::parse($tcdata?->{'date_of_removal_' . $i})->format('Y-m-d') : '' }}">
                                            </td>>
                                            </td>
                                            <td>
                                                <input name="causes_{{ $i }}" type="text"
                                                    class="form-control form-control-sm"
                                                    value="{{ $tcdata?->{'Causes_' . $i} ? $tcdata->{'Causes_' . $i} : '' }}">
                                            </td>
                                            <td>
                                                <input name="session_{{ $i }}" type="text"
                                                    class="form-control form-control-sm"
                                                    value="{{ $tcdata?->{'session_' . $i} ? $tcdata->{'session_' . $i} : '' }}">
                                            </td>
                                            <td>
                                                <input name="conduct_{{ $i }}" type="text"
                                                    class="form-control form-control-sm"
                                                    value="{{ $tcdata?->{'conduct_' . $i} ? $tcdata->{'conduct_' . $i} : '' }}">
                                            </td>
                                            <td>
                                                <input name="work_{{ $i }}" type="text"
                                                    class="form-control form-control-sm"
                                                    value="{{ $tcdata?->{'work_' . $i} ? $tcdata->{'work_' . $i} : '' }}">
                                            <td style="width: 100px;"></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <div class="row content">
                            <div class="col">
                                <div>1. Certified that the entries as regards details
                                    of the studenthave been duly checked from
                                    the Admission Form and that they are complete</div>
                                <div>2. Certified that the above student
                                    Register has been posted up-to-date of the
                                    student's leaving as reuuired by the department rules</div>
                            </div>
                        </div>
                        <div class="row content ">
                            <div class="col-4 font-weight-bold text-danger">Prepared By</div>
                            <div class="col-4 d-flex justify-content-center">
                                <label for="" class="me-3">Date</label>
                                <input type="date" name="tc_date"
                                    class="{{ $tcdata?->tc_date ? 'showdate' : '' }} form-control-sm @error('tc_date') invalid @enderror "
                                    value="{{ $tcdata?->tc_date ? $tcdata->tc_date : old('tc_date') }}" id="dateInput">
                            </div>
                            <div class="col-4 d-flex justify-content-end font-weight-bold text-danger">Head of Intitution
                            </div>
                        </div>
                        <div class="row content">
                            <div class="col">Note- If student has been among firs five,
                                this fact should be mentioned in the column of "work".</div>
                        </div>

                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>

    <script>
        $('#printbtn').on('click', function() {
            event.preventDefault();
            window.print()
        });

        $('input[type="date"]').on('change', function() {
            // Check if the date input has a value
            if ($(this).val()) {
                $(this).removeClass('nodate').addClass('showdate');
            } else {
                $(this).removeClass('showdate').addClass('nodate');
            }
        });
    </script>

    <script>
        @if (Session::has('Success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('Success') }}");
        @endif

        @if (Session::has('Error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('Error') }}");
        @endif
    </script>
@endsection
