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
            padding-bottom: 0px
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

                <div class="student-group-form p-4" id="searchlist">
                    <form action="{{ route('searchtc') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input @if (!empty($studentsearch)) value="{{ $studentsearch }}" @endif
                                        type="text" class="form-control" name="studentsearch"
                                        placeholder="Search Student ...">
                                    <input value="{{ $mark }}" type="text" class="form-control" name="searchId"
                                        hidden>
                                </div>

                            </div>
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <div class="form-group ">
                                        <select class="form-control select  @error('category') is-invalid @enderror"
                                            name="Class">

                                            <option selected value="">All Class</option>
                                            @if (Custom::getStaffRole() == 'Assistant Teacher')
                                                @if (!empty($class))
                                                    @foreach ($finalarray as $value)
                                                        @foreach (Custom::getTeacherClass() as $allot_class)
                                                            @if ($allot_class == $value['id'])
                                                                <option value="{{ $value['id'] }}"
                                                                    {{ $value['id'] == $class ? 'selected' : '' }}>
                                                                    {{ $value['classname'] }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    @foreach ($finalarray as $value)
                                                        @foreach (Custom::getTeacherClass() as $allot_class)
                                                            @if ($allot_class == $value['id'])
                                                                <option value="{{ $value['id'] }}"
                                                                    {{ old('Class') == 'I' ? 'selected' : '' }}>
                                                                    {{ $value['classname'] }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @else
                                                @if (!empty($class))
                                                    @foreach ($finalarray as $value)
                                                        <option value="{{ $value['id'] }}"
                                                            {{ $value['id'] == $class ? 'selected' : '' }}>
                                                            {{ $value['classname'] }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($finalarray as $value)
                                                        <option value="{{ $value['id'] }}"
                                                            {{ old('Class') == 'I' ? 'selected' : '' }}>
                                                            {{ $value['classname'] }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="search-student-btn">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                                <div class="search-student-btn">
                                    <a id="printbtn" href="" class=" btn btn-primary"
                                        style="margin-left:0px;">Print</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <div class="main-row">
                    {{-- @foreach ($studentList as $item) --}}
                    {{-- @for ($i = 1; $i <= 51; $i++) --}}
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
                                            <th> withdrawl File No.</th>
                                            <th>Transfer certificate No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="no-wrap text-center">
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
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
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row content">
                                <div class="col-6 border border-secondary">Studnet Aadhar No.</div>
                                <div class="col-6 border border-secondary">Student Mother Name</div>
                            </div>
                            <div class="row content">
                                <div class="col-12 border border-secondary">Date Of Birth in words</div>
                            </div>
                            <div class="table-responsive background-white">
                                <table class="table pd-5 bordered ">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Class</th>
                                            <th>Date Of Admission</th>
                                            <th>Date of Promotion </th>
                                            <th>Date of removal</th>
                                            <th>Causes of Romval eg. nonpayment
                                                <br> transfer of family expulsion etc.
                                            </th>
                                            <th>year</th>
                                            <th>conduct</th>
                                            <th>work</th>
                                            <th>Sign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="no-wrap text-center">
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>
                                            <td>001122</td>

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
                                <div class="col-4">Head of intitution</div>
                            </div>
                            <div class="row content">
                                <div class="col">Note- If syudent has been among firs five,
                                    this fact should be mentioned in the column of "work".</div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- @endfor --}}
                {{-- @endforeach --}}
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
