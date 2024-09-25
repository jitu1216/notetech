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
                                <form action="{{ route('updatescheme') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Exam Type<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('exam_type') is-invalid @enderror"
                                                        name="exam_type">
                                                        <option selected disabled>Select Exam Type </option>
                                                        <option value="Test Exam"
                                                            {{ $item->exam_type == 'Text Exam' ? 'selected' : '' }}>Test
                                                            Exam</option>
                                                        <option value="Monthly Exam"
                                                            {{ $item->exam_type == 'Monthly Exam' ? 'selected' : '' }}>
                                                            Monthly Exam</option>
                                                        <option value="Quarterly Exam"
                                                            {{ $item->exam_type == 'Quarterly Exam' ? 'selected' : '' }}>
                                                            Quarterly Exam</option>
                                                        <option value="Half Yearly"
                                                            {{ $item->exam_type == 'Half Yearly' ? 'selected' : '' }}>Half
                                                            Yearly Exam</option>
                                                        <option value="Annual"
                                                            {{ $item->exam_type == 'Annual' ? 'selected' : '' }}>Annual
                                                            Exam</option>
                                                    </select>
                                                    @error('exam_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class Group<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control
                                                            select @error('exam_class') is-invalid @enderror"
                                                        name="exam_class">
                                                        <option selected disabled>Select Class Group</option>
                                                        @foreach ($scheme_header as $value)
                                                            <option value="{{ $value['exam_header'] }}"
                                                                {{ $item->exam_class == $value['exam_header'] ? 'selected' : '' }}>
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
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Select Class For Group<span class="login-danger">*</span></label>
                                                    <select class="form-control  @error('class_group') is-invalid @enderror"
                                                        name="class_group[]" multiple id="class_group">
                                                        @php
                                                            $classlist = [];
                                                            $classlist = explode(',', $item->class_group);
                                                        @endphp
                                                        @foreach ($finalarray as $value)
                                                            <option value="{{ $value['id'] }}"
                                                                {{ collect($classlist)->contains($value['id']) ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('class_group')
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
                                                        value="{{ \Carbon\Carbon::parse($item->exam_date)->format('Y-m-d') }}">
                                                    @error('exam_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Subject<span
                                                            class="login-danger  @error('exam_subject') is-invalid @enderror">*</span></label>
                                                    <input type="text" class="form-control" name="exam_subject"
                                                        placeholder="Enter Subject Name" value="{{ $item->exam_subject }}"
                                                        id="">
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

    <script>
        new MultiSelectTag('class_group', {
            rounded: true, // default true
            shadow: false, // default false
            placeholder: 'Search', // default Search...
            tagColor: {
                textColor: '#red',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            },
            onChange: function(values) {
                console.log(values)
            }
        })
    </script>
@endsection
