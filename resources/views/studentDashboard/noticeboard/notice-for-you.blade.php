@extends('studentDashboard.layouts.master')
<style>
    table {
        background-color: white;
    }

    td {
        font-size: 15px;
        font-weight: 700;
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
        text-align: center;
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
            {{-- <div class="header-section">

                <a id="extra" href="" class="" style="margin-left:20px;"></a>
                <a id="printbtn" href="" class=" btn btn-success mb-4" style="margin-left:20px;">Print</a>

            </div> --}}
            <div class="printbox">
                <div class="print-header m-2 mt-0 mb-1 p-4 border border-primary">
                    <div class="school d-flex justify-content-center">
                        <div class="logo-container">
                            <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="40" height="40">
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
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <h4 class="text-center">NOTICE</h4>
                        </div>
                    </div>
                    <div class="responsive-table m-5 pd-3"> <span style="color: red; font-weight:800;">*Complain</span>
                        <table class="border-0 table ">
                            @foreach ($compl_notice as $key => $item)
                                @if ($item->item->item_type == 'Complaints')
                                    <tr>
                                        <td>{{ ++$key }} ) &nbsp;  {{ $item->item->item_name }} </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="responsive-table  m-5 pd-3"> <span style="color: green; font-weight:800;">*Sugesstion</span>
                        <table class="border-0 table">
                            @foreach ($compl_notice as $key => $item)
                                @if ($item->item->item_type == 'Suggestion')
                                    <tr>
                                        <td>{{ ++$key }} ) &nbsp;  {{ $item->item->item_name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    Date &nbsp; {{\Carbon\Carbon::parse(Custom::getstudentnoticedata($student->id)?->date)->format('d/m/Y')  }}
                                </div>
                                <div class="col-6 flex-end  d-flex justify-content-end">
                                    Order By
                                </div>
                            </div>
                        </div>
                    </div>
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
    </div>
@endsection
