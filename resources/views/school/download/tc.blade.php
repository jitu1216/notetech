@extends('school.layouts.master')
@section('content')
    <style>
        .table tr,
        th,
        td {
            border: solid black 1px;

        }

        .invalid{
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
            /* width: 70vw; */
        }

        .main-body {
            margin: 15px;

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

        @media print {


            .container {
                padding: 0px;
                margin: 0px;
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
                 /* Hide the actual text if needed */
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


            .table>:not(caption)>*>* {
                padding: 7px 15px;
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
        <form action="{{ route('store_tc')}}" method="post">
            @csrf
        <div class="main-row">
            <div class="main-card">
                <div class="card bg-common main-body">
                    <div class="card-header">
                        <div class="head">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="45"
                                        height="40" style="margin-left: 260px;">
                                </div>
                                <div class="col-5">

                                    <h5>{{ Custom::getSchool()->Name }}</h5>
                                    <p>{{ Custom::getSchool()->Address }}, {{ Custom::getSchool()->City }}
                                        ({{ Custom::getSchool()->State }})
                                        {{-- <br><span>Mobile No.
                                                {{ Custom::getSchool()->Mobile }}</span> --}}
                                    </p>

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
                                    <td><input type="text" name="admission_file_no" class=" form-control form-control-sm @error('admission_file_no') invalid @enderror " value="{{ old('admission_file_no')}}"
                                            placeholder="Enter Here"></td>
                                    <td><input name="withdraw_file_no" type="text" class=" form-control form-control-sm  @error('withdraw_file_no') invalid @enderror " value="{{ old('withdraw_file_no')}}"
                                            placeholder="Enter Here"></td>
                                    <td><input name="transfer_certificate_no" type="text" class=" form-control form-control-sm  @error('transfer_certificate_no') invalid @enderror " value="{{ old('transfer_certificate_no')}}"
                                            placeholder="Enter Here"></td>
                                    <td><span style="color: red; font-weight: bold;">{{ $studentList->sr_no }}</span></td>
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
                                        <span style="padding-left: 5px;">( {{ $studentList->father_occupation }} ) </span>
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
                                    <td> <span style="color: red; font-weight: bold;">{{ $studentList->dob }}</span></td>
                                    <td>
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
                            <span style="padding-left: 25px;"> {{ ucwords($dobFormatted) }}</span>
                        </div>
                    </div>
                    <div class="table-responsive background-white">
                        <table class="table pd-5 bordered ">
                            <thead class="text-center">
                                <tr>
                                    <th>Class <span class="sel">Select</span> </th>
                                    <th>Date of Admission</th>
                                    <th>Date of Promotion </th>
                                    <th>Date of removal</th>
                                    <th style="font-size: 12px; font-weight: bolder;">Causes of Romval eg. nonpayment
                                        <br> transfer of family expulsion etc.
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
                                            <select name="class_{{$i}}" class="form-control form-control-sm">
                                                <option disabled selected> Select Class</option>
                                                @foreach ($finalarray as $item)
                                                <option value="{{ $item['id']}}">{{ $item['classname']}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input  name="date_of_addmission_{{$i}}" type="date" class="form-control form-control-sm" value="{{$tcdata?->date_of_admission_1}}">
                                        </td>
                                        <td>
                                            <input name="date_of_promation_{{$i}}" type="date" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input name="date_of_removal_{{$i}}" type="date" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input name="causes_{{$i}}" type="text" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input name="session_{{$i}}" type="text" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input  name="conduct_{{$i}}" type="text" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input  name="work_{{$i}}" type="text" class="form-control form-control-sm">
                                        <td></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    {{-- <hr style="height: 3px; color: black;"> --}}
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
                        <div class="col-4">Prepared By</div>
                        <div class="col-4">
                            <label for="" class="">Date</label>
                            <input type="date" name="tc_date" class=" form-control-sm @error('tc_date') invalid @enderror " value="{{ old('tc_date')}}" id="dateInput" >
                        </div>
                        <div class="col-4">Head of Intitution</div>
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
    </script>
@endsection
