@extends('school.layouts.master')
@section('content')
    <style>
        body {
            overflow: scroll !important;
        }

        table {
            background-color: white;
            width: 100%;
            /* Ensures table takes up full width */
        }

        .right {
            color: green;
        }

        .wrong {
            color: red;
        }

        table tr {
            text-align: center;
        }

        .table tr th,
        td {
            border: solid black 1px;

        }

        .print-header {
            display: none;
            margin-top: -30px;
        }

        .tb-bg {
            background-color: rgb(255, 250, 206) !important;
        }

        .bg-firozi {
            background-color: rgb(147, 242, 255) !important;
        }

        .print-header h4 {
            text-align: center;
            margin-top: 10px;
        }

        .school {
            width: 100vw;
            display: flex;
            flex-direction: row;
        }

        td.merge-vertical {
            vertical-align: middle;
            text-align: center;
            transform-origin: center;
            white-space: nowrap;
            padding: 0;
            background-color: rgb(255, 227, 227);
            overflow: hidden;
            /* Prevents content from increasing the width */
            max-width: 30px;
            /* Set a maximum width for the cells */
        }

        td.merge-vertical h6 {
            transform: rotate(-90deg);
            /* Rotate the text */
            font-weight: 600;
            color: rgb(192, 6, 0);
            margin: 0;
            line-height: 1;
            /* Ensures the text fits within the cell */
            white-space: nowrap;
        }

        td.holiday-vertical {
            vertical-align: middle;
            text-align: center;
            transform-origin: center;
            white-space: nowrap;
            padding: 0;
            background-color: rgb(255, 200, 232);
            overflow: hidden;
            /* Prevents content from increasing the width */
            max-width: 30px;
            /* Set a maximum width for the cells */
        }

        td.holiday-vertical h6 {
            transform: rotate(-90deg);
            /* Rotate the text */
            font-weight: 600;
            color: rgb(185, 6, 170);
            margin: 0;
            line-height: 1;
            /* Ensures the text fits within the cell */
            white-space: nowrap;
        }



        .present {
            color: rgb(5, 148, 0) !important;
            font-weight: 400;
        }

        .absent {
            color: rgb(192, 6, 0) !important;
            font-weight: 400;
        }

        .half {
            color: rgb(103, 103, 103) !important;
            font-weight: 400;
        }

        .leave {
            color: rgb(103, 103, 103) !important;
            font-weight: 400;
        }

        .logo-container {
            flex: 2;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
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

        .normal .form-control {
            border: 1px solid rgb(8, 190, 2);

        }

        .change .form-control {
            border: 1px solid red;
        }

        .std_image img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        @media print {
            #menu {
                display: none;
            }

            #printbtn {
                display: none;
            }

            .page-wrapper {
                margin-top: -20px !important;
                padding-bottom: 0px;
            }

            .page-title {
                margin-bottom: 60px;
            }

            #menu {
                display: none;
            }

            .header {
                display: none;
            }
        }
    </style>
    <div class="page-wrapper">

        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row mb-4">
                <div class="col-sm-2 p-4 m-2 bg-white shadow rounded">
                    <p>Total Fees</p>
                    <h3 style="margin-top:-15px;" id="one-totalamount">429140</h3>
                </div>
                <div class="col-sm-3 p-4 m-2  bg-white shadow rounded">
                    <p>Total Deposite Fees</p>
                    <h3 style="margin-top:-15px;" id="one-totaldeposite">2650</h3>
                </div>
                <div class="col-sm-3 p-4 m-2 bg-white shadow rounded">
                    <p>Total Today Deposite Fees</p>
                    <h3 style="margin-top:-15px;" id="one-todayamount">0</h3>
                </div>
                <div class="col-sm-3 p-4 m-2 bg-white shadow rounded">
                    <p>Total Pending Fees</p>
                    <h3 style="margin-top:-15px;" id="one-totalpending">426490</h3>
                </div>
            </div> --}}
            <form action="{{ route('updatestudentattendance') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:20px;">Print</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="page-title text-center">
                            Maintenance Record
                        </h3>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group">
                            <div class="form-group ">
                                <select class="form-control" name="Class" id="class">
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
                </div>
                <div id="printcontent">
                    <div class="table table-card">
                        <table class="table">
                            <thead class="table-success text-nowrap">
                                <tr style="">
                                    <th colspan="6">Student Info
                                    </th>
                                    <th colspan="{{ $item->count() }}">Items</th>
                                    {{-- <th colspan="5"></th> --}}
                                </tr>
                                <tr>
                                    <th class="tb-bg">S.No</th>
                                    <th class="tb-bg">Student Name</th>
                                    <th class="tb-bg">Father Name</th>
                                    <th class="tb-bg">Roll No</th>
                                    <th class="tb-bg">Mobile No.</th>
                                    <th class="tb-bg">Class</th>
                                    @foreach ($item as $data)
                                        <th class="tb-bg">{{ $data->item_name }}</th>
                                    @endforeach
                                    {{-- <th class="bg-success text-white">Present</th>
                                    <th class="bg-danger text-white">Absent</th>
                                    <th class="bg-info text-white">Half Day</th>
                                    <th class="bg-firozi">Leave</th> --}}

                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @php
                                    $wrongTickCount = array_fill(0, $item->count(), 0);
                                @endphp
                                @foreach ($maintenance as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->student_name }}</td>
                                        <td>{{ $value->father_name }}</td>
                                        <td>{{ $value->roll_no }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ Custom::getClass($value->class_id)->classname }}</td>
                                        @foreach ($item as $index => $data)
                                            @php
                                                $status =
                                                    Custom::getstudentmaintenance($value->id, $data->id)
                                                        ?->item_status == 1
                                                        ? '✔'
                                                        : '✗';
                                                if ($status == '✗') {
                                                    $wrongTickCount[$index]++;
                                                }
                                            @endphp
                                            <td class="{{ $status == '✔' ? 'right' : 'wrong' }}">
                                                {{ $status }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead class="table-success text-nowrap">
                                <th colspan="6">Total Pending</th>
                                @foreach ($wrongTickCount as $count)
                                    <th>{{ $count }}</th>
                                @endforeach
                            </thead>

                        </table>

                    </div>
                </div>
            </form>
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


            $("#class").change(function() {
                var class_id = $(this).children("option:selected").val();
                window.location.href = '/school/student-maintenance-record/' + class_id;
            });

            // $("#month").change(function() {
            //     var class_id = $('#class').children("option:selected").val();
            //     if (class_id == '') {
            //         alert('Please Select Class');
            //     } else {
            //         var month_id = $(this).children("option:selected").val();
            //         window.location.href = '/school/student-attendance-record/' + class_id + '/' + month_id;
            //     }
            // });

            $(document).ready(function() {

                // Find the option with the old value and change its color
                $('#attendance-dropdown option').each(function() {
                    if ($(this).val() == oldValue) {
                        $(this).css('color', 'red'); // Change color to red or any color you prefer
                    }
                });



            });
        </script>
    @endsection
