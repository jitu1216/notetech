@extends('school.layouts.master')
@section('content')
 <style>
    body {
        overflow: scroll !important;
    }

    table {
        background-color: white;
    }

    .print-header {
        display: none;
        margin-top: -30px;
    }

    .print-header h4 {
        text-align: center;
        margin-top: 10px;
    }

    .school {
        width: 100vw;
        display: flex;
        flex-direction: row;
    }

    .logo-container {
        flex: 2;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
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
        margin-bottom: -2px;
        color: rgb(219, 0, 0);

    }

    .main-container h6 {
        margin-bottom: -2px;
        font-weight: 600 !important;
        color: blue;
    }

    .main-container span {
        font-size: 12px;
        color: black;
        margin-right: 10px;
    }

    .std_image img{
        height: 45px;
        width: 45px;
        border-radius: 50%;
        object-fit: cover;
    }
 </style>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">
                                Take Attendance
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input class="form-control datetimepicker"
                         name="date" type="text" placeholder="DD-MM-YYYY" id="dob">
                    </div>
                </div>
                <div class=" col-md-5">
                    <div class="form-group">
                        <div class="form-group ">
                            <select class="form-control select"  name="Class">
                                <option selected value="">Select Class</option>
                                <option value=""> </option>
                                <option value=""> </option>
                                <option value=""> </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table table-card">
                <table class="table ">
                    <thead class="table success table-nowrap">
                        <th>S.No.</th>
                        <th>Student Name</th>
                        <th>Roll No.</th>
                        <th>Attendance Type</th>
                    </thead>
                     <tbody class="text-nowrap">
                        <tr>
                            <td>1</td>
                            <td>Anu rag</td>
                            <td>13250</td>
                            <td><div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">Present</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">Absent</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                <label class="form-check-label" for="inlineCheckbox3">Application</label>
                              </div></td>
                        </tr>
                     </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection