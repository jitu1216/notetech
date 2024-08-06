@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Fees</li>
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

                            <form action="{{ route('storeFees') }}" method="POST">
                                @csrf
                                {{-- <input type="text" hidden name="id"
                                                @if ($check == 1) value="{{ $feestype->id }}" @endif> --}}
                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h3 class="page-title">Fees Setting</h3>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="form-group ">
                                                    <select
                                                        class="form-control select  @error('Class') is-invalid @enderror"
                                                        name="Class" id="class">

                                                        <option selected disabled>Select Class</option>
                                                        @if (!empty($classid))
                                                            @foreach ($finalarray as $value)
                                                                <option value="{{ $value['id'] }}"
                                                                    {{ $value['id'] == $classid ? 'selected' : '' }}>
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
                                        </div>


                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            {{-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a> --}}
                                            {{-- <a href="{{ route('addfeestype') }}" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i> Add Fees</a> --}}


                                        </div>
                                    </div>
                                </div>

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
                                            @php
                                                $checkfees = 0;
                                            @endphp

                                            @foreach ($feestype as $key => $fees)
                                                @if (empty(Custom::getClassfees($classid, $fees->id)))
                                                    @php
                                                        $checkfees = 1;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $fees->fees_name }}</td>
                                                        <td>
                                                            <div class="form-group local-forms mb-0">
                                                                {{-- <label>Fees Type <span class="login-danger">*</span></label> --}}
                                                                <input type="text" hidden
                                                                    name="feesId_{{ $fees->id }}"
                                                                    value="{{ $fees->id }}">
                                                                <input type="text" hidden
                                                                    name="feesName_{{ $fees->id }}"
                                                                    value="{{ $fees->fees_name }}">

                                                                <input type="number"
                                                                    class="addfees form-control @error('feesType') is-invalid @enderror"
                                                                    name="feesamount_{{ $fees->id }}" placeholder="0"
                                                                    value="0" data-key="{{ $key }}" id="fee_amount_{{ $key }}">

                                                                    <input type="number" id="old_fees_{{ $key }}" hidden value="0">

                                                                @error('feesType')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group local-forms mb-0">
                                                                {{-- <label>Fees Type <span class="login-danger">*</span></label> --}}
                                                                <input type="number"
                                                                    class="form-control @error('feesType') is-invalid @enderror"
                                                                    name="feesInstall_{{ $fees->id }}" placeholder="1"
                                                                    value="1">
                                                                @error('feesType')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @if ($checkfees == 0)
                                                <script>
                                                    var classid = "{{ $classid }}";
                                                    window.location.href = "{{ URL::to('school/viewfeessetting') }}" + '/' + classid;
                                                </script>
                                            @endif
                                        </tbody>
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start">Total</th>
                                                <th class="text-center"></th>
                                                <th class="text-left" id="totalfees">0</th>
                                                <th class="text-left"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <h1 style="visibility:hidden;">hgdfj</h1>
                                    </div>
                                    <div class="col-2">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary float-right">Save</button>
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

@section('script')
    <script>
        $('#class').on('change', function() {
            var classid = $('#class').find(":selected").val();
            // console.log(classid);
            window.location.href = "{{ URL::to('school/feessetting') }}" + '/' + classid;
        });


        $('.addfees').change(function(){

           var key = $(this).data('key');
           var today = parseInt($("#fee_amount_" + key).val());
           var old_fees = parseInt($("#old_fees_" + key).val());
           var totalfees = parseInt($("#totalfees").text());
            var totalfees = totalfees - old_fees;

            var gettotal = totalfees + today;
            console.log(gettotal);
           $("#old_fees_" + key).val(today);
           $("#totalfees").text(gettotal);

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
