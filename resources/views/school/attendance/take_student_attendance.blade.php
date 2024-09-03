@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="table-responsive table table-card">
                <table class="table border-0 table-light ">
                    <thead class="">
                        <th>S.No.</th>
                        <th>Student Name</th>
                        <th>Roll No.</th>
                        <th>Attendance Type</th>
                    </thead>
                     <tbody class="text-nowrap">
                        <tr>
                            <td>{{-- ++$key --}}</td>
                            <td>{{-- $data->student_name --}}</td>
                        </tr>
                     </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection