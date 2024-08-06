@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Update Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Update Fees</li>
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

                            <form action="{{ route('updateEditFees') }}" method="POST">
                                @csrf
                                {{-- <input type="text" hidden name="id"
                                                @if ($check == 1) value="{{ $feestype->id }}" @endif> --}}
                                <div class="page-header">
                                    {{-- <div class="row align-items-center">
                                        <div class="col-6">
                                            <h3 class="page-title">Fees Setting</h3>
                                        </div>
                                        {{-- <div class="col-4">
                                            <div class="form-group">
                                                <div class="form-group ">
                                                    <label>Select Class<span class="login-danger">*</span></label>

                                                    <select id="class"
                                                        class="form-control select  @error('Class') is-invalid @enderror"
                                                        name="Class">

                                                        <option selected disabled>Select Class</option>
                                                        @if (!empty($classId))
                                                            @foreach ($finalarray as $value)
                                                                <option value="{{ $value['id'] }}"
                                                                    {{ $value['id'] == $classId ? 'selected' : '' }}>
                                                                    {{ $value['classname'] }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($finalarray as $value)
                                                                <option value="{{ $value['id'] }}"
                                                                    {{ old('Class') == 'I' ? 'selected' : '' }}>
                                                                    {{ $value['classname'] }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('Class')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}


                                    {{-- <div class="col-auto text-end float-end ms-auto download-grp"> --}}
                                    {{-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a> --}}
                                    {{-- <a href="{{ route('feessetting') }}" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i> Add Fees</a> --}}


                                    {{-- </div>
                                    </div> --}}
                                </div>

                                <div class="row mb-5">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>First Name <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->student_name }}">
                                                <input hidden type="text" name="id" value="{{ $studentEdit->id }}">
                                                <input hidden type="text" name="class" value="{{ $studentEdit->class_id }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>S.R Number <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->sr_no }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Roll Number <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->roll_no }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Father Name <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->father_name }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Mother Name <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->mother_name }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Class<span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name"
                                                @foreach ($finalarray as $class)
                                                @if ($class['id'] == $studentEdit->class_id)
                                                value="{{ $class['classname'] }}"
                                                @endif @endforeach>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $total = 0;
                                    $back_total = 0;
                                @endphp

                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start">S.No.</th>
                                                <th class="text-center">Fees Description</th>
                                                <th class="text-center">Fees Amount</th>
                                                <th class="text-center">Installment</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($feestype as $key => $fees)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $fees->fees_name }}</td>
                                                    <td>
                                                        <div class="form-group local-forms mb-0">
                                                            {{-- <label>Fees Type <span class="login-danger">*</span></label> --}}
                                                            <input type="text" hidden name="feesId_{{ $fees->id }}"
                                                                value="{{ $fees->id }}">
                                                            <input type="text" hidden
                                                                name="feesName_{{ $fees->id }}"
                                                                value="{{ $fees->fees_name }}">

                                                            <input type="number"
                                                                @if ($fees->global == 0 ) disabled @endif
                                                                class="fees_amount form-control @error('feesType') is-invalid @enderror"
                                                                name="feesamount_{{ $fees->id }}" placeholder="0"
                                                                value="{{ $fees->fees_amount }}">
                                                            @error('feesType')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        @php
                                                            if(!$fees->global == 0){
                                                                $back_total = $fees->fees_amount;
                                                            }
                                                            $total = $total + $fees->fees_amount;
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        <div class="form-group local-forms mb-0">
                                                            {{-- <label>Fees Type <span class="login-danger">*</span></label> --}}
                                                            <input @if ($fees->global == 0 ) disabled @endif
                                                                type="number"
                                                                class="form-control @error('feesType') is-invalid @enderror"
                                                                name="feesInstall_{{ $fees->id }}" placeholder="1"
                                                                value="{{ $fees->total_installment }}">
                                                            @error('feesType')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start">Total</th>
                                                <th class="text-center"></th>
                                                <th class="text-center" id="old_amount" hidden>{{ $total }}</th>
                                                <th class="text-center" id="back_amount" hidden>{{ $back_total }}</th>

                                                <th class="text-left" id="total_amount">{{ $total }}</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <h1 style="visibility:hidden;">hgdfj</h1>
                                    </div>
                                    @php
                                        $check = 1;
                                    @endphp

                                    @foreach ($feestype as $key => $fees)
                                        @if (!empty($fees))
                                            @if ($check == 1)
                                                <div class="col-md-4">
                                                    <div
                                                        class="row d-flex flex-row justify-content-end align-items-center">
                                                        <div class="col-6">

                                                        </div>
                                                        <div class="student-submit col-6">
                                                            <button type="submit"
                                                                class="btn btn-primary float-right">Update</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endif

                                        @php
                                            $check = 2;
                                        @endphp
                                    @endforeach

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section('script')
    <script>
        $('#class').on('change', function() {
            var classid = $('#class').find(":selected").val();
            console.log(classid);
            window.location.href = "{{ URL::to('school/viewfeessetting') }}" + '/' + classid;
        });

        $('.fees_amount').change(function(){

            var amount = parseInt($(this).val());
            var back_total = parseInt($('#back_amount').text());
            var old_total = parseInt($('#old_amount').text());
            var total = old_total - back_total + amount;
            $('#total_amount').text(total);
            // alert(amount);

        });


        $('#DataTables_Table_0_length').hide();
        $('#DataTables_Table_0_info').hide();
        $('#DataTables_Table_0_paginate').hide();
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
