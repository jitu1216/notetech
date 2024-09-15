@extends('school.layouts.master')
@section('content')
    <style>
        body {
            overflow: scroll !important;
        }

        table {
            background-color: white;
            width: 100%; /* Ensures table takes up full width */
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
                            <select name="month" id="month" class="form-control">
                                <option selected disabled>Select Month</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                                @endfor
                            </select>
                            @error('month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="page-title text-center">
                            Attendance Record
                        </h3>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group">
                            <div class="form-group ">
                                <select class="form-control" name="Class" id="class">
                                    <option selected disabled value="">Select Class</option>
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
                                    <th colspan="5">Month: {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                        {{ Custom::getYear($month) }}
                                    </th>
                                    <th colspan="{{ $daysInMonth }}">Attendance</th>
                                    <th colspan="5">Total</th>
                                </tr>
                                <tr>
                                    <th class="tb-bg">S.No</th>
                                    <th class="tb-bg">Student Name</th>
                                    <th class="tb-bg">Roll No</th>
                                    <th class="tb-bg">Mobile No.</th>
                                    <th class="tb-bg">Class</th>
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        <th class="tb-bg"> {{ $i }}</th>
                                    @endfor
                                    <th class="tb-bg">Days</th>
                                    <th class="bg-success text-white">Present</th>
                                    <th class="bg-danger text-white">Absent</th>
                                    <th class="bg-info text-white">Half Day</th>
                                    <th class="bg-firozi">Leave</th>

                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @php
                                    $sunday = 0;
                                @endphp
                                @foreach ($attendance as $key => $value)
                                    @php
                                        $count = 0;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->student_name }}</td>
                                        <td>{{ $value->roll_no }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ Custom::getClass($value->class_id)->classname }}</td>

                                        @for ($i = 1; $i <= $daysInMonth; $i++)
                                            @php
                                                $isHoliday = false;
                                                $holidayName = '';
                                            @endphp

                                            {{-- Check if the day is a holiday --}}
                                            @foreach ($holidays as $holiday)
                                                @if (\Carbon\Carbon::parse($holiday->holidaydate)->day == $i)
                                                    @php
                                                        $isHoliday = true;
                                                        $holidayName = $holiday->holidayname;
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            {{-- Check if the day is a Sunday or holiday --}}
                                            @if (Custom::getDay($month, $i) == 'Sunday' || $isHoliday)
                                                {{-- Merge Sundays and Holidays --}}
                                                @if ($sunday == 0)
                                                    <td rowspan="{{ $attendance->count() }}" class=" {{ $isHoliday ? 'holiday-vertical' : 'merge-vertical' }}">
                                                        @if ($isHoliday && Custom::getDay($month, $i) == 'Sunday')
                                                            <h6>Sunday & {{ $holidayName }}</h6>
                                                        @elseif ($isHoliday)
                                                            <h6>{{ $holidayName }}</h6>
                                                        @else
                                                            <h6>Sunday</h6>
                                                        @endif
                                                    </td>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            @else
                                                @php
                                                    $x = 0;
                                                @endphp
                                                {{-- Render attendance data --}}
                                                @foreach ($value->attendances as $attend)
                                                    @if (\Carbon\Carbon::parse($attend->date)->day == $i)
                                                        <td
                                                            @if ($attend->attendance_type == 'P') class="present"
                                                            @elseif ($attend->attendance_type == 'A') class="absent"
                                                            @elseif ($attend->attendance_type == 'HD') class="half"
                                                            @elseif ($attend->attendance_type == 'LA') class="leave" @endif>
                                                            {{ $attend->attendance_type }}
                                                        </td>
                                                        @php
                                                            $x = 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($x == 0)
                                                    <td> </td>
                                                @endif
                                            @endif
                                        @endfor

                                        {{-- Calculate attendance summary --}}
                                        @php
                                            $attd_sum = Custom::getAttendanceSummary(
                                                $value->id,
                                                $value->class_id,
                                                $month,
                                            );
                                        @endphp

                                        <td>{{ $daysInMonth - $count }}</td>
                                        <td>{{ $attd_sum['present'] }}</td>
                                        <td>{{ $attd_sum['absent'] }}</td>
                                        <td>{{ $attd_sum['halfday'] }}</td>
                                        <td>{{ $attd_sum['leave'] }}</td>

                                        @php
                                            $sunday++;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="row">
                            <div class="col-6">
                                <label>Symbols: P = "Present", A = "Absent", HD = "Half Day",
                                    LA = "Leave Application"</label>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
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


            $("#class").change(function() {
                var month_id = $('#month').children("option:selected").val();
                if (month_id == '') {
                    alert('Please Select Month');
                } else {
                    var class_id = $(this).children("option:selected").val();
                    window.location.href = '/school/student-attendance-record/' + class_id + '/' + month_id;
                }
            });

            $("#month").change(function() {
                var class_id = $('#class').children("option:selected").val();
                if (class_id == '') {
                    alert('Please Select Class');
                } else {
                    var month_id = $(this).children("option:selected").val();
                    window.location.href = '/school/student-attendance-record/' + class_id + '/' + month_id;
                }
            });

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
