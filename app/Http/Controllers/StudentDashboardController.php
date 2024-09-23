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
use App\Models\slider;
use App\Models\Staff;
use App\Models\FeesTransaction;
use App\Models\TimeTable;
use Session;
use Custom;
use Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $slider = slider::where(['academic_session' => $academic, 'school_id' => $school->id])->get();
        return view('studentDashboard.student-home', compact('slider'));
    }

    public function feesdeposite()
    {
        return view('studentDashboard.fees.feesdeposite');
    }


    public function student_profile()
    {

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

    public function timeTable()
    {
        $user = Auth::guard('student')->User();
        $finalarray = Custom::getAllClass();
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $subject = Subject::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();
        $checkteacher = false;

        $timetable = TimeTable::whereRaw('FIND_IN_SET(?, class_id)', [$user->class_id])
            ->where(['school_id' => $school->id, 'academic_session' => $academic])
            ->orderByRaw("STR_TO_DATE(time, '%l:%i %p') ASC")
            ->with('staff') // Eager load staff data
            ->get();
        $check = true;
        // dd($timetable);
        return view('studentDashboard.time-table.view-time-table', compact('finalarray', 'subject', 'user', 'timetable', 'check', 'checkteacher', 'school'));
    }

    public function feesInfo()
    {

        $user = Auth::guard('student')->User();
        $id = $user->id;
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $studentEdit = Student::where('id', $id)->first();
        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
            $number =  Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.','N.C.','K.G.','L.K.G.','U.K.G.','I','II','III','IV','V','VI','VII','VIII','IX','X','XI (Art)','XI (Biology)','XI (Agriculture)','XI (Mathematics)','XI (Commerce)','XII (Art)','XII (Biology)','XII (Agriculture)','XII (Mathematics)','XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach($sortedArray as $organize){
            if(in_array($organize,$newClass)){
                array_push($newromanclass, $organize);
            }
        }

        foreach ($newromanclass as $sortClass) {
            $newnumber = Custom::getRomanNumber($sortClass);
            array_push($newroman, $newnumber);
            // dd($newroman);
        }
        $finalarray = array();

        foreach ($newroman as $value) {
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        $data = FeesTransaction::where(['school_id'=> $school->id, 'academic_session' => $academic])->orderBy('id', 'DESC')->first();

        if(!empty($data)){
            $online_receipt_no = (int)$data->online_receipt_no + 1;
        }else{
            $online_receipt_no = (int)$school->fees_no + 1;
        }

        $classId = $studentEdit->class_id;

        $feesController = new FeesController();
        $studentfees = $feesController->updateStudentFees($classId);

        $stafflist = Staff::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();

        $feestype = StudentFees::join('fees_types', 'fees_types.id','=','student_fees.fees_type_id')->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.status' => 1, 'student_fees.class_id' => $classId, 'student_fees.student_id'=>$id])->get();

        return view('studentDashboard.fees.feesdeposite', compact('feestype', 'finalarray', 'classId', 'studentEdit','stafflist','online_receipt_no'));
    }


    public function feesCard(){

        $user = Auth::guard('student')->User();
        $id = $user->id;
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $data = FeesTransaction::where(['school_id' => $school->id, 'academic_session' => $academic,'class_id'=>$student->class_id,'student_id' => $id])->get();
        $unique = $data->unique('reciept_no');
        // dd($unique);
            if(!empty($unique->toArray())){
                return view('studentDashboard.fees.fees-report',compact('student','schoolclass','unique'));
            }else{
                return redirect()->back()->with('Warning', 'No Fees Receipt Found!');
            }

        }
}
