@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-item-center">
                    <div class="col">
                        <h3>Add Exam Scheme</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('exam_list') }}">Scheme List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="{{ route('exam_list') }}" class="btn btn-primary">
                                    <i class="fas fa-back"></i>Back</a>
                            </h3>
                            @if (session('status'))
                                <h5 class="alert alert-success">{{ session('status') }}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('savescheme') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Exam Type<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('exam_type') is-invalid @enderror"
                                                        name="exam_type">
                                                        <option selected disabled>Select Exam Type </option>
                                                        <option value="Test Exam"
                                                            {{ old('exam_type') == 'Text Exam' ? 'selected' : '' }}>Test
                                                            Exam</option>
                                                        <option value="Monthly Exam"
                                                            {{ old('exam_type') == 'Monthly Exam' ? 'selected' : '' }}>
                                                            Monthly Exam</option>
                                                        <option value="Quarterly Exam"
                                                            {{ old('exam_type') == 'Quarterly Exam' ? 'selected' : '' }}>
                                                            Quarterly Exam</option>
                                                        <option value="Half Yearly"
                                                            {{ old('exam_type') == 'Half Yearly' ? 'selected' : '' }}>Half
                                                            Yearly Exam</option>
                                                        <option value="Annual"
                                                            {{ old('exam_type') == 'Annual' ? 'selected' : '' }}>Annual Exam
                                                        </option>
                                                    </select>
                                                    @error('exam_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Class<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('exam_class') is-invalid @enderror"
                                                        name="exam_class">
                                                        <option selected disabled >Select Class </option>
                                                        @foreach ($scheme_header as $value)
                                                            <option value="{{ $value['exam_header'] }}"
                                                                {{ old('exam_class') == $value['exam_header'] ? 'selected' : '' }}>
                                                                {{ $value['exam_header'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('exam_class')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Exam Date <span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control datetimepicker @error('exam_date') is-invalid @enderror"
                                                        placeholder="DD-MM-YYYY" name="exam_date"
                                                        value="{{ old('exam_date') }}">
                                                    @error('exam_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Subject<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('exam_subject') is-invalid @enderror"
                                                        name="exam_subject" placeholder="Enter Subject Name"
                                                        value="{{ old('exam_subject') }}" id="">
                                                    @error('exam_subject')
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
