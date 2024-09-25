@extends('school.layouts.master')
@section('content')
<style>
    .container {
        padding: 20px;
        margin: 0px;
        max-width: 100%;
        width: 100%;
        /* */
    }

    .main-detail {
        margin-top: -75px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .main-detail div {
        margin-bottom: 3px;
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
    }

    .sign{
        display: flex;
        justify-content: space-between;
    }

    .page-header {
        background-color: white;
        padding-bottom: 10px
    }

    .id-card {
        background-color: white;
        border: solid red;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 600px;

    }

    .school {
        margin-top: -15px;
    }

    .main-container {
        text-align: center;
        margin-top: -42px
    }

    .content,
    .content-2 {
        white-space: nowrap;
        display: flex;
        justify-content: space-between;
        margin-top: -7px;
    }

    .content p {
        font-weight: 600 !important;
        font-size: 14px;
        margin-bottom: -2px;
        color: rgb(219, 0, 0);
        margin-top: 5px;
    }

    .content-2 p {
        font-weight: 600 !important;
        font-size: 14px;
        margin-bottom: -2px;
        color: black;
        margin-top: -4px;
    }

    .main-container h5 {
        font-weight: 800 !important;
        font-size: 22px;
        margin-bottom: -2px;
        color: rgb(219, 0, 0);
    }

    .main-container p {
        font-size: 12px;
        color: blue;
        margin-right: 5px;
    }

    .main-container p span {
        font-size: 10px;
        color: black;
        margin-left: 12px;
    }

    .subject {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 10px !important;
        line-height: 0.9;
    }

    .subject span {
        font-size: 13px;
        /* margin-right: 15px; */
        white-space: nowrap;
    }

    .student-info {
        white-space: nowrap;
        text-align: left;
        margin-top: -30px;
    }

    .student-image {
        display: flex;
        justify-content: right;
        margin-top: 15px;

    }

    .studentcontent {
        margin-top: -60px;

    }

    .col6 {
        margin-right: -40px;
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
            margin-top: -75px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .main-detail div {
            margin-bottom: 1px;
        }


        /* .main-card:nth-child(9n),
                                    .main-card:nth-child(9n + 1),
                                    .main-card:nth-child(9n + 2) {
                                        margin-top: 50px;
                                    } */

        .id-card {
            background-color: white;
            border: solid red;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 7in;
            height: 3in;

        }

        .id-card-body {
            margin-top: 0px;
        }


        .school {
            margin-top: -15px;
        }

        .main-container {
            text-align: center;
            margin-top: -42px
        }

        .content,
        .content-2 {
            white-space: nowrap;
            display: flex;
            justify-content: space-between;
        }

        .content p {
            font-weight: 600 !important;
            font-size: 14px;
            margin-bottom: -2px;
            color: rgb(219, 0, 0);
            margin-top: 5px;
        }

        .content-2 p {
            font-weight: 600 !important;
            font-size: 14px;
            margin-bottom: -2px;
            color: black;
            margin-top: -4px;
        }

        .main-container h5 {
            font-weight: 800 !important;
            font-size: 18px;
            margin-bottom: -2px;
            color: rgb(219, 0, 0);
        }

        .main-container p {
            font-size: 10px;
            color: blue;
            margin-right: 5px;
        }

        .main-container p span {
            font-size: 10px;
            color: black;
            margin-left: 12px;
        }

        .student-info {
            white-space: nowrap;
            text-align: left;
        }

        .student-image {
            display: flex;
            justify-content: right;
            margin-top: 15px;

        }

        .studentcontent {
            margin-top: -60px;

        }

        .col6 {
            margin-right: -40px;
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
                        <h3>Admit Card</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{-- route('') --}}">Admit Card List</a></li>
                        </ul>
                    </div>
                </div>

                <div class="student-group-form p-4" id="searchlist">
                    <form action="{{ route('searchadmitcard') }}" method="get">
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
                            <div class="card bg-common id-card" style="background-color: white;">
                                <div class="card-body">
                                    <div class="id-card-body">
                                        <div class="school">
                                            <div class="logo-container">
                                                <img src="{{ URL::to('images/1680626594.jpg') }}" alt=""
                                                    width="45" height="40">
                                            </div>
                                            <div class="main-container">
                                                <h5>{{ Custom::getSchool()->Name }}</h5>
                                                <p>{{ Custom::getSchool()->Address }}, {{ Custom::getSchool()->City }}
                                                    ({{ Custom::getSchool()->State }})
                                                    {{-- <br><span>Mobile No.
                                                        {{ Custom::getSchool()->Mobile }}</span> --}}
                                                </p>

                                            </div>
                                            <div class="content ">
                                                <p>CLASS {{ Custom::getClass($item->class_id)->classname }} </p>
                                                <p> {{-- $text --}}HALF YEARLY(ADMIT CARD)</p>
                                                <p>Session {{ Session::get('academic_session') }}</p>
                                            </div>
                                            <hr style="margin-top: 2px;">
                                            <div class="content-2 ">
                                                <p>S.R. NO.- {{ $item->sr_no }} </p>
                                                <p>STUDENT ID- {{ $item->student_id }} </p>
                                                <p>ROLL NO- {{ $item->roll_no }} </p>
                                            </div>

                                        </div>
                                        <div class="student-info">
                                            <div class="student-image">
                                                <img src="{{ URL::to('student-photos') . '/' . $item->image }}"
                                                    width="80" height="100" alt="student image">
                                            </div>
                                            <div class="main-detail">
                                                <div class="row studentcontent">
                                                    <div class="col-4">Exam Centre Name</div>
                                                    <div class="col-8"> {{ Custom::getSchool()->Name }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">Student Name</div>
                                                    <div class="col-8">{{ $item->student_name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">Father Name</div>
                                                    <div class="col-8">{{ $item->father_name }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">Mother Name</div>
                                                    <div class="col-8">{{ $item->mother_name }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">D.O.B.</div>
                                                    <div class="col-8">{{ $item->dob }}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">Exam Subject</div>
                                                    <div class="col-8 subject">
                                                        @foreach (Custom::getAdmitCardSubject($item->class_id) as $value)
                                                            <span>{{ $value->exam_subject }}
                                                                ({{ \Carbon\Carbon::parse($value->exam_date)->format('d/m/y') }})
                                                                ,</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sign ">

                                                <p>PRINCIPLE SIGN</p>
                                                <p>STUDENT SIGN </p>
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
