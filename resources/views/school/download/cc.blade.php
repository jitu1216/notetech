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
            width: 500px;
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
                height: 3.3in;

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

            .main-box{
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
                        <h3>Character Certificate</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{-- route('') --}}">C.C. List</a></li>
                        </ul>
                    </div>
                </div>

                <div class="student-group-form p-4" id="searchlist">
                    <form action="{{ route('search-cc') }}" method="get">
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

            <div class="content container-fluid">
                <div class="main-row">
                    @foreach ($studentList as $item)
                        {{-- @for ($i = 1; $i <= 51; $i++) --}}
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
                                            <h6 class="title">Character Certificate</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-box">
                                    <div class="row content">
                                        <div class="col-12 mb-2">
                                            S.R. No.- {{ $item->sr_no }}
                                        </div>
                                        <div class="col-12" style="padding-left: 65px;">This is certified that
                                            <span
                                                style="padding-left: 25px; font-weight: bold;
                                            font-size: 14px;padding-right: 25px; ">{{ $item->student_name }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                S/o/D/o <span
                                                    style="padding-left: 10px; padding-right: 10px; font-weight: bold;
                                                font-size: 14px;">Mr.
                                                    {{ $item->father_name }}</span>
                                            </div>
                                            <div class="col-6">
                                                village- <span
                                                    style="padding-left: 10px; padding-right: 10px;  font-weight: bold;
                                            font-size: 14px;">{{ $item->village }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                Post- <span
                                                    style="padding-left: 10px;font-weight: bold;
                                                font-size: 15px;">
                                                    {{ $item->town }} </span>
                                            </div>
                                            <div class="col-4">
                                                District- <span
                                                    style="padding-left: 10px; font-weight: bold;
                                            font-size: 14px;">{{ $item->district }}</span>
                                            </div>
                                            <div class="col-4">
                                                Class <span
                                                    style="padding-left: 10px;font-weight: bold;
                                                font-size: 14px;">
                                                    {{ Custom::getClass($item->class_id)->classname }}</span>
                                            </div>

                                        </div>
                                        {{-- <div class="row">

                                        </div> --}}
                                        <div class="row">
                                            <div class="col-5">
                                                Year ............ at School.
                                            </div>
                                            <div class="col-7" style="padding-left: 10px;">Student date of Birth
                                                <span
                                                    style="padding-left: 15px;font-weight: bold;
                                        font-size: 14px;">{{ $item->dob }}</span>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-6">According to record..............</div>
                                            <div class="col-6" style="padding-left: 25px;">His conduct.................
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-9">
                                                Date
                                            </div>
                                            <div class="col-3" style="padding-left: 15px;">
                                                Principal
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @endfor --}}
                    @endforeach
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
