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
        <form action="{{ route('submitstudentattendance') }}" method="post">
            @csrf
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">
                                    Take Attendance
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="form-control datetimepicker  @error('date') is-invalid @enderror" name="date"
                                type="text" placeholder="DD-MM-YYYY" id="sundaydate" value="{{ old('date') }}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-danger text-center" style="display: none;" id="holidayline">Today is "<span id="holidaytext">Hello</span>" Holiday</h5>
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
                                    <th>Roll No</th>
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
                                        <tr class="{{ old('attendance.' . $key) == '' ? 'change' : 'normal' }}">
                                            <input type="number" hidden name="student[{{ $key }}]"
                                                value="{{ $value->id }}">

                                            <td>{{ ++$x }}</td>
                                            <td>{{ $value->student_name }}</td>
                                            <td>{{ $value->roll_no }}</td>
                                            <td>{{ $value->mobile }}</td>
                                            <td>
                                                <select name="attendance[{{ $key }}]"
                                                    class="attendance form-control @error('attendance.' . $key) is-invalid @enderror"
                                                    required>
                                                    <option selected disabled>Select Attendance</option>
                                                    <option value="P"
                                                        {{ old('attendance.' . $key) == 'P' ? 'selected' : '' }}>Present
                                                    </option>
                                                    <option value="A"
                                                        {{ old('attendance.' . $key) == 'A' ? 'selected' : '' }}>Absent
                                                    </option>
                                                    <option value="HD"
                                                        {{ old('attendance.' . $key) == 'HD' ? 'selected' : '' }}>Half Day
                                                    </option>
                                                    <option value="LA"
                                                        {{ old('attendance.' . $key) == 'LA' ? 'selected' : '' }}>Leave
                                                        Application</option>
                                                </select>
                                                @error('attendance.' . $key)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <input type="number" hidden value="{{ $key }}" name="total">
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        @if ($class != null)
                            <div class="row">
                                <div class="col-md-9">

                                </div>
                                <div class="col-md-3 search-student-btn">
                                    <button type="submit" class="btn btn-primary w-75 me-4"
                                        style="background-color:rgb(89, 89, 255)" id="subbtn">Submit</button>
                                </div>
                            </div>
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
            var class_id = $(this).children("option:selected").val();
            window.location.href = '/school/take_student_attendance/' + class_id;
        });

        $(document).ready(function() {

            var holidays = @json($holiday);

            $('#sundaydate').on('dp.show', function() {
                $('.day').each(function() {
                    var fullDate = moment($(this).attr('data-day'));
                    if (fullDate.isValid() && fullDate.day() === 0) {
                        $(this).addClass('disabled');
                    }
                });

            });

            $('#sundaydate').on('dp.change', function(event) {
                var selectedDate = event.date.format('YYYY-MM-DD');

                var holiday = holidays.find(function(h) {
                    return h.holidaydate === selectedDate;
                });

                if (holiday) {
                    $('.attendance').prop('disabled', true);
                    $('#subbtn').prop('disabled', true);
                    $('#holidaytext').text(holiday.holidayname);
                    $('#holidayline').show();
                } else {
                    $('.attendance').prop('disabled', false);
                    $('#subbtn').prop('disabled', false);
                    $('#holidaytext').text('');
                    $('#holidayline').hide();
                }

            });

            // Find the option with the old value and change its color
            $('#attendance-dropdown option').each(function() {
                if ($(this).val() == oldValue) {
                    $(this).css('color', 'red'); // Change color to red or any color you prefer
                }
            });
        });
    </script>
@endsection
