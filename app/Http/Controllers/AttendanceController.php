<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function takestudentattendance(){
        return view('school.attendance.take_student_attendance');
    }
}
