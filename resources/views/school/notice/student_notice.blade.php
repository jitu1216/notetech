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
            width: 680px;
        }

        .invalid {
            border: solid red 1px !important;
        }

        .main-body {
            border: solid blue;
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
        }

        .table tr th,
        td {
            border: solid black 1px;

        }

        .bg-firozi {
            background-color: rgb(147, 242, 255) !important;
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
                width: 7.3in;
                height: 3.5in;

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
            <form action="{{ route('save-student-notice') }} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="page-header">
                    <div class="row p-4 align-item-center m-3">
                        <div class="col">
                            <h3>Student Notice</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{-- route('') --}}">Notice</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table table-card p-4">
                        <table class="table">
                            <thead class="text-nowrap table-success">
                                <tr>
                                    <th>Notice No.</th>
                                    <th>Notice Date.</th>
                                    <th>Student Id</th>
                                    <th>Student Roll No.</th>
                                    <th>Application No.</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Class</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>

                            <tbody class="text-nowrap">
                                <tr>
                                    <td><input class="border @error('date') invalid @enderror" type="date"
                                            value="{{ Custom::getstudentnoticedata($studentList->id)?->date }}"
                                            name="date"></td>
                                    <td><input class="border @error('date') invalid @enderror " type="text"
                                            name="notice_no"
                                            value="{{ Custom::getstudentnoticedata($studentList->id)?->notice_no }}"
                                            placeholder="Enter Notice No."></td>
                                    <td>{{ $studentList->student_id }}</td>
                                    <td>{{ $studentList->roll_no }}</td>
                                    <td>{{ $studentList->application_no }}</td>
                                    <td>{{ $studentList->student_name }}</td>
                                    <td>{{ $studentList->father_name }}</td>
                                    <td>{{ Custom::getClass($studentList->class_id)->classname }}</td>
                                    <td>{{ $studentList->mobile }}</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card p-4">

                    <div class="table table-card">
                        <table class="table">
                            <thead class="text-nowrap table-warning">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Complaints</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody class="text-nowrap">
                                <input type="text" value="{{ $studentList->id }}" name="student_id" hidden>
                                <input type="text" value="{{ $studentList->class_id }}" name="class_id" hidden>

                                @foreach ($compl_notice as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->item_name }}
                                            <input type="text" name="item[]" value="{{ $item->id }}" hidden>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="status[]"
                                                {{ Custom::getstudentnotice($studentList->id, $item->id)?->item_status == 1 ? 'checked' : '' }}
                                                value="{{ $item->id }}">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="table mt-4">
                            <thead class="text-nowrap bg-firozi">
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Suggestions</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody class="text-nowrap">
                                @foreach ($sugg_notice as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->item_name }}
                                            <input type="text" name="suggest_item[]" value="{{ $value->id }}" hidden>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="suggest_status[]"
                                                {{ Custom::getstudentnotice($studentList->id, $value->id)?->item_status == 1 ? 'checked' : '' }}
                                                value="{{ $value->id }} ">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-25">Save</button>
                        </div>
                    </div>

                </div>
            </form>

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
