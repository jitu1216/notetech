<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\School;
use App\Models\Subject;
use App\Models\Student;
use App\Models\StudentFees;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use App\Models\ExamScheme;
use App\Models\SchemeHeader;
use App\Models\cc;
use Session;
use App\Helper\Custom;
use Auth;
use Carbon\Carbon;
use App\Models\Topperstudent;

class TopperStudentController extends Controller
{
    public function topperstudent(){
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        
            return view('school.topperstudent.topperstudent-list');
    }

    public function addtopper(){
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
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
            foreach ($schoolclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        $session = Session::get('all_academic_session');
        // dd($session);

        // $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => '2', 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();
            $mark = 2;
            return view('school.topperstudent.add-topper',compact('finalarray','schoolclass','mark','session'));
    }

       
    

    public function savetopper(Request $request){
        // dd($request);
        $request->validate([
            'subject_total' => 'required',
            'total_mark_obtain' => 'required',
            'rank' => 'required',
        ]);

        $school = custom::getschool();
        $academic = Session::get('academic_session');

        $topper = new Topperstudent;
        $topper->academic_session = $academic;
        $topper->school_id = $school->id;
        $topper->class_id = $request->class_id;
        $topper->student_id = $request->student_id;
        $topper->subject_total = $request->subject_total;
        $topper->total_mark_obtain = $request->total_mark_obtain;
        $topper->rank = $request->rank;
       
        $topper->save();

        return redirect()->route('topper-student')->with('success', 'Topper Student Added Successfully');
       
    }

    public function removescheme()
    {
        $record = Topperstudent::find();

        if ($record) {
            $record->delete();
            return redirect()->route('topper-student')->with('Success', 'Topper Student Deleted Successfully!');
        } else {
            return redirect()->back()->with('Error', 'Topper Not Found!');
        }
    }
}


