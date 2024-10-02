@extends('school.layouts.master')
@section('content')
    <style>
        .table tr,
        th,
        td {
            border: solid black 1px;

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
            /* margin-top: -95px; */
        }

        .main-card {
            margin: 10px;
            margin-bottom: 10px;
            border: solid blue;
            background: white;
        }

        .main-body {
            margin: 15px;

        }

        .page-header {
            background-color: white;
            padding: 10px
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

        @media print {

            .container {
                padding: 0px;
                margin: 0px;
                max-width: 100%;
                width: 100%;
                margin-left: -25px;
            }

            .main-body {
                margin: 5px;
                padding: 0px
            }

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

            .card-main {
                margin: 0px;
                padding: 0px;
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
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row p-4 align-item-center m-3">
                    <div class="col ">
                        <h3>Transfer Certificate</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{-- route('') --}}">T.C. List</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="search-student-btn">
                        <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:0px;">Print</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="main-row">
            <div class="main-card">
                <div class="card bg-common main-body">
                    <div class="card-header">
                        <h3 class="title ">Scholar's Register & Transfer Certificate</h3>
                    </div>

                    <div class="table-responsive background-white">
                        <table class="table pd-5 bordered">
                            <thead class=" no-wrap text-center justify-content-between">
                                <tr>
                                    <th>Addmission File No. </th>
                                    <th>Withdrawl File No.</th>
                                    <th>Transfer certificate No.</th>
                                    <th>Register No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap text-center">
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
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
                                    <td> <span>{{ $studentList->student_name}}</span>
                                        <span>{{ $studentList->nationality}},</span>
                                        <span style="padding-left: 5px;">{{ $studentList->caste}},</span>
                                    </td>
                                    <td>{{ $studentList->father_name}},
                                        <span>{{ $studentList->village}} {{ $studentList->town}},</span>
                                        <span style="padding-left: 5px;">{{ $studentList->father_occupation}},</span>
                                    </td>
                                    <td>{{ $studentList->dob}}</td>
                                    <td>
                                      {{ $studentList->last_institute}}
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row content">
                        <div class="col-6 border border-secondary">Studnet Aadhar No. <span style="padding-left: 25px;">{{ $studentList->aadhar_no}}</span></div> 
                        <div class="col-6 border border-secondary">Student Mother Name <span style="padding-left: 25px;">{{ $studentList->mother_name}}</span> </div>
                    </div>
                    <div class="row content">
                        <div class="col-12 border border-secondary">Date of Birth in Words</div>
                    </div>
                    <div class="table-responsive background-white">
                        <table class="table pd-5 bordered ">
                            <thead class="text-center">
                                <tr>
                                    <th>Class</th>
                                    <th>Date of Admission</th>
                                    <th>Date of Promotion </th>
                                    <th>Date of removal</th>
                                    <th>Causes of Romval eg. nonpayment
                                        <br> transfer of family expulsion etc.
                                    </th>
                                    <th>Year</th>
                                    <th>Conduct</th>
                                    <th>Work</th>
                                    <th>Sign</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap text-center">
                                    <td> {{ Custom::getClass($studentList->class_id)->classname }}</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>
                                    <td>.......</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <hr style="height: 3px; color: black;"> --}}
                    <div class="row content">
                        <div class="col">
                            <p>1. Certified that the entries as regards details
                                of the studenthave been duly checked from
                                the Admission Form and that they are complete</p>
                            <p>2. Certified that the above student
                                Register has been posted up-to-date of the
                                student's leaving as reuuired by the department rules</p>
                        </div>
                    </div>
                    <div class="row content ">
                        <div class="col-4">Prepared By</div>
                        <div class="col-4">Date </div>
                        <div class="col-4">Head of Intitution</div>
                    </div>
                    <div class="row content">
                        <div class="col">Note- If student has been among firs five,
                            this fact should be mentioned in the column of "work".</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $('#printbtn').on('click', function() {
            event.preventDefault();
            window.print()
        });
    </script>
@endsection
