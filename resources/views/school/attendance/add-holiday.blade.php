@extends('school.layouts.master')
@section('content')

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Holiday</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Holiday</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($record != null)
                                <form action="{{ route('update-holiday') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Holiday Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Holiday Name <span class="login-danger">*</span></label>
                                                <input type="text" name="id" value="{{ $record->id }}" hidden>
                                                <input type="text"
                                                    class="form-control @error('holiday_name') is-invalid @enderror "
                                                    name="holiday_name" value="{{ $record->holidayname }}">
                                                @error('holiday_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Holiday Date <span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control datetimepicker @error('date') is-invalid @enderror"
                                                    placeholder="DD-MM-YYYY" name="date" value="{{ \Carbon\Carbon::parse($record->holidaydate)->format('d-m-Y') }}">
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Update Holiday</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <form action="{{ route('save-holiday') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Holiday Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Holiday Name <span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('holiday_name') is-invalid @enderror "
                                                    name="holiday_name" value="{{ old('holiday_name') }}">
                                                @error('holiday_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Holiday Date <span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control datetimepicker @error('date') is-invalid @enderror"
                                                    placeholder="DD-MM-YYYY" name="date" value="{{ old('date') }}">
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Submit Holiday</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif

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
