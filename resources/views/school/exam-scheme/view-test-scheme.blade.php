@extends('school.layouts.master')
@section('content')
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
            margin-left: -60px !important;
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

    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Test Exam Scheme</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Scheme</li>
                            <a id="extra" href="" class="" style="margin-left:20px;"></a>
                            <a id="printbtn" href="" class=" btn btn-primary text-white"
                                style="margin-left:20px;">Print</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="school">
                                <div class="logo-container">
                                    <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="60"
                                        height="60">
                                </div>
                                <div class="main-container">
                                    <h3>{{ Custom::getSchool()->Name }}</h3>
                                    <h6>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                                        ({{ Custom::getSchool()->State }})</h6>
                                    <p><span>Email.{{ Custom::getSchool()->Email }}</span> <span>Mobile No.
                                            {{ Custom::getSchool()->Mobile }}</span>
                                    </p>
                                    <p style="margin-top: -22px"><span>Session 2024-2025{{-- Session::()->academic_session --}}</span> <span>
                                            Test Exam Scheme{{-- $item->exam_type --}}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                                        <thead class="no-wrap text-center">
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>Class N.C. To K.G.</th>
                                                <th>Class 1 To 10</th>
                                                <th>Class 11 To 12</th>
                                            </tr>
                                        </thead>
                                        <tbody class=" no-wrap text-center">
                                            @foreach ($scheme as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d-m-Y') }}</td>
                                                    <td></td>
                                                    <td>{{ $item->exam_subject }}</td>
                                                    <td>{{ $item->exam_subject }}</td>
                                                    <td>{{ $item->exam_subject }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
