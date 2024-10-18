@extends('studentDashboard.layouts.master')
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

        .overflow-text {
            width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin: 0;
            /* Ensure no margin is added */
        }
    </style>
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Notice List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('student') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notice list</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="#" class="btn btn-primary">
                                    <i class=""></i> Notice</a>
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
                                            <th>Date</th>
                                            <th>Notice</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" wrap text-center">
                                        @foreach ($notice as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
                                                <td>
                                                    <p class="overflow-text" style="width: 350px;">{{ $value->notice_text }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('student-notice-for-all', $value->id) }}"
                                                        class="btn btn-sm btn-success me-2"style=" color:white !important;">
                                                        <i class="feather-eye"></i></a>
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
