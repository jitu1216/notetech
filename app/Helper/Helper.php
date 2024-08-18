<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\FeesAmount;
use App\Models\StudentFees;
use App\Models\FeesType;
use App\Models\FeesTransaction;
use App\Models\AcademicSession;
use App\Models\Student;
use App\Models\Staff;
use Session;
use Auth;

class Custom{
     public static function academicSession(){
        if(!Session::get('academic_session')){
            $nextyear = substr(date("Y"), -2) + 1;
            $year = date("Y").'-'.$nextyear;
            Session::put('academic_session', $year);
        }
        $data = AcademicSession::all();
        Session::put('all_academic_session', $data);
     }

     public static function getUser(){
        $user = Auth::User();
        return $user;
     }


     public static function getStaffDetail(){
        $user = Auth::User();
        $data = Staff::where(['email'=> $user->email,'staff_name'=> $user->name])->first();
        return $data;
     }

     public static function checkProfile($id){
        $user = Auth::User();

        if($user->role_name == 'School'){
            $data = School::where(['Name'=>$user->name,'Email'=>$user->email])->first();
        if($data->Username == null || $data->Address == null || $data->State == null || $data->City == null  || $data->Registration == null || $data->Logo == null){
            return 1;
        }else{
            return 0;
        }
        }elseif($user->role_name == 'Super Admin'){
            $admin_school = Session::get('admin_school');
            $data = School::where('Email', $admin_school->Email)->where('Name', $admin_school->Name)->first();
            if($data->Username == null || $data->Address == null || $data->State == null || $data->City == null  || $data->Registration == null || $data->Logo == null){
                return 1;
            }else{
                return 0;
            }
        }elseif($user->role_name == 'Staff'){
            $data = Staff::where('email', $user->email)->where('staff_name', $user->name)->first();
            if($data->staff_name == null || $data->father_name == null){
                return 1;
            }else{
                return 0;
            }
        }

     }

     public static function getSchool(){
        $user = Auth::User();
        // dd($user);
        if($user->role_name == 'School'){
            $school = School::where('Email', $user->email)->where('Name', $user->name)->first();
        }elseif($user->role_name == 'Super Admin'){

            $admin_school = Session::get('admin_school');
            if(!empty($admin_school)){
                // dd($admin_school);
                $school = School::where('Email', $admin_school->Email)->where('Name', $admin_school->Name)->first();

            }else{

                 $school = School::where('Email', $user->email)->where('Name', $user->name)->first();
            }
        }elseif($user->role_name == 'Staff'){
            $staff = Staff::where('email', $user->email)->where('staff_name', $user->name)->first();
            $school = School::where('id',$staff->school_id)->first();
        }

        return $school;

     }

     public static function  getRomanNumber($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';

        $numberarray = array(1,2,3,4,5,6,7,8,9,10);
        if(in_array($number, $numberarray)){
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
        }else{
            $returnValue = $number;
        }

        return $returnValue;
    }

    public static function romanToInt($s) {

        $romanToNumberMap = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ];

        $numberarray = array(1,2,3,4,5,6,7,8,9,10);
        if(in_array($s, $numberarray)){

            $romanChars = array_map("strrev", array_reverse(str_split(strrev($s), 2)));
            $output = 0;
            foreach($romanChars as $romanChar) {
                $previousNumericValue = 1;
                $currentNumericValue= 0;
                for($i=0, $c=strlen($romanChar); $i < $c; $i++) {
                $n = $romanToNumberMap[$romanChar[$i]];
                $currentNumericValue = abs($previousNumericValue < $n ? $currentNumericValue -=$n : $currentNumericValue +=$n);
                $previousNumericValue = $n;
                }
                $output += $currentNumericValue;
            }

        }else{
            $output = $s;
        }

        return $output;
    }

    public static function getClassfees($classid, $fees_id){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $fees = FeesAmount::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1,'class'=> $classid, 'fees_type_id'=> $fees_id ])->first();

        return ($fees);

    }

    public static function getDepositeFees($classid, $stdId){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
            $data = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1,'class_id'=> $classid, 'student_id'=> $stdId ])->sum('fees_paid');

            return $data;
    }
    public static function getPendingFees($classid, $stdId){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
            $depositedata = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1,'class_id'=> $classid, 'student_id'=> $stdId ])->sum('fees_paid');

            $totaldata = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1,'class_id'=> $classid, 'student_id'=> $stdId ])->sum('fees_amount');

            return $totaldata - $depositedata;
    }

    public static function gettotalFees($classid, $stdId){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1,'class_id'=> $classid, 'student_id'=> $stdId ])->sum('fees_amount');

            return $totaldata;
    }

    public static function getFeesTransaction($id,$studentId){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $feesTransaction = FeesType::join('student_fees','student_fees.fees_type_id','=','fees_types.id')->join('fees_transactions', 'student_fees.fees_type_id','=','fees_transactions.fees_type_id')->where(['fees_transactions.school_id' => $school->id, 'fees_transactions.academic_session' => $academic,'fees_transactions.reciept_no' => $id, 'fees_transactions.student_id'=>$studentId])->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.student_id'=>$studentId])->get();

        return $feesTransaction;
    }

    public static function gettotaltodayFees($classid, $stdId, $date = null,$reciept = null){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        if($date == null){
            $date = date('Y-m-d');
        }
            if(!empty($reciept)){
                $totaldata = FeesTransaction::where(['school_id' => $school->id , 'academic_session'=> $academic,'class_id'=> $classid, 'student_id'=> $stdId,'date'=> $date,'online_receipt_no'=>$reciept])->sum('fees_paid_today');
            }else{
                $totaldata = FeesTransaction::where(['school_id' => $school->id , 'academic_session'=> $academic,'class_id'=> $classid, 'student_id'=> $stdId,'date'=> $date])->sum('fees_paid_today');
            }

            return $totaldata;
    }

    public static function getApprovedStudent(){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['school_id' => $school->id , 'academic_session'=> $academic,'status' => 2])->count();
        return $data;
    }

    public static function getpendingStudent(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['school_id' => $school->id , 'academic_session'=> $academic,'status' => 1])->count();
        return $data;
    }

    public static function getrejectedStudent(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['school_id' => $school->id , 'academic_session'=> $academic,'status' => 3])->count();
        return $data;
    }


    public static function getStaff(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Staff::where(['school_id' => $school->id , 'academic_session'=> $academic,'status' => 1])->count();
        return $data;
    }


    public static function todayfees(){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = FeesTransaction::where(['school_id' => $school->id , 'academic_session'=> $academic,'date'=> date('Y-m-d')])->sum('fees_paid_today');

            return $totaldata;
    }



    public static function schoototalfees(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1])->sum('fees_amount');
            return $totaldata;
    }

    public static function schoototalpaidfees(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = StudentFees::where(['school_id' => $school->id , 'academic_session'=> $academic, 'status'=>1])->sum('fees_paid');
            return $totaldata;
    }

    public static function admintotalStudent(){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['academic_session'=> $academic])->count();
        return $data;
    }

    public static function adminApprovedStudent(){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['academic_session'=> $academic,'status'=>2])->count();
        return $data;
    }

    public static function adminPendingStudent(){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = Student::where(['academic_session'=> $academic,'status'=>1])->count();
        return $data;
    }


    public static function adminschoototalfees(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = StudentFees::where(['academic_session'=> $academic, 'status'=>1])->sum('fees_amount');
            return $totaldata;
    }

    public static function adminschoototalpaidfees(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

            $totaldata = StudentFees::where(['academic_session'=> $academic, 'status'=>1])->sum('fees_paid');
            return $totaldata;
    }

    public static function getStaffPower(){

        $user = Auth::User();
        $staffList = Staff::where('email', $user->email)->where('staff_name', $user->name)->first();
        $staffPower = explode(',',$staffList->staff_power);
        return $staffPower;
    }

    public static function getTeacherClass(){

        $user = Auth::User();
        $staff = Staff::where('email', $user->email)->where('staff_name', $user->name)->first();
        $allot_class = explode(',',$staff->allot_class);
        return $allot_class;
    }

    public static function getStaffRole(){

        $user = Auth::User();
        $staff = Staff::where('email', $user->email)->where('staff_name', $user->name)->first();
        if($staff != null){
            return $staff->appointment_position;
        }else{
            $staff = 'School';
            return $staff;
        }

    }

    public static function getstudentFeesTransaction($classid, $stdId, $date = null){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        if($date == null){
            $date = date('Y-m-d');
        }
            $totaldata = FeesTransaction::where(['school_id' => $school->id , 'academic_session'=> $academic,'class_id'=> $classid, 'student_id'=> $stdId,'date'=> $date])->first();

            return $totaldata;
    }



}
