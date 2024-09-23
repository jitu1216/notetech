@extends('studentDashboard.layouts.master')
<style>
    table {
        background-color: white;
    }

    .print-header {
        /* display: none; */
        margin: 10px;
        margin-top: -10px !important;
        margin-bottom: 100px !important;

    }

    .print-header h4 {
        text-align: center;
        margin-top: 10px;
    }

    .school {
        width: auto;
        display: flex;
        flex-direction: row;
    }

    .logo-container {
        flex: 2;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: right;
    }

    .main-container {
        flex: 8;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-left: -20px !important;
    }

    .main-container h3 {
        font-weight: 800 !important;
        margin-bottom: -0px;
        color: rgb(219, 0, 0);
        font-size: 16px;
    }

    .main-container h6 {
        margin-bottom: -2px;
        font-weight: 600 !important;
        color: blue;
        font-size: 9px;
        margin-top: 4px;
        text-align:center;
    }

    .main-container span {

        color: black;
        margin-right: 10px;
        font-size: 9px;
    }

    .top {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .content {
        flex: 8;
        margin-top: 40px !important;
    }

    .student-image {
        flex: 2
    }

    .container-fluid {
        max-width: 1180px !important;
    }

    .header-section {
        display: flex;
        flex-direction: row;
    }

    .header-section a {
        width: 100px;
        flex: 2;
    }

    #cancelbtn {
        flex: 2;
    }

    #extra {
        flex: 6;
    }

    #printbtn {
        flex: 2;
    }

    .content p {
        margin-left: 30px;
        margin-right: 60px;
    }

    .dataTables_length,
    .dataTables_info,
    .dataTables_paginate {
        display: none;
    }

    @media only screen and (max-width: 450px) {

        .main-container {
            flex: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-container h3 {
            font-size: 16px;
        }

        .main-container h6 {
            font-size: 11px;
            margin-top: 2px;
        }

        .main-container p span {
            font-size: 9px;
        }

        .content p {
            font-size: 12px;
            margin: 0;
        }

    }



    @media print {

        .printbox {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin-top: -20px;
            margin-bottom: 30px;
        }

        tr {
            font-size: 11px;
            height: 5px !important;
            color: black !important;
        }

        td {
            font-size: 11px !important;
            color: black !important;

        }

        td label,
        input {
            font-size: 11px !important;
            color: black !important;

        }

        .header-section {
            display: none !important;
        }

        .page-wrapper {
            margin-top: -80px !important;
        }

        .table {
            font-size: 10px;
        }

        .header {
            display: none;
        }

        nav {
            display: none;
        }

        .main-container h6 {
            margin-bottom: -7px;
            font-weight: 600 !important;
            color: rgb(67, 169, 253);
        }

        .main-container h3 {
            margin-bottom: -2px;
        }

        .main-container p span {
            margin-bottom: -2px;
            font-size: 8px !important;
        }

       .print-header {
            display: inline !important;
            width: 500px;
            margin: 5px;
            margin-top: 0px !important;
            margin-bottom: 20px !important;
            max-height: 2480 !important;
        }


        .page-header,
        .action {
            display: none;
        }

        .application h6,
        .content-name h6 {
            font-size: 10px !important;
        }

        footer {
            display: none;
        }

        .heading {
            font-size: 12px !important;
        }

        .table-print {
            margin-top: -40px;
            overflow: hidden !important;
        }

        table,
        tbody,
        thead,
        .table-responsive {
            overflow: hidden !important;
        }
    }
</style>
@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid bg-white d-flex flex-column justify-content-center ">
            <div class="header-section">
                <a id="cancelbtn" href="{{ route('fees-report', '2') }}" class=" btn btn-primary mb-4"
                    style="margin-left:20px;">Cancel</a>
                <a id="extra" href="" class="" style="margin-left:20px;"></a>
                <a id="printbtn" href="" class=" btn btn-success mb-4" style="margin-left:20px;">Print</a>

            </div>

            <div class="printbox">
                @foreach ($unique as $feesdetails)
                    <div class="print-header m-2 mt-0 mb-1 p-4 border border-primary">
                        <div class="school">
                            <div class="logo-container">
                                <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="40"
                                    height="40">
                            </div>
                            <div class="main-container">
                                <h3>{{ Custom::getSchool()->Name }}</h3>
                                <h6>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                                    ({{ Custom::getSchool()->State }})
                                </h6>
                                {{-- <h6>Kainchu Tanda, Amaria Distt. Pilibhit (U.P.)-262121 Mob. 9411484111</h5> --}}
                                <p><span>Email.{{ Custom::getSchool()->Email }}</span> <span>Mobile No.
                                        {{ Custom::getSchool()->Mobile }}</span>
                                </p>


                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <h6 style="margin-left:10px; margin-top:-5px; background-color: rgb(231, 231, 231); color:rgb(0, 0, 0); padding:5px 18px 5px 18px; text-align:center;"
                                class="heading">
                                Fees Receipt
                            </h6>
                        </div>

                        <div class="middle-section mt-2 pt-0">
                            <div class="application" style="margin-top: -0px;">

                                <div class="d-flex flex-row">
                                    <h6 class="col-3"><span style="font-weight: 600;">Online Receipt No:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                        {{ $feesdetails->online_receipt_no }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span
                                            style="font-weight: 600;">Date:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                                        {{ $feesdetails->date }}
                                    </h6>
                                </div>
                                <div class="d-flex flex-row">
                                    <h6 class="col-3"><span style="font-weight: 600;">Offline Reciept No:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-2 text-center">
                                        {{ $feesdetails->reciept_no }}
                                    </h6>
                                    <h6 class="col-3" style="margin-left:20px; margin-right:-20px;"><span
                                            style="font-weight: 600;">Fees Account No:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                                        {{ $student->fee_account }}
                                    </h6>
                                </div>

                                <div class="d-flex flex-row ">
                                    <h6 class="col-2"><span style="font-weight: 600;">Student Name:</span></h6>
                                    <h6 id="stdname" style="border-bottom:1px solid rgb(59, 59, 59); "
                                        class="col-10 text-center">
                                        {{ $student->student_name }}
                                    </h6>
                                </div>

                                <div class="d-flex flex-row">
                                    <h6 class="col-2"><span style="font-weight: 600;">Father Name:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                        {{ $student->father_name }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left:20px; margin-right:-20px;"><span
                                            style="font-weight: 600;">Mother Name:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-5 text-center">
                                        {{ $student->mother_name }}
                                    </h6>
                                </div>

                                {{-- <div class="d-flex flex-row">
                                    <h6 class="col-3" style="margin-left:0px; margin-right:-70px;"><span
                                            style="font-weight: 600;">Date of Birth:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ $student->dob }}
                                    </h6>
                                    <h6 class="col-3" style="margin-left:25px; margin-right:0px;"><span
                                            style="font-weight: 600;">Session Year:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ Session::get('academic_session') }}
                                    </h6>
                                </div> --}}

                            </div>
                            <div class="content-name">
                                <div class="d-flex flex-row">
                                    <h6 class="col-1"><span style="font-weight: 600;">Class:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-2 text-center">
                                        {{ $schoolclass->classname }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left: 20px; margin-right: -20px;"><span
                                            style="font-weight: 600;">Student Id:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-2 text-center">
                                        {{ $student->student_id }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left:20px; margin-right:0px;"><span
                                            style="font-weight: 600;">Date of Birth:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-2 text-center">
                                        {{ $student->dob }}
                                    </h6>
                                </div>
                            </div>

                            <div class="content-name">
                                <div class="d-flex flex-row">
                                    <h6 class="col-1"><span style="font-weight: 600;">
                                            {{ $student->locality_type }}:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-5 text-center">
                                        {{ $student->village }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left:10px; margin-right:-20px;"><span
                                            style="font-weight: 600;">{{ $student->post_type }}:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                                        {{ $student->town }}
                                    </h6>
                                </div>

                                <div class="d-flex flex-row">
                                    <h6 class="col-1"><span style="font-weight: 600;">District</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59); " class="col-3 text-center">
                                        {{ $student->district }}
                                    </h6>
                                    <h6 class="col-1" style="margin-left: 0px; margin-right: -20px;"><span
                                            style="font-weight: 600;">State:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ $student->state }}
                                    </h6>
                                    <h6 class="col-1" style="margin-left:20px; margin-right:0px;"><span
                                            style="font-weight: 600;">Pincode:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ $student->pincode }}
                                    </h6>
                                </div>
                                <div class="d-flex flex-row">
                                    <h6 class="col-2"><span style="font-weight: 600;">Deposor Name:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);margin-left: 0px;"
                                        class="col-3 text-center">
                                        {{ $feesdetails->deposor_name }}
                                    </h6>
                                    <h6 class="col-2" style="margin-left: 30px; margin-right: -10px;"><span
                                            style="font-weight: 600;">Payment Mode:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-4 text-center">
                                        {{ $feesdetails->payment_mode }}
                                    </h6>

                                </div>
                                @if ($feesdetails->payment_mode != 'Cash')
                                    <div class="d-flex flex-row">
                                        <h6 class="col-3" style=" margin-right: -20px;"><span
                                                style="font-weight: 600;">Transaction No.
                                            </span></h6>
                                        <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                            {{ $feesdetails->transactio_no }}
                                        </h6>
                                        <h6 class="col-3" style="margin-left: 20px;"><span
                                                style="font-weight: 600;">Transaction Date:</span></h6>
                                        <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                            {{ $feesdetails->transaction_date }}
                                        </h6>
                                    </div>
                                @endif
                                <div class="d-flex flex-row">
                                    <h6 class="col-3" style=" margin-right:-20px;"><span
                                            style="font-weight: 600;">Reciever
                                            Name:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ $feesdetails->reciever_name }}
                                    </h6>
                                    <h6 class="col-3" style="margin-left:20px;"><span
                                            style="font-weight: 600;">Depositor
                                            Code:</span></h6>
                                    <h6 style="border-bottom:1px solid rgb(59, 59, 59);" class="col-3 text-center">
                                        {{ $feesdetails->depositor_code }}
                                    </h6>
                                </div>

                            </div>

                            <div class="content-name m-0">
                                <h6
                                    style="color: rgb(27, 27, 27) !important; padding:7px; background-color:rgb(231, 231, 231);">
                                    Fees Details</h6>
                            </div>
                            @php
                                $totalAmount = 0;
                                $pendingAmount = 0;
                                $todayAmount = 0;
                                $totalDepositeAmount = 0;

                            @endphp
                            <div class="content-name m-0">
                                <div class="table-responsive table-print">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start">S.No.</th>
                                                <th class="text-center">Fees Description</th>
                                                <th class="text-center">Total Fees</th>
                                                <th class="text-center">Today Fees</th>
                                                <th class="text-center">Total Deposite Fees</th>
                                                <th class="text-center">Pending Fees</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $feesTransaction = Custom::getFeesTransaction($feesdetails->reciept_no, $student->id);
                                        @endphp

                                            @foreach ($feesTransaction as $key => $fees)
                                                <tr style="height:10px; !important;">
                                                    <td>{{ ++$key }}</td>
                                                    <td class="text-center">

                                                        {{ $fees->fees_name }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $fees->fees_amount }}
                                                    </td>
                                                    <td class="text-center todayfeestd_{{ $fees->fees_type_id }}">
                                                        {{ $fees->fees_paid_today }}</td>
                                                    <td class="text-center">
                                                        {{ $fees->fees_amount - $fees->fees_pending }}
                                                    </td>
                                                    {{-- <td>

                                                    <div class="row  d-flex justify-content-center"
                                                        style="height:2.3rem !important; overflow:hidden; margin-right:2rem;">

                                                        @php
                                                            $totallInstallment = $fees->fees_amount / $fees->total_installment;

                                                        @endphp

                                                        @for ($i = 0; $i < $fees->total_installment; $i++)
                                                            <div class="col-2 col-sm-1 m-2">
                                                                <div class="form-group local-forms">
                                                                    <label style="margin-left: -14px;">
                                                                        {{ $totallInstallment }}</label><input
                                                                        @if ($fees->paid_installment > $i) disabled checked @endif
                                                                        value="{{ $totallInstallment }} " type="checkbox"
                                                                        class="installment"
                                                                        style="font-size: 30px; margin-top:15px;"
                                                                        data-value="{{ $fees->fees_type_id }}">
                                                                </div>

                                                            </div>
                                                        @endfor

                                                    </div>
                                                </td> --}}


                                                    <td class="text-center">
                                                        {{ $fees->fees_pending }}
                                                    </td>

                                                </tr>
                                                @php
                                                    $totalAmount = $totalAmount + $fees->fees_amount;
                                                    $pendingAmount = $pendingAmount + $fees->fees_pending;
                                                    $todayAmount = $todayAmount + $fees->fees_paid_today;
                                                    $totalDepositeAmount = $totalDepositeAmount +  $fees->fees_amount - $fees->fees_pending;

                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <thead class="student-thread">
                                            <tr>
                                                <th class="text-start">Total</th>
                                                {{-- <th class="text-center"></th> --}}
                                                <th class="text-center"></th>
                                                <th class="text-center" id="totalamount">{{ $totalAmount }}</th>

                                                <th class="text-center" id="todayfees">{{ $todayAmount }}</th>
                                                <th class="text-center" id="totalamount">{{ $totalDepositeAmount }}</th>
                                                <th class="text-center" id="pendingfees">{{ $pendingAmount }}</th>

                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>


                        </div>

                    </div>
                @endforeach



            </div>
        </div>
    </div>
    <script>
        $('#printbtn').on('click', function() {
            event.preventDefault();
            var name = $('#stdname').text();
            document.title = name;
            window.print()
        });
    </script>
@endsection
