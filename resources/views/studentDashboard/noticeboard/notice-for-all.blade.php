@extends('studentDashboard.layouts.master')
<style>
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
</style>
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid bg-white d-flex flex-column justify-content-center ">
            <div class="card-header">
                <h3 class="Info">
                    <a href="{{ route('student-notice-for-all-list')}}" class="btn btn-primary">
                        <i class=""></i> Back</a>
                </h3>
            </div>
            <div class="">
                <div class=" m-2 mt-0 mb-1 p-4 border border-primary">
                  
                    <div class="school d-flex justify-content-center">
                        <div class="logo-container">
                            <img src="{{ URL::to('images/1680626594.jpg') }}" alt="" width="40" height="40">
                        </div>
                        <div class="main-container">
                            <h3>{{ Custom::getSchool()->Name }}</h3>
                            <h6>{{ Custom::getSchool()->Address }},{{ Custom::getSchool()->City }}
                                ({{ Custom::getSchool()->State }})
                            </h6>
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
                    <div class="row m-5" style="font-weight: 800;">
                        <div class="col d-flex justify-content-center pd">
                            {{ $notice->notice_text }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    Date- {{ Carbon\Carbon::parse($notice->date)->format('d/m/Y') }}
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    Order By 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
