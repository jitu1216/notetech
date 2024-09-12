@extends('school.layouts.master')
@section('content')
    <style>
        body {
            overflow: scroll !important;
        }

        table {
            background-color: white;
        }

        .print-header {
            display: none;
            margin-top: -30px;
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
        <form action="{{ route('updatestudentattendance') }}" method="post">
            @csrf
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="form-control datetimepicker  @error('date') is-invalid @enderror" name="date"
                                type="text" placeholder="DD-MM-YYYY" id="atddate" value="{{ $date }}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="page-title text-center">
                            Update Attendance
                        </h3>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group">
                            <div class="form-group ">
                                <select class="form-control" name="Class" id="class">
                                    <option selected value="">Select Class</option>
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
                                    <th>S.No</th>
                                    <th>Student Name</th>
                                    <th>Roll No.</th>
                                    <th>Mobile No.</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @if ($class != null)
                                    @php
                                        $x = 0;
                                    @endphp
                                    @foreach ($studentlist as $key => $value)
                                        @foreach ($attendance as $attend)
                                            @if ($attend->student_id == $value->id)
                                                <tr>
                                                    <input type="number" hidden name="student[{{ $key }}]"
                                                        value="{{ $value->id }}">
                                                    <td>{{ ++$x }}</td>
                                                    <td>{{ $value->student_name }}</td>
                                                    <td>{{ $value->roll_no }}</td>
                                                    <td>{{ $value->mobile }}</td>
                                                    <td>
                                                        <select name="attendance[{{ $key }}]"
                                                            class="form-control @error('attendance.' . $key) is-invalid @enderror"
                                                            required>
                                                            <option selected disabled>Select Attendance</option>
                                                            <option value="P"
                                                                {{ $attend->attendance_type == 'P' ? 'selected' : '' }}>
                                                                Present
                                                            </option>
                                                            <option value="A"
                                                                {{ $attend->attendance_type == 'A' ? 'selected' : '' }}>
                                                                Absent
                                                            </option>
                                                            <option value="HD"
                                                                {{ $attend->attendance_type == 'HD' ? 'selected' : '' }}>
                                                                Half Day
                                                            </option>
                                                            <option value="LA"
                                                                {{ $attend->attendance_type == 'LA' ? 'selected' : '' }}>
                                                                Leave Application
                                                            </option>

                                                        </select>

                                                        @error('attendance.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @else
                                            @endif
                                        @endforeach
                                        <input type="number" hidden value="{{ $key }}" name="total">
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if ($class != null)
                            @if ($attendance->count() === 0)
                                <h3 class="text-center text-danger m-4"> No Attendance Record Found! </h3>
                            @else
                                <div class="row">
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-3 search-student-btn">
                                        <button type="submit" class="btn btn-primary w-75 me-4"
                                            style="background-color:rgb(89, 89, 255)">Submit</button>
                                    </div>
                                </div>
                            @endif
                        @endif
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
            var atddate = $('#atddate').val();
            if (atddate == '') {
                alert('Please Select Date');
            } else {
                var class_id = $(this).children("option:selected").val();
                window.location.href = '/school/view_student_attendance/' + class_id + '/' + atddate;
            }
        });

        $(document).ready(function() {

            // Find the option with the old value and change its color
            $('#attendance-dropdown option').each(function() {
                if ($(this).val() == oldValue) {
                    $(this).css('color', 'red'); // Change color to red or any color you prefer
                }
            });

            $('#atddate').on('dp.show', function() {
                $('.day').each(function() {
                    var fullDate = moment($(this).attr('data-day'));
                    if (fullDate.isValid() && fullDate.day() === 0) {
                        $(this).addClass('disabled');
                    }
                });
            });


            $('#atddate').on('dp.change', function(event) {
                var selectedDate = event.date.format('DD-MM-YYYY');
                var class_id = $('#class').children("option:selected").val();
                if (class_id == '') {
                    alert('Please Select Class');
                } else {
                    window.location.href = '/school/view_student_attendance/' + class_id + '/' +
                        selectedDate;

                }
            });


        });
    </script>
@endsection
