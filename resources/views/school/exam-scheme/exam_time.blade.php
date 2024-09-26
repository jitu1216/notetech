@extends('school.layouts.master')
@section('content')
    <style>
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
                <div class="row align-item-center">
                    <div class="col">
                        <h3>Add Exam Timing</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('exam-time') }}">Add Exam Timing </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status') }}</h5>
                @endif
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-body mt-4">
                            <div class="row">
                                <form action="{{ route('save-exam-time') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Test Exam Time<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('test_exam_time') is-invalid @enderror"
                                                        name="test_exam_time" placeholder="Enter Test Exam Time"
                                                        value="{{ $data->test_exam_time }}" id="">
                                                    @error('test_exam_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Monthly Exam Time<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('monthly_exam_time') is-invalid @enderror"
                                                        name="monthly_exam_time" placeholder="Enter Monthly Exam Time"
                                                        value="{{ $data->monthly_scheme_time }}" id="">
                                                    @error('monthly_exam_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Quaterly Exam Time<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('quaterly_exam_time') is-invalid @enderror"
                                                        name="quaterly_exam_time" placeholder="Enter Quaterly Exam Time"
                                                        value="{{ $data->quarter_scheme_time }}" id="">
                                                    @error('quaterly_exam_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Half Exam Time<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('half_exam_time') is-invalid @enderror"
                                                        name="half_exam_time" placeholder="Enter Half Exam Time"
                                                        value="{{ $data->half_scheme_time }}" id="">
                                                    @error('half_exam_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Annual Exam Time<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('annual_exam_time') is-invalid @enderror"
                                                        name="annual_exam_time" placeholder="Enter Annual Exam Time"
                                                        value="{{ $data->annual_scheme_time }}" id="">
                                                    @error('annual_exam_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="submit w-25">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
