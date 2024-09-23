@extends('school.layouts.master')
@section('content')
    <style>
        .table tr th,
        td {
            border: solid rgb(196, 196, 196) 1px;

        }

        .card-table .card-body .table>thead>tr>th {
            border: solid rgb(196, 196, 196) 1px;
        }

        .container {
            padding: 20px;
            margin: 0px;
            max-width: 100%;
            width: 100%;
        }
    </style>
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Exam Scheme List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Scheme</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="{{ 'add-scheme' }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>Add Scheme</a>
                            </h3>
                            @if (session('status'))
                                <h5 class="alert alert-success">{{ session('status') }}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                                    <thead class="no-wrap text-center">
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Exam Type</th>
                                            <th>Date</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" no-wrap text-center">
                                        @foreach ($scheme as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->exam_type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d-m-Y') }}</td>
                                                <td>{{ $item->exam_class }}</td>
                                                <td>{{ $item->exam_subject }}</td>
                                                <td>
                                                    <a href="{{ 'edit-scheme/' . $item->id }}"
                                                        class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                        <i class="feather-edit"></i></a>
                                                    <a href="{{ 'removescheme/' . $item->id }}"
                                                        class="btn btn-sm bg-danger me-2"style=" !important; color:white !important;">
                                                        <i class="feather-trash"></i></a>
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
