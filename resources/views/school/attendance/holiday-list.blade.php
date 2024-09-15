@extends('school.layouts.master')
@section('content')


    <style>
        .table tr th,
        td {
            border: solid rgb(196, 196, 196) 1px;

        }

        .card-table .card-body .table>thead>tr>th{
            border: solid rgb(196, 196, 196) 1px;
        }
    </style>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Holiday List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Class</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Name ...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Class ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="btn" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Holiday List</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a> --}}
                                        <a href="{{ route('add-holiday') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> Add Holiday</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th class="text-start">S.No.</th>
                                            <th class="text-center">Holiday Name</th>
                                            <th class="text-center">Holiday Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($holidays as $key => $value)
                                            <tr>

                                                <td class="text-start">{{ ++$key }}</td>
                                                <td class="text-center">
                                                    <h2>
                                                        <a>{{ $value['holidayname'] }}</a>
                                                    </h2>
                                                </td>
                                                <td class="text-center">
                                                    <h2>
                                                        <a>{{ \Carbon\Carbon::parse($value->holidaydate)->format('d-m-Y') }}</a>
                                                    </h2>
                                                </td>
                                                <td class="text-center">
                                                    <div class="actions">
                                                        <a href="{{ route('edit-holiday', $value->id) }}"
                                                            class="btn btn-sm bg-danger-light me-2"style="background-color: green !important; color:white !important;">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a href="{{ route('remove-holiday', $value->id) }}"
                                                            class="btn btn-sm bg-danger-light me-2"style="background-color: red !important; color:white !important;">
                                                            <i class="feather-trash"></i>
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

@section('script')
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
    </script>
@endsection
@endsection
