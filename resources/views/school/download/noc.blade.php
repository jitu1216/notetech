@extends('school.layouts.master')
@section('content')
    <style>
        .page-header {
            background-color: white;
            padding-bottom: 10px
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
            background: white;
            width: 600px;
        }

        .main-body {
            border: solid blue 2px;
        }

        .head {
            /* margin-top: 10px; */
            margin: 8px;
            text-align: center;
        }

        .title {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin-top: -15px;
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

        .content {
            margin-top: -25px;
            font-weight: 600;
            font-size: 13px;
            padding: 10px;
        }

        .content .row {
            margin: 3px 0px;
        }

        .content .row span {
            border: none;
            border-bottom: dotted black 1px;
            padding-right: 10px;
            font-weight: bold;
            font-size: 14px;
        }


        @media print {

            .container {
                padding: 0px;
                margin: 0px;
                max-width: 100%;
                width: 100%;
            }

            .main-card {
                margin: 15px;
                margin-bottom: -10px;
            }

            .main-detail {
                margin-top: -105px;
                font-size: 12px;
                margin-bottom: 10px;
            }

            .main-detail div {
                margin-bottom: 1px;
            }

            .main-body {
                background-color: white;
                border: solid blue 2px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 7in;
                height: 3in;

            }

            .main-container {
                text-align: center;
                margin-top: -42px
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

            .button {
                display: none;
            }

            .main-box {
                margin-top: -20px;
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
                    <div class="col">
                        <h3>N.O.C. (Not Objection Certificate) / No dues</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{-- route('') --}}">N.O.C.</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row d-flex justify-content-between p-4">
                    <div class="col-8">
                            <a id="printbtn" href="" class=" btn btn-primary">Print</a>
                    </div>
                    {{-- <div class="col-2">
                        <a id="" href="{{ route('noc-list')}}" class=" btn btn-primary" >Back</a>
                </div> --}}
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="main-row">
                <form action=" {{ route('save-noc') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="main-card">
                        <div class="card bg-common main-body">
                            <div class="head">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="45"
                                            height="40">
                                    </div>
                                    <div class="col-10">
                                        <h5>{{ Custom::getSchool()->Name }}</h5>
                                        <p>{{ Custom::getSchool()->Address }}, {{ Custom::getSchool()->City }}
                                            ({{ Custom::getSchool()->State }})
                                            {{-- <br><span>Mobile No.
                                                {{ Custom::getSchool()->Mobile }}</span> --}}
                                        </p>

                                        <h6 class="m-0" style="font-weight: 800;">N.O.C. (Not Objection Certificate) / No
                                            Dues Fees</h6>
                                        <h6 class="m-0" style="font-weight: 800;">{{ $text }}</h6>

                                    </div>
                                </div>
                            </div>
                            <div class="main-box">
                                <div class="row content">
                                    <div class="col">
                                        <input type="text" value="{{ $studentList->id }}" name="student_id" hidden>
                                        <input type="text" value="{{ $text }}" name="exam_type" hidden>
                                        <div class="row mb-2">
                                            <div class="col-7">
                                                Receipt No.- &nbsp;
                                                <input type="text" class="border-0" value="{{ $noc?->receipt_no}}"
                                                name="receipt_no" placeholder="Enter Here">
                                            </div>
                                            <diV class="col-5">
                                                Date- &nbsp;
                                                <input type="text" class="border-0 datetimepicker"
                                                value="{{ \Carbon\Carbon::parse($noc?->date)->format('d/m/Y')}}"
                                                name="date" placeholder="DD-MM-YY">
                                            </div>
                                        </div>
                                        <div class="col-12">This is certified that
                                            <span
                                                style="padding-left: 25px; font-weight: bold;
                                            font-size: 14px;padding-right: 25px; ">{{ $studentList->student_name }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                S/o/D/o <span
                                                    style="padding-left: 10px; padding-right: 10px; font-weight: bold;
                                                font-size: 14px;">Mr.
                                                    {{ $studentList->father_name }}</span>

                                            </div>
                                            <div class="col-8">
                                                Address-&nbsp; <span>{{ $studentList->village }}</span>
                                                Post- &nbsp; <span>{{ $studentList->town }}</span>
                                                District- &nbsp; <span>{{ $studentList->district }}</span>
                                                State &nbsp; <span>{{ $studentList->state }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                Class <span
                                                    style="font-weight: bold;
                                                font-size: 14px;">
                                                    {{ Custom::getClass($studentList->class_id)->classname }}</span>
                                            </div>
                                            <div class="col-9">
                                                Roll No. <span style="font-weight: bold; font-size: 14px;">
                                                    {{ $studentList->roll_no }}</span> &nbsp;
                                                All types of fees have been deposited
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                and they do not have any money left.
                                                They are allowed to appear in the {{$text}} examination
                                            </div>
                                            <div class="col-5" >
                                                <div style="padding-left: 80px;">
                                                    Order By- <br> Principal/Manager
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row button">
                        <div class="col-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        $('#printbtn').on('click', function() {
            event.preventDefault();
            window.print()
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
