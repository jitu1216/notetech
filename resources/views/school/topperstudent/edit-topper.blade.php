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
                        <h3>Add Topper Student</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('topper-student') }}">Topper List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="{{ route('topper-student') }}" class="btn btn-primary">
                                    <i class="fas fa-back"></i>Back</a>
                            </h3>
                            @if (session('status'))
                                <h5 class="alert alert-success">{{ session('status') }}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('savetopper') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <input type="text" value="{{-- $studentList->id --}}1" name="student_id" hidden>
                                                <input type="text" value="{{-- $studentList->class_id --}}0" name="class_id" hidden>
                                                <div class="form-group local-forms">
                                                    <label>Total Obtain Mark<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('total_mark_obtain') is-invalid @enderror"
                                                        name="total_mark_obtain" placeholder="Enter Total Obtain Mark"
                                                        value="{{ $topper->total_mark_obtain }}" id="">
                                                    @error('')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Total Subject<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('total_subject') is-invalid @enderror"
                                                        name="total_subject" placeholder="Enter Total Subject"
                                                        value="{{ $topper->total_subject }}" id="">
                                                    @error('')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Rank<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('rank') is-invalid @enderror"
                                                        name="rank" placeholder="Enter Rank Here"
                                                        value="{{ $topper->rank }}" id="">
                                                    @error('')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="submit">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
