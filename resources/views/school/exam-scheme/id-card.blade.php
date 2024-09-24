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

        .page-header {
            background-color: white;
            padding-bottom: 10px
        }

        .id-card {
            background-color: white;
            border: solid red;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;

        }

        .school {
            text-align: center;
        }

        .main-container h5 {
            font-weight: 800 !important;
            font-size: 17px;
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
                width: 2.1in;
                height: 3.2in;

            }

            .main-container h5 {
                font-weight: 800 !important;
                font-size: 12px;
                margin-bottom: -2px;
                color: rgb(219, 0, 0);
            }

            .main-container p span {
                font-size: 7px;
                color: black;
                margin-left: 8px;
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
                        <h3>ID CARD</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{-- route('') --}}">Id Card List</a></li>
                        </ul>
                    </div>
                </div>

                <div class="student-group-form p-4" id="searchlist">
                    <form action="{{ route('searchidcard') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input @if (!empty($studentsearch)) value="{{ $studentsearch }}" @endif type="text" 
                                        class="form-control" name="studentsearch" placeholder="Search Student ...">
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
                                    <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:0px;">Print</a>
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
                                    <div class="">
                                        <div class="school">
                                            <div class="logo-container">
                                                <img src="{{ URL::to('images/1680626594.jpg') }}" alt=""
                                                    width="60" height="60">
                                            </div>
                                            <div class="main-container">
                                                <h5>{{ Custom::getSchool()->Name }}</h5>
                                                <p>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                                                    ({{ Custom::getSchool()->State }})
                                                    <br><span>Mobile No.
                                                        {{ Custom::getSchool()->Mobile }}</span>
                                                    <span> Session {{ Session::get('academic_session') }}</span>
                                                </p>
                                                <h6>ID CARD</h6>
                                            </div>
                                            <div class="student-image">
                                                <img src="{{ URL::to('student-photos') . '/' . $item->image }}" width="60" height="70" style="margin-bottom: 5px;"alt="student image">
                                                <h6>{{ $item->student_name }}</h6>
                                            </div>
                                        </div>
                                        <div class="student-info row  d-flex justify-content-center">
                                            <div class="row">
                                                <div class="col-6">Father Name</div>
                                                <div class="col-6">{{ $item->father_name }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">Class</div>
                                                <div class="col-6">{{ Custom::getClass($item->class_id)->classname }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">Id No.</div>
                                                <div class="col-6">{{ $item->student_id }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">D.O.B.</div>
                                                <div class="col-6">{{ $item->dob }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">Address</div>
                                                {{-- <div class="col-6">{{ $item->locality_type . ' ' . $item->village . ',' . $item->post_type . ' ' . $item->town . ' (' . $item->district . '),' . $item->pincode . ' ' . $item->state }}</div> --}}
                                                <div class="col-6">{{ $item->locality_type . ' ' . $item->village }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">Mobile Number</div>
                                                <div class="col-6">{{ $item->mobile }}</div>
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
