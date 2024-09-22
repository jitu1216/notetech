@extends('school.layouts.master')
@section('content')


    <style>
        /* Target the timepicker input field */
        .form-control.datetimepicker-input.timepicker {
            position: relative;
            padding-right: 50px;
            padding-left: 10px;
            font-size: 14px;
            height: 38px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            box-shadow: none;
            background-color: #fff;
        }

        /* Style for the clock icon (if you're using one) */
        .form-control.datetimepicker-input.timepicker::after {
            content: '\f017' !important;
            font-family: "FontAwesome";
            position: absolute;
            top: 10px;
            right: 10px;
            color: #6c757d;
            pointer-events: none;
        }

        .form-control.datetimepicker-input.timepicker:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .form-control.datetimepicker-input.timepicker::placeholder {
            color: #6c757d;
            opacity: 1;
        }


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

        .need {
            border: solid red 1px;
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


        /* @if ($check)
        */ .page-wrapper {
            margin-top: -20px !important;
            padding-bottom: 30px;
        }

        .print-header {
            display: inline !important;
            margin-bottom: -50px;
        }

        nav {
            display: none;
        }

        .page-title {
            margin-top: -40px;
        }

        table tr {
            text-align: center;
        }

        .table tr th,
        td {
            border: solid rgb(158, 158, 158) 1px;
            /* padding: 0; */
        }

        .table tr td {
            padding: 0;
            text-align: center;
            /* Centers horizontally */
            vertical-align: middle;
            /* Centers vertically */
        }

        .form-control {
            border-color: white;
        }

        .mult-select-tag .body {
            border: none
        }

        .mult-select-tag .btn-container {
            border: none;
        }

        .mult-select-tag .item-close-svg {
            display: none;
        }

        .mult-select-tag svg {
            display: none;
        }

        .content {
            margin-top: -10px;
        }

        .item-container {
            background-color: white !important;
            border-color: white !important;
        }

        footer {
            display: none;
        }

        .page-header {
            margin-top: -60px;
        }

        #printcontent {
            margin-bottom: 20px;
        }

        /* @endif
        */ @media print {
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

            #menu {
                display: none;
            }

            .header {
                display: none;
            }
        }
    </style>
    <div class="page-wrapper">
        <form action="{{ route('update-time-table') }}" method="post">
            @csrf
            <div class="content container-fluid">
                <div class="print-header">
                    <div class="school">
                        <div class="logo-container">
                            <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="80" height="80">
                        </div>
                        <div class="main-container">
                            <h3>{{ Custom::getSchool()->Name }}</h3>
                            <h6>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                                ({{ Custom::getSchool()->State }})</h6>
                            {{-- <h6>Kainchu Tanda, Amaria Distt. Pilibhit (U.P.)-262121 Mob. 9411484111</h5> --}}
                            <p><span>Email.{{ Custom::getSchool()->Email }}</span> <span>Mobile No.
                                    {{ Custom::getSchool()->Mobile }}</span>
                            </p>

                        </div>
                    </div>
                    <h4>
                        @if ($check)
                            Time Table
                        @endif

                    </h4>
                </div>
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @if ($check)
                            <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:20px;">Print</a>
                        @endif
                        <div class="form-group">
                            <h3 class="page-title text-center">
                                @if (!$check)
                                    Add Time Table
                                @endif
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class=" col-md-3">
                        <div class="form-group">
                            <div class="form-group ">
                                <input type="hidden" id="timetableStatus"
                                    value="{{ $timetable->isNotEmpty() ? 'true' : 'false' }}">
                                <input type="text" name="id" value="{{ $id != null ? $id : '' }}" hidden>

                                <select {{ $checkteacher ? 'disabled' : '' }} name="teacher"
                                    class="form-control @error('teacher') is-invalid @enderror" id="teacher">
                                    <option value="" selected> Select Teacher</option>
                                    @foreach ($staffList as $value)
                                        @if ($id)
                                            <option value="{{ $value->id }}"{{ $id == $value->id ? 'selected' : '' }}>
                                                {{ $check ? 'Teacher Name :- ' : '' }} {{ $value->staff_name }}
                                                ({{ $value->staff_code }})
                                            </option>
                                        @else
                                            <option
                                                value="{{ $value->id }}"{{ old('teacher') == $value->id ? 'selected' : '' }}>
                                                {{ $value->staff_name }} ({{ $value->staff_code }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div id="printcontent">
                    <div class="table table-card">
                        <table class="table">
                            <thead class="table-success text-nowrap">
                                <tr style="">
                                    <th>Period</th>
                                    <th>Time</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @if ($timetable->isNotEmpty())
                                    @php
                                        $k = 0;
                                    @endphp
                                    @for ($i = 1; $i <= 10; $i++)
                                        @php
                                            $timetables = $timetable[$k];
                                            $k++;
                                        @endphp
                                        @if ($i == 5)
                                            <tr>
                                                <td colspan="4" class="text-center bg-primary">
                                                    @if (!$check)
                                                        <div
                                                            class="w-100 d-flex flex-column align-items-center justify-content-center  mb-2">
                                                            <label>Enter Interval Time</label>
                                                            <input
                                                                class=" w-25 form-control @error('interval') is-invalid @enderror"
                                                                name="interval" type="text" placeholder="12:00 To 01:00"
                                                                id="sundaydate" value="{{ $school->interval_time }}">
                                                            @error('interval')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <h5 class="mt-2 mb-0">( {{ $school->interval_time }} )</h5>
                                                        <h5 class="mb-2 mt-0">Interval Time</h5>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                --$k;
                                            @endphp
                                        @else
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td hidden><input type="text" name="row[{{ $i }}]"
                                                        value="{{ $timetables->id }}">
                                                </td>
                                                <td><input
                                                        class="form-control datetimepicker-input timepicker {{ $errors->has('time.' . $i) ? 'is-invalid' : '' }}"
                                                        type="text" name="time[{{ $i }}]"
                                                        value="{{ $timetables->time }}" placeholder="Enter Time"
                                                        data-toggle="datetimepicker" data-target=".timepicker">
                                                </td>
                                                <td class="{{ $errors->has('class.' . $i) ? 'is-invalid' : '' }}"> <select
                                                        class="form-control" name="class[{{ $i }}][]" multiple
                                                        id="classlist_{{ $i }}">
                                                        @php
                                                            $classlist = [];
                                                            $classlist = explode(',', $timetables->class_id);
                                                        @endphp
                                                        <option value="New Class"
                                                            {{ collect($classlist)->contains('New Class') ? 'selected' : '' }}>
                                                            {{ 'New Class' }}
                                                        </option>
                                                        <option value="Nill"
                                                            {{ collect($classlist)->contains('Nill') ? 'selected' : '' }}>
                                                            {{ 'Nill' }}
                                                        </option>
                                                        @foreach ($finalarray as $value)
                                                            <option value="{{ $value['id'] }}"
                                                                {{ collect($classlist)->contains($value['id']) ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td class="{{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}">
                                                    <select
                                                        class="form-control {{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}"
                                                        name="subject[{{ $i }}][]"
                                                        id="subject_{{ $i }}" multiple="multiple">

                                                        @php
                                                            $subjectlist = [];
                                                            $subjectlist = explode(',', $timetables->subjects);
                                                        @endphp

                                                        <option value="Practical"
                                                            {{ collect($subjectlist)->contains('Practical') ? 'selected' : '' }}>
                                                            {{ 'Practical' }}
                                                        </option>
                                                        <option value="Activities"
                                                            {{ collect($subjectlist)->contains('Activities') ? 'selected' : '' }}>
                                                            {{ 'Activities' }}
                                                        </option>
                                                        <option value="Holiday"
                                                            {{ collect($subjectlist)->contains('Holiday') ? 'selected' : '' }}>
                                                            {{ 'Holiday' }}
                                                        </option>
                                                        <option value="Nill"
                                                            {{ collect($subjectlist)->contains('Nill') ? 'selected' : '' }}>
                                                            {{ 'Nill' }}
                                                        </option>

                                                        @foreach ($subject as $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ collect($subjectlist)->contains($value->id) ? 'selected' : '' }}>
                                                                {{ $value->subject_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="number" hidden value="{{ $i }}" name="total">
                                        @endif
                                    @endfor
                                @else
                                    {{-- @for ($i = 1; $i <= 10; $i++)
                                        @if ($i == 5)
                                            <tr>
                                                <td colspan="4" class="text-center bg-primary">
                                                    <h4>Interval</h4>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><input
                                                        class="form-control {{ $errors->has('time.' . $i) ? 'is-invalid' : '' }} "
                                                        type="text" name="time[{{ $i }}]"
                                                        value="{{ old('time.' . $i) }}" placeholder="Enter Time"></td>
                                                <td class="{{ $errors->has('class.' . $i) ? 'is-invalid' : '' }}"> <select
                                                        class="form-control" name="class[{{ $i }}][]" multiple
                                                        id="classlist_{{ $i }}">

                                                        @foreach ($finalarray as $value)
                                                            <option value="{{ $value['id'] }}"
                                                                {{ collect(old('class.' . $i, []))->contains($value['id']) ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td class="{{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}">
                                                    <select
                                                        class="form-control {{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}"
                                                        name="subject[{{ $i }}][]"
                                                        id="subject_{{ $i }}" multiple="multiple">

                                                        @foreach ($subject as $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ collect(old('subject.' . $i, []))->contains($value->id) ? 'selected' : '' }}>
                                                                {{ $value->subject_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="number" hidden value="{{ $i }}" name="total">
                                        @endif
                                    @endfor --}}
                                    <tr>
                                        <td colspan="4">
                                            <h2 class="text-center w-100 text-danger text fs-lg-3">No Data Available</h2>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>


                        {{-- @if ($class != null) --}}
                        <div class="row">
                            <div class="col-md-9">
                            </div>
                            @if (!$check)
                                @if ($timetable->isNotEmpty())
                                    <div class="col-md-3 search-student-btn mt-4">
                                        <button type="submit" class="btn btn-primary w-75 me-4"
                                            style="background-color:rgb(89, 89, 255)" id="subbtn">Update</button>
                                    </div>
                                @endif
                            @endif
                        </div>
                        {{-- @endif --}}

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


        $(document).ready(function() {

            $('.timepicker').datetimepicker({
                format: 'LT',
                icons: {
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    // other icon options
                },
                // useCurrent: false
            });



            var isNotEmpty = $('#timetableStatus').val();
            if (isNotEmpty === 'true') {
                for (let i = 1; i <= 10; i++) {
                    if (i != 5) {
                        new MultiSelectTag('classlist_' + i, {
                            rounded: true, // default true
                            shadow: false, // default false
                            placeholder: 'Search', // default Search...
                            tagColor: {
                                textColor: '#red',
                                borderColor: '#92e681',
                                bgColor: '#eaffe6',
                            },
                            onChange: function(values) {
                                console.log(values)
                            }
                        })
                        new MultiSelectTag('subject_' + i, {
                            rounded: true, // default true
                            shadow: false, // default false
                            placeholder: 'Search', // default Search...
                            tagColor: {
                                textColor: '#red',
                                borderColor: '#92e681',
                                bgColor: '#eaffe6',
                            },
                            onChange: function(values) {
                                console.log(values)
                            }
                        })

                    }
                }
            }

            $('#printbtn').on('click', function() {
                event.preventDefault();
                window.print()
            });

            $('td.is-invalid').each(function() {
                console.log('Get');
                $(this).find('.mult-select-tag').addClass('need');
            });

            var phpVar = "{{ $check }}";

            $("#teacher").change(function() {
                var teacher = $(this).val();
                if (teacher == '') {
                    alert('Please Select Teacher');
                } else {
                    if (phpVar) {
                        window.location.href = '/school/view-time-table/' + teacher;

                    } else {
                        window.location.href = '/school/edit-time-table/' + teacher;
                    }
                }
            });
        });
    </script>
@endsection
