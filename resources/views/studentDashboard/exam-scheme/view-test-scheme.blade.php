@extends('studentDashboard.layouts.master')
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
            padding-top: 50px;

        }

        .main-container {
            flex: 8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-left: -60px !important;
            padding-top: 50px;
            padding-bottom: 5px;
        }

        .main-container h3 {
            font-weight: 800 !important;
            margin-bottom: -2px;
            color: rgb(219, 0, 0);

        }

        .timing {
            padding: 5px 20px 5px 20px;
            background-color: black;
            color: white;
            border-radius: 5px;
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

        table tr {
            text-align: center;
        }

        .table tr th,
        td {
            border: solid black 1px;

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

        .container {
            padding: 20px;
            margin: 0px;
            max-width: 100%;
            width: 100%;
        }



        @media print {

            .container {
                padding: 0px;
                margin: 0px;
                max-width: 100%;
                width: 100%;
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

            .timing {
                padding: 5px 20px 5px 20px;
                color:black;
                border-radius: 5px;
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
                        <h3 class="page-title">{{ $text }} Scheme</h3>
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
            <div class="row" id="printpage">
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

                                </div>
                            </div>
                            <div class="row mt-4 mb-0">
                                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                    <h5>{{ $text }} Scheme ( Session {{ Session::get('academic_session') }} )</h5>
                                    @if ($text == 'Test Exam')
                                        <h5 class="timing"> Exam Timing : {{ Custom::getSchool()->test_exam_time }}</h5>
                                    @elseif ($text == 'Monthly Exam')
                                        <h5 class="timing"> Exam Timing : {{ Custom::getSchool()->monthly_scheme_time }}
                                        </h5>
                                    @elseif ($text == 'Quarterly Exam')
                                        <h5 class="timing"> Exam Timing : {{ Custom::getSchool()->quarter_scheme_time }}
                                        </h5>
                                    @elseif ($text == 'Half Yearly Exam')
                                        <h5 class="timing"> Exam Timing : {{ Custom::getSchool()->half_scheme_time }}</h5>
                                    @elseif ($text == 'Annual Exam')
                                        <h5 class="timing"> Exam Timing : {{ Custom::getSchool()->annual_scheme_time }}
                                        </h5>
                                    @endif
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
                                                @foreach ($scheme_header as $header)
                                                    <th>{{ $header->exam_header }}</th>
                                                @endforeach


                                            </tr>
                                        </thead>
                                        <tbody class=" no-wrap text-center">
                                            @foreach ($scheme as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d-m-Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('l') }}</td>
                                                    @foreach ($scheme_header as $value)
                                                        <td>{{ Custom::getExamSubject($value->exam_header, $item->exam_date) }}
                                                        </td>
                                                    @endforeach
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

            $('#printbtn').on('click', function() {
                event.preventDefault();
                window.print()
            });
        </script>
    @endsection
