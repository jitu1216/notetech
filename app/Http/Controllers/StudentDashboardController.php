<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FeesController;
use DB;
use App\Models\Student;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\StateCities;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\School;
use App\Models\Subject;
use App\Models\StudentFees;
use App\Models\AcademicSession;
use Session;
use Custom;
use Auth;

class StudentDashboardController extends Controller
{
    public function index(){
        return view('studentDashboard.student-home');
    }

    public function feesdeposite(){
        return view('studentDashboard.fees.feesdeposite');
    }

    // public function student_profile()
    // {

    //     $id = Auth::guard('student')->User()->id;
    //     $student = Student::where('id', $id)->first();

    //     $schoolclass = SchoolClass::where('id', $student->class_id)->first();
    //     $subjectList = explode(",", $student->subject_id);

    //     foreach ($subjectList as $value) {
    //         $data = Subject::where('id', $value)->first();
    //         $subject[] = $data->subject_name;
    //     }

    //     $data = StateCities::all()->toarray();
    //     $state =  [];
    //     $city = [];
    //     foreach ($data as $value) {
    //         if (!in_array($value['state'], $state)) {
    //             array_push($state, $value['state']);
    //         }
    //     }

    //     $school = Custom::getSchool();
    //     $academic = Session::get('academic_session');
    //     $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


    //     foreach ($scclass as $class) {
    //         $number =  Custom::romanToInt($class->classname);
    //         $newClass[$class->id] = $number;
    //     }

    //     $sortedArray = ['P.N.C.','N.C.','K.G.','L.K.G.','U.K.G.','I','II','III','IV','V','VI','VII','VIII','IX','X','XI (Art)','XI (Biology)','XI (Agriculture)','XI (Mathematics)','XI (Commerce)','XII (Art)','XII (Biology)','XII (Agriculture)','XII (Mathematics)','XII (Commerce)'];
    //     $newroman = [];
    //     sort($newClass);
    //     $newromanclass = [];

    //     foreach($sortedArray as $organize){
    //         if(in_array($organize,$newClass)){
    //             array_push($newromanclass, $organize);
    //         }
    //     }

    //     foreach ($newromanclass as $sortClass) {
    //         $newnumber = Custom::getRomanNumber($sortClass);
    //         array_push($newroman, $newnumber);
    //         // dd($newroman);
    //     }
    //     // dd($newroman);

    //     $finalarray = array();


    //     foreach ($newroman as $value) {
    //         foreach ($scclass as $class) {
    //             if ($class->classname == $value) {
    //                 $x['classname'] = $class->classname;
    //                 $x['id'] = $class->id;
    //                 $finalarray[] = $x;
    //             }
    //             $x = [];
    //         }
    //     }

    //         return view('studentDashboard.student.student_profile', compact('student', 'schoolclass', 'subject', 'state', 'finalarray'));

    // }

    public function student_profile(){

        $id = Auth::guard('student')->User()->id;
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $subjectList = explode(",", $schoolclass->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data;
        }
        return view('studentDashboard.student.student_profile', compact('student', 'schoolclass', 'subject'));
    }
}
