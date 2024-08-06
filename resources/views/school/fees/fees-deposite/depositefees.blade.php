@extends('school.layouts.master')
@section('content')


    <style>
        .student-submit .dposite-btn {
            margin-left: 30px !important;
        }

        .down-head {
            background-color: rgb(231, 231, 231) !important;
        }

        .sr-no {
            width: 2px !important;
        }


        @media only screen and (max-width: 900px) {
            .student-submit .dposite-btn {
                margin-right: 30px !important;
            }

            .table thead tr th {
                font-weight: 400;
                width: 5px !important;
                word-wrap: break-word;
            }

            table.dataTable thead>tr>th.sorting {
                padding-right: 0px !important;
            }

            table.dataTable thead .sorting:before, table.dataTable thead .sorting:after{
                display: none !important;
            }


            .card-table .table th {
                padding: 0.5rem 0.50rem;
                white-space: wrap;
            }

            .form-group label {
                font-size: 15px !important;
            }

            tr {
                font-size: 15px;
                height: 5px !important;
                color: black !important;
            }

            td {
                font-size: 15px !important;
                color: black !important;

            }

            td label,
            input {
                font-size: 15px !important;
                color: black !important;

            }

            table,
            tbody,
            thead,
            .table-responsive {
                /* overflow: hidden !important; */
                width: 100% !important;
            }
        }
    </style>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Deposite Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Deposite Fees</li>
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

                            <form action="{{ route('updateDepositeFees') }}" method="POST">
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
                                            <input hidden type="text" name="class"
                                                value="{{ $studentEdit->class_id }}">
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
                                            <label>Fees Account No. <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ $studentEdit->fee_account }}">
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
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Offline Receipt No<span class="login-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('offline_receipt_no') is-invalid @enderror"
                                                name="offline_receipt_no" value="{{ old('offline_receipt_no') }}"
                                                placeholder="Enter Offline Receipt No">
                                            @error('offline_receipt_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Online Receipt No<span class="login-danger">*</span></label>
                                            <input disabled type="number"
                                                class="form-control @error('online_receipt_no') is-invalid @enderror"
                                                name="receipt_no" value="{{ $online_receipt_no }}"
                                                placeholder="Enter Receipt No">
                                            <input hidden type="number"
                                                class="form-control @error('online_receipt_no') is-invalid @enderror"
                                                name="online_receipt_no" value="{{ $online_receipt_no }}"
                                                placeholder="Enter Receipt No">
                                            @error('online_receipt_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Deposor Name<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('deposor') is-invalid @enderror" name="deposor"
                                                value="{{ old('deposor') }}" placeholder="Enter Deposor Name">
                                            @error('deposor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Date <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker @error('date') is-invalid @enderror"
                                                name="date" type="text" placeholder="DD-MM-YYYY"
                                                value="{{ old('date') }}" id="dob">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Payment Mode <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('payemnt') is-invalid @enderror"
                                                name="payemnt" id="payment_mode">
                                                <option selected disabled>Select Payment Mode</option>
                                                <option value="Cash" {{ old('payemnt') == 'Cash' ? 'selected' : '' }}>
                                                    Cash
                                                </option>
                                                <option value="Cheque" {{ old('payemnt') == 'Cheque' ? 'selected' : '' }}>
                                                    Cheque
                                                </option>
                                                <option value="Online Payment"
                                                    {{ old('payemnt') == 'Online Payment' ? 'selected' : '' }}>
                                                    Online Payment</option>
                                            </select>
                                            @error('payemnt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" id="transaction" style="display:none;">
                                        <div class="form-group ">
                                            <label>Transaction Number<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('transactio_no') is-invalid @enderror"
                                                name="transactio_no" value="{{ old('transactio_no') }}"
                                                placeholder="Enter Transaction No">
                                            @error('transactio_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4" id="transaction_date" style="display:none;">
                                        <div class="form-group">
                                            <label>Transaction Date <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('transaction_date') is-invalid @enderror"
                                                name="transaction_date" type="text" placeholder="DD-MM-YYYY"
                                                value="{{ old('transaction_date') }}" id="dob">
                                            @error('transaction_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" style="display: none;">
                                        <div class="form-group ">
                                            <label>Depositor Code<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('depositor_code_2') is-invalid @enderror"
                                                name="depositor_code_2" id="depositor_code_2"
                                                value="{{ old('depositor_code_2') }}" placeholder="Enter Depositor Code"
                                                hidden>
                                            @error('depositor_code_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Reciever Name<span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select  @error('reciever_name') is-invalid @enderror"
                                                name="reciever_name" id="reciever_name">
                                                <option selected disabled>Select Reciever Name</option>
                                                @foreach ($stafflist as $staff)
                                                    <option data-id="{{ $staff->staff_code }}"
                                                        value="{{ $staff->staff_name }} ({{ $staff->staff_code }})"
                                                        {{ old('reciever_name') == $staff->staff_name ? 'selected' : '' }}>
                                                        {{ $staff->staff_name }} ({{ $staff->staff_code }})
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('reciever_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $totalAmount = 0;
                                    $pendingAmount = 0;
                                    $DepositeAmount = 0;

                                @endphp

                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start sr-no">S.No.</th>
                                                <th class="text-center">Fees Description</th>
                                                <th class="text-center">Total Fees</th>
                                                <th class="text-center">Today Fees</th>
                                                <th class="text-center">Total Deposite Fees</th>
                                                <th class="text-center">Pending Fees</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($feestype as $key => $fees)
                                                <tr>
                                                    <td class="sr-no">{{ ++$key }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="feesId_{{ $fees->fees_type_id }}"
                                                            value="{{ $fees->fees_type_id }}" hidden>
                                                        {{ $fees->fees_name }}
                                                        <div class="row d-flex justify-content-center"
                                                            style="margin-right:2rem; margin-top:15px;">

                                                            @if ($fees->total_installment == 0)
                                                                <div class="col-1 col-sm-1" style="margin-bottom:15px; margin-left:25px; margin-right:25px;">
                                                                    <div class="form-group local-forms">
                                                                        <label
                                                                            style="margin-left: -14px font-size:12px !important;">
                                                                            {{ $fees->fees_amount }} </label><input
                                                                            value="{{ $fees->fees_amount }} "
                                                                            type="checkbox"
                                                                            class="installment form-check-input"
                                                                            style="font-size: 19px; margin-top:15px;"
                                                                            data-value="{{ $fees->fees_type_id }}">
                                                                    </div>
                                                                </div>
                                                            @else
                                                                @php
                                                                    $totallInstallment = $fees->fees_amount / $fees->total_installment;

                                                                @endphp

                                                                @for ($i = 0; $i < $fees->total_installment; $i++)
                                                                    <div class="col-1 col-sm-1 ">
                                                                        <div class="form-group local-forms" style="margin-bottom: 15px; margin-left:25px; margin-right:25px;">
                                                                            <label
                                                                                style="margin-left: -14px; font-size:12px !important;">
                                                                                {{ $totallInstallment }}</label><input
                                                                                @if ($fees->paid_installment > $i) disabled checked @endif
                                                                                value="{{ $totallInstallment }} "
                                                                                type="checkbox"
                                                                                class="installment form-check-input"
                                                                                style="font-size: 19px; margin-top:15px;"
                                                                                data-value="{{ $fees->fees_type_id }}">
                                                                        </div>

                                                                    </div>
                                                                @endfor
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $fees->fees_amount }}
                                                    </td>
                                                    <td class="text-center todayfeestd_{{ $fees->fees_type_id }}">0</td>
                                                    <td class="text-center">
                                                        {{ $fees->fees_paid }}
                                                    </td>


                                                    <input id="todayfees_{{ $fees->fees_type_id }}" type="number"
                                                        name="today_{{ $fees->fees_type_id }}" value="0" hidden>
                                                    @php
                                                        $pending = $fees->fees_amount - $fees->fees_paid;
                                                    @endphp

                                                    <input id="pendingdepositeFees_{{ $fees->fees_type_id }}"
                                                        type="number" name="pendingFees_{{ $fees->fees_type_id }}"
                                                        value="{{ $pending }}" hidden>
                                                    <td class="text-center todaypending_{{ $fees->fees_type_id }}">
                                                        {{ $pending }}</td>

                                                </tr>
                                                @php
                                                    $totalAmount = $totalAmount + $fees->fees_amount;
                                                    $pendingAmount = $pendingAmount + $pending;
                                                    $DepositeAmount = $DepositeAmount + $fees->fees_paid;

                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <thead class="student-thread">
                                            <tr class="down-head">
                                                <th class="text-start down-head">Total</th>
                                                <th class="text-center down-head"></th>
                                                <th class="text-center down-head" id="totalamount">{{ $totalAmount }}
                                                </th>
                                                <th class="text-center down-head" id="todayfees">0</th>
                                                <th class="text-center down-head" id="totalamount">{{ $DepositeAmount }}
                                                </th>
                                                <th class="text-center down-head" id="pendingfees">{{ $pendingAmount }}
                                                </th>

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
                                                <div class="col-md-4 mt-5">
                                                    <div
                                                        class="row d-flex flex-row justify-content-center align-items-center dposite-btn">

                                                        <button type="submit" class="btn btn-primary ">Deposite
                                                            Now</button>

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


        $('#payment_mode').change(function(e) {

            var selected = $(this).find(':selected').val();
            if (selected != 'Cash') {
                $('#transaction_date').css('display', 'block');
                $('#transaction').css('display', 'block');
            } else {
                $('#transaction_date').css('display', 'none');
                $('#transaction').css('display', 'none');
            }


        });

        $('#reciever_name').on('change', function() {

            var key = $(this).find(':selected').attr('data-id');
            $('#depositor_code').val(key);
            $('#depositor_code_2').val(key);

            // alert(this.value);
            // alert(key);
        });



        $('.installment').on('click', function(e) {

            if ($(this).is(':checkbox:checked')) {
                $(this).attr("checked", true);
                var installment = parseInt($(this).val());
                var key = $(this).data('value');
                var today = parseInt($(".todayfeestd_" + key).text());
                var todaypending = parseInt($(".todaypending_" + key).text());
                var total = installment + today;
                var totalpending = todaypending - installment;
                $("#pendingdepositeFees_" + key).val(totalpending);
                $(".todaypending_" + key).text(totalpending);
                $(".todayfeestd_" + key).text(total);
                $("#todayfees_" + key).val(total);
                var totaltoday = parseInt($('#todayfees').text());
                var finaltoday = totaltoday + installment;

                $('#todayfees').text(finaltoday);

                var totalpending = parseInt($('#pendingfees').text());
                $('#pendingfees').text(totalpending - installment);

            } else {
                $(this).attr("checked", false);
                var installment = parseInt($(this).val());
                var key = $(this).data('value');
                var today = parseInt($(".todayfeestd_" + key).text());
                var todaypending = parseInt($(".todaypending_" + key).text());
                var total = today - installment;
                var totalpending = todaypending + installment;
                $("#pendingdepositeFees_" + key).val(totalpending);
                $(".todaypending_" + key).text(totalpending);
                $(".todayfeestd_" + key).text(total);
                $("#todayfees_" + key).val(total);
                var totaltoday = parseInt($('#todayfees').text());
                var finaltoday = totaltoday - installment;
                $('#todayfees').text(finaltoday);
                var totalpending = parseInt($('#pendingfees').text());
                $('#pendingfees').text(totalpending + installment);
            }

        });
    </script>
@endsection
@endsection
