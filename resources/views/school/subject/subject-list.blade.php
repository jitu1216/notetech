@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subject List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subject List</li>
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
                                        <h3 class="page-title">Subject List</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a> --}}
                                        <a href="{{ route('add-subject') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Subject</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th class="text-start">S.No.</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">FA 1</th>
                                            <th class="text-center">FA 2</th>
                                            <th class="text-center">SA 1</th>
                                            <th class="text-center">SA 2</th>
                                            <th class="text-center">Practicle</th>
                                            <th class="text-center">Session Year</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $key => $value)
                                        <tr>

                                            <td class="text-start">{{ ++$key }}</td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->subject_name}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->FA1}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->FA2}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->SA1}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->SA2}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->practicle}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <h2>
                                                    <a>{{ $value->academic_session}}</a>
                                                </h2>
                                            </td>
                                            <td class="text-center">
                                                <div class="actions">
                                                    <a href="{{ route('view-subject') . '/'. $value->id }}"
                                                        class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                        <i class="feather-edit"></i>
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
