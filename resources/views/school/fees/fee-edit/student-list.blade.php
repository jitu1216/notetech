@extends('school.layouts.master')
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

    .std_image img{
        height: 45px;
        width: 45px;
        border-radius: 50%;
        object-fit: cover;
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


    @media print {
        .page-wrapper {
            margin-top: 0px !important;
        }

        .table {
            font-size: 10px;
        }

        .std_image{
            display: none;
        }

        .header {
            display: none;
        }

        nav {
            display: none;
        }

        .main-container h6 {
            margin-bottom: -3px;
            font-weight: 600 !important;
            color: rgb(67, 169, 253);
        }

        .main-container h3 {
            margin-bottom: -2px;
        }

        .print-header {
            display: inline !important;
        }

        .page-header,
        .action {
            display: none;
        }

        #searchlist {
            display: none;
        }
    }
</style>
@section('content')
    <div class="page-wrapper">
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
                    @if ($mark == 1)
                        List of All Pending Students
                    @elseif ($mark == 2)
                        List of All Approved Students
                    @elseif ($mark == 3)
                        List of All Rejected Students
                    @else
                        List of All Deleted Students
                    @endif

                </h4>
            </div>

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">
                                @if ($mark == 1)
                                    Pending Student List
                                @elseif ($mark == 2)
                                    Approved Student List
                                @elseif ($mark == 3)
                                    Rejected Students List
                                @else
                                    Deleted Students List
                                @endif
                            </h3>

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Student</a></li>
                                <li class="breadcrumb-item active">
                                    @if ($mark == 1)
                                        Pending Student List
                                    @elseif ($mark == 2)
                                        Approved Student List
                                    @elseif ($mark == 3)
                                        Rejected Students List
                                    @else
                                        Deleted Students List
                                    @endif
                                </li>
                            </ul>
                            <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:20px;">Print</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-group-form" id="searchlist">
                <form action="{{ route('feesearchStudent') }}" method="get">
                    @csrf
                    <div class="row">
                        <div class=" col-md-5">
                            <div class="form-group">
                                <input @if (!empty($studentsearch)) value="{{ $studentsearch }}" @endif type="text"
                                    class="form-control" name="studentsearch" placeholder="Search Student ...">
                                <input value="{{ $mark }}" type="text" class="form-control" name="searchId"
                                    hidden>
                            </div>

                        </div>
                        <div class=" col-md-5">
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
                    </div>
                </form>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}

            <div id="printcontent">

                <div class="table table-card">
                    <table class="table">
                        <thead class="table-success text-nowrap">
                            <tr style="">
                                <th>S.No</th>
                                <th class="std_image">Image</th>
                                @if ($mark == 2)
                                    <th>Student Id No.</th>
                                    <th>Roll No.</th>
                                @else
                                    <th>Application No.</th>
                                @endif
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Class</th>
                                <th>Address</th>
                                {{-- <th>Email</th> --}}
                                <th>Mobile</th>
                                @if ($mark == 4)
                                    <th class="action">Recover</th>
                                @else
                                    <th class="action">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">


                            @if (Custom::getStaffRole() == 'Assistant Teacher')
                                @foreach ($studentList as $key => $data)
                                    @foreach (Custom::getTeacherClass() as $allot_class)
                                        @if ($allot_class == $data->class_id)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="std_image avatar-img rounded-circle"><img src="{{ URL::to('student-photos') . '/' . $data->image }}"  sizes="height:25px; width:25px;"></td>
                                                @if ($mark == 2)
                                                    <td>{{ $data->student_id }}</td>
                                                    <td>{{ $data->roll_no }}</td>
                                                @else
                                                    <td>{{ $data->application_no }}</td>
                                                @endif

                                                <td>{{ $data->student_name }}</td>
                                                <td>{{ $data->father_name }}</td>
                                                <td>{{ $data->mother_name }}</td>
                                                <td>{{ $data->classname }}</td>
                                                <td>{{ $data->locality_type . ' ' . $data->village . ',' . $data->post_type . ' ' . $data->town . ' (' . $data->district . '),' . $data->pincode . ' ' . $data->state }}
                                                </td>
                                                {{-- <td>{{ $data->email }}</td> --}}
                                                <td>{{ $data->mobile }}</td>
                                                <td class="action">
                                                    @if ($mark == 4)
                                                        <div class="actions">
                                                            <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                                style="background-color: rgb(0, 197, 0) !important; color:white !important;">
                                                                <i data-src="{{ URL::to('student-photos') . '/' . $data->image }}"
                                                                    data-id="{{ $data->id }}"
                                                                    data-name="{{ $data->student_name }}"class="feather-upload recover-btn"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="actions">
                                                            <a href="{{ url('school/edit-fees') . '/' . $data->id }}"
                                                                class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                            {{-- <a href="{{ url('school/printstudent') . '/' . $data->id }}"
                                                        class="btn btn-sm bg-danger-light me-2"style="background-color: orange !important; color:white !important;">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                        style="background-color: rgb(197, 0, 0) !important; color:white !important;">
                                                        <i data-src="{{ URL::to('student-photos') . '/' . $data->image }}"
                                                            data-id="{{ $data->id }}"
                                                            data-name="{{ $data->student_name }}"class="feather-trash-2 school_delete"></i>
                                                    </a> --}}
                                                        </div>
                                                    @endif

                                                </td>

                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($studentList as $key => $data)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td class="std_image avatar-img rounded-circle"><img src="{{ URL::to('student-photos') . '/' . $data->image }}"  sizes="height:25px; width:25px;"></td>
                                        @if ($mark == 2)
                                            <td>{{ $data->student_id }}</td>
                                            <td>{{ $data->roll_no }}</td>
                                        @else
                                            <td>{{ $data->application_no }}</td>
                                        @endif

                                        <td>{{ $data->student_name }}</td>
                                        <td>{{ $data->father_name }}</td>
                                        <td>{{ $data->mother_name }}</td>
                                        <td>{{ $data->classname }}</td>
                                        <td>{{ $data->locality_type . ' ' . $data->village . ',' . $data->post_type . ' ' . $data->town . ' (' . $data->district . '),' . $data->pincode . ' ' . $data->state }}
                                        </td>
                                        {{-- <td>{{ $data->email }}</td> --}}
                                        <td>{{ $data->mobile }}</td>
                                        <td class="action">
                                            @if ($mark == 4)
                                                <div class="actions">
                                                    <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                        style="background-color: rgb(0, 197, 0) !important; color:white !important;">
                                                        <i data-src="{{ URL::to('student-photos') . '/' . $data->image }}"
                                                            data-id="{{ $data->id }}"
                                                            data-name="{{ $data->student_name }}"class="feather-upload recover-btn"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="actions">
                                                    <a href="{{ url('school/edit-fees') . '/' . $data->id }}"
                                                        class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ url('school/printstudent') . '/' . $data->id }}"
                                                class="btn btn-sm bg-danger-light me-2"style="background-color: orange !important; color:white !important;">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                style="background-color: rgb(197, 0, 0) !important; color:white !important;">
                                                <i data-src="{{ URL::to('student-photos') . '/' . $data->image }}"
                                                    data-id="{{ $data->id }}"
                                                    data-name="{{ $data->student_name }}"class="feather-trash-2 school_delete"></i>
                                            </a> --}}
                                                </div>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>


                </div>
            </div>



        </div>
    </div>

    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="schoolRecord" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('deletestudent') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            {{-- <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div> --}}
                            <input type="hidden" name="id" class="id" value="">
                            <h4 style="color:rgb(107, 107, 107)">Sure you want to delete ?</h4>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-12">
                                    <img class="avatar-img modalimg rounded-circle" src="" alt="Logo"
                                        width="50" height="50">
                                </div>
                                <div class="col-md-8 mt-2">
                                    <h4 class="name text-left"></h4>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade contentmodal" id="recoverstudent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('recoverstudent') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            {{-- <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div> --}}
                            <input type="hidden" name="id" class="recoverId" value="">
                            <h4 style="color:rgb(107, 107, 107)">Sure you want to Recover Student ?</h4>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-12">
                                    <img class="avatar-img recoverimg rounded-circle" src="" alt="Logo"
                                        width="50" height="50">
                                </div>
                                <div class="col-md-8 mt-2">
                                    <h4 class="recovername text-left"></h4>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        $(document).ready(function() {
            $('.school_delete').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var src = $(this).data('src');

                $(".id").val(id);
                $('.modalimg').attr("src", src);
                $('.name').text(name);
                $('#schoolRecord').modal('show');
            });

            $('.recover-btn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var src = $(this).data('src');

                $(".recoverId").val(id);
                $('.recoverimg').attr("src", src);
                $('.recovername').text(name);
                $('#recoverstudent').modal('show');
            });
        });
    </script>
@endsection
