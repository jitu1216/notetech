@extends('studentDashboard.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Deposite Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{-- route('school') --}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Deposite Fees</li>
                        </ul>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <form action="{{ route('updateDepositeFees') }}" method="POST">
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
                                                name="first_name" value="{{-- $studentEdit->student_name --}}">
                                            <input hidden type="text" name="id" value="{{-- $studentEdit->id --}}">
                                            <input hidden type="text" name="class"
                                                value="{{-- $studentEdit->class_id --}}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>S.R Number <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{-- $studentEdit->sr_no --}}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Fees Account No. <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{-- $studentEdit->fee_account --}}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Father Name <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{-- $studentEdit->father_name --}}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Mother Name <span class="login-danger">*</span></label>
                                            <input disabled type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{-- $studentEdit->mother_name --}}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
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
                                                {{--@foreach ($finalarray as $class)
                                                @if ($class['id'] == $studentEdit->class_id)--}}
                                                value="{{-- $class['classname'] --}}">
                                                {{--@endif @endforeach> --}}
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Offline Receipt No<span class="login-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('offline_receipt_no') is-invalid @enderror"
                                                name="offline_receipt_no" value="{{-- old('offline_receipt_no') --}}"
                                                placeholder="Enter Offline Receipt No">
                                            @error('offline_receipt_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Online Receipt No<span class="login-danger">*</span></label>
                                            <input disabled type="number"
                                                class="form-control @error('online_receipt_no') is-invalid @enderror"
                                                name="receipt_no" value="{{-- $online_receipt_no --}}"
                                                placeholder="Enter Receipt No">
                                            <input hidden type="number"
                                                class="form-control @error('online_receipt_no') is-invalid @enderror"
                                                name="online_receipt_no" value="{{-- $online_receipt_no --}}"
                                                placeholder="Enter Receipt No">
                                            @error('online_receipt_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Deposor Name<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('deposor') is-invalid @enderror" name="deposor"
                                                value="{{-- old('deposor') --}}" placeholder="Enter Deposor Name">
                                            @error('deposor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                    </div>  
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Date <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker @error('date') is-invalid @enderror"
                                                name="date" type="text" placeholder="DD-MM-YYYY"
                                                value="{{-- old('date') --}}" id="dob">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
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
                                                <option value="Cash" {{-- old('payemnt') == 'Cash' ? 'selected' : '' --}}>
                                                    Cash
                                                </option>
                                                <option value="Cheque" {{-- old('payemnt') == 'Cheque' ? 'selected' : '' --}}>
                                                    Cheque
                                                </option>
                                                <option value="Online Payment"
                                                    {{-- old('payemnt') == 'Online Payment' ? 'selected' : '' --}}>
                                                    Online Payment</option>
                                            </select>
                                            @error('payemnt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
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
                                                    <strong>{{-- $message --}}</strong>
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
                                                value="{{-- old('transaction_date') --}}" id="dob">
                                            @error('transaction_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group ">
                                            <label>Which Month Fees<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control" name=""
                                                value="{{-- old('deposor') --}}" placeholder="Which Month Fees ">                              
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{-- $message --}}</strong>
                                                </span>
                                        </div>
                                    </div>  
                                </form> 
                            </div>
                            {{--<div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th class="text-start sr-no">S.No.</th>
                                            <th class="text-center">Total Fees</th>
                                            <th class="text-center">Today Fees</th>
                                            <th class="text-center">Discount Fees</th>
                                            <th class="text-center">Total Deposite Fees</th>
                                            <th class="text-center">Pending Fees</th>
                                        </tr>
                                    </thead>                        
                            </div>--}}          
                        </div> 
                    </div>
                </div>
            </div>             
        </div>
    </div>
@endsection