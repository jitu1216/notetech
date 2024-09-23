@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-item-center">
                    <div class="col">
                        <h3>Add Exam Scheme Class</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('scheme_list') }}">Scheme Class List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-header">
                            <h3 class="Info">
                                 <a href="{{ route('scheme_list') }}" class="btn btn-primary">
                                    <i class="fas fa-back"></i>Back</a>
                            </h3>
                            @if (session('status'))
                            <h5 class="alert alert-success">{{ session('status') }}</h5>
                        @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route ('saveclass') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Class<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control @error('exam_header') is-invalid @enderror" name="exam_header"
                                                        placeholder="Enter Class" value="{{ old('exam_header')}}" id="">
                                                    @error('exam_header')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="submit">
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
