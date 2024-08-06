@extends('superadmin.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">School List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">School List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-group-form">
                <form action="{{ route('searchSchool') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usercode"
                                    @if (!empty($usercode)) value="{{ $usercode }}" @endif
                                    placeholder="Search by UserCode ...">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="school"
                                    @if (!empty($school)) value="{{ $school }}" @endif
                                    placeholder="Search by School Name ...">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group">
                                <input @if (!empty($mobile)) value="{{ $mobile }}" @endif type="text"
                                    class="form-control" name="mobile" placeholder="Search by Phone ...">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input @if (!empty($state)) value="{{ $state }}" @endif type="text"
                                    class="form-control" name="state" placeholder="Search by State or City ...">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">School List</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                                class="feather-list"></i></a> --}}
                                        {{-- <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a> --}}
                                        <a href="{{ route('exportList') }}" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ route('add-school')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            {{-- <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox"
                                                    value="something">
                                            </div>
                                        </th> --}}
                                            <th>S.No.</th>
                                            <th>Logo</th>
                                            <th>UserCode</th>
                                            <th>School Name</th>
                                            <th>Account Start Date</th>
                                            <th>Account Expiry Date</th>
                                            <th>User Name</th>
                                            <th>User Type</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Address</th>
                                            <!--<th>State</th>-->
                                            <!--<th>City</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($schoolList as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::to('images') . '/' . $value->Logo }}"
                                                                alt="Logo" width="10" height="10"></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $value->UserCode }}</td>
                                                <td>{{ $value->Name }}</td>
                                                <td>{{ $value->Start_Date }}</td>
                                                <td style="color:red;">{{ $value->Expiry_Date }}</td>
                                                <td>{{ $value->Username }}</td>
                                                <td>{{ $value->Usertype }}</td>
                                                <td>{{ $value->Email }}</td>
                                                <td>{{ $value->Mobile }}</td>
                                                 <td>{{ $value->Address . ', ' . $value->City.' (' . $value->State .')' }}
                                                </td>
                                                <!--<td>{{ $value->Address }}</td>-->
                                                <!--<td>{{ $value->State }}</td>-->
                                                <!--<td>{{ $value->City }}</td>-->
                                                <td class="text-end">
                                                    <div class="actions ">
                                                        {{-- <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "  style="background-color: rgb(5, 136, 197) !important; color:white !important;">
                                                            <i class="feather-eye"></i>
                                                        </a> --}}
                                                        <a href="{{ route('updateSchool') . '/' . $value->id }}"
                                                            class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-sm bg-success-light me-2 "
                                                            style="background-color: rgb(197, 0, 0) !important; color:white !important;">
                                                            <i data-src="{{ URL::to('images') . '/' . $value->Logo }}"
                                                                data-id="{{ $value->id }}"
                                                                data-name="{{ $value->Name }}"class="feather-trash-2 school_delete"></i>
                                                        </a>
                                                        <a href="{{ url('school/schooldashboard') . '/' . $value->id }}" class="btn btn-sm bg-success-light me-2"
                                                            style="background-color: rgb(67, 18, 245) !important; color:white !important;">
                                                            <i class="feather-log-in"></i>
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
                    <form action="{{ route('schoolDelete') }}" method="POST">
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


@section('script')
    {{-- delete js --}}
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
            $('.school_delete').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var src = $(this).data('src');

                $(".id").val(id);
                $('.modalimg').attr("src", src);
                $('.name').text(name);
                $('#schoolRecord').modal('show');
            });
        });
    </script>
@endsection

@endsection
