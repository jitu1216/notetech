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
                    List of All Staff
                </h4>
            </div>

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">
                                List of All Staff
                            </h3>

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Student</a></li>
                                <li class="breadcrumb-item active">

                                    List of All Staff

                                </li>
                            </ul>
                            <a id="printbtn" href="" class=" btn btn-primary" style="margin-left:20px;">Print</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-group-form" id="searchlist">
                <form action="{{ route('searchStaff') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class=" col-md-10">
                            <div class="form-group">
                                <input @if (!empty($staffsearch)) value="{{ $staffsearch }}" @endif type="text"
                                    class="form-control" name="staffsearch" placeholder="Search Staff By Name,Code, Father/Husband Name, Address,City,State  ...">
                                {{-- <input value="{{ $mark }}" type="text" class="form-control" name="searchId"
                                    hidden> --}}
                            </div>

                        </div>
                        {{-- <div class=" col-md-5">
                            <div class="form-group">
                                <div class="form-group ">
                                    <select class="form-control select  @error('category') is-invalid @enderror"
                                        name="Class">

                                        <option selected value="">All Class</option>
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
                                                    {{ old('Class') == 'I' ? 'selected' : '' }}>{{ $value['classname'] }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> --}}
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
                                <th>Staff Code</th>
                                <th>Staff Name</th>
                                <th>Father/Husband Name</th>
                                <th>Address</th>
                                <th>Mobile No.</th>
                                <th>Appointment Date</th>
                                <th>Qualification</th>
                                <th>Experience Qualification</th>
                                <th>Date of Birth</th>
                                <th>Work Permission</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            @foreach ($staffList as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->staff_code }}</td>
                                    <td>{{ $data->staff_name }}</td>
                                    <td>{{ $data->father_name }}</td>
                                    <td>{{ $data->locality_type.' '. $data->village . ',' .$data->post_type.' '. $data->town . ' (' . $data->city .'),'.$data->pincode.' '.$data->state }}</td>
                                    <td>{{ $data->mobile }}</td>
                                    <td>{{ $data->appointment_date }}</td>
                                    <td>{{ $data->qualification }}</td>
                                    <td>{{ $data->experience_qualification }}</td>
                                    <td>{{ $data->date_of_birth }}</td>
                                    <td>{{ $data->appointment_position }}</td>


                                    <td class="action">

                                        {{-- <div class="actions">
                                            <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                style="background-color: rgb(0, 197, 0) !important; color:white !important;">
                                                <i data-src="{{ URL::to('student-photos') . '/' . $data->image }}"
                                                    data-id="{{ $data->id }}"
                                                    data-name="{{ $data->student_name }}"class="feather-upload recover-btn"></i>
                                            </a>
                                        </div> --}}

                                        <div class="actions">
                                            <a href="{{ url('school/view-staff') . '/' . $data->id }}"
                                                class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                <i class="feather-edit"></i>
                                            </a>
                                            {{-- <a href="{{ url('school/printstudent') . '/' . $data->id }}"
                                                class="btn btn-sm bg-danger-light me-2"style="background-color: orange !important; color:white !important;">
                                                <i class="feather-eye"></i>
                                            </a> --}}
                                            <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                style="background-color: rgb(197, 0, 0) !important; color:white !important;">
                                                <i data-src="{{  URL::to('images') . '/' . $data->image  }}"
                                                    data-id="{{ $data->id }}"
                                                    data-name="{{ $data->staff_name }}"class="feather-trash-2 school_delete"></i>
                                            </a>
                                        </div>


                                    </td>

                                </tr>
                            @endforeach


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
                    <form action="{{ route('deletestaff') }}" method="POST">
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
