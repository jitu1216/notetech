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
use Session;
use App\Helper\Custom;
use Auth;
use Carbon\Carbon;
class ExmaController extends Controller
{
    public function exam_list(){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme = ExamScheme::where(['academic_session' => $academic, 'school_id' => $school->id])->get();
        return view('school.exam-scheme.exam_list', compact('scheme'));
    }

    public function addscheme()
    {
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
        return view('school.exam-scheme.add-scheme', compact('scheme_header'));
    }
    public function savescheme(Request $request){

        // dd($request);
        $request->validate([
            'exam_date' => 'required',
            'exam_type' => 'required',
            'exam_class' => 'required',
            'exam_subject' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $exam_scheme = new ExamScheme;
        $exam_scheme->academic_session = $academic;
        $exam_scheme->school_id = $school->id;
        $exam_scheme->exam_type = $request->exam_type;
        $exam_scheme->exam_class = $request->exam_class;
        $exam_scheme->exam_subject = $request->exam_subject;
        $exam_scheme->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $exam_scheme->save();

        return redirect()->route('exam_list')->with('Success','Scheme Added successfull ');
    }

    public function editscheme($id){
        $item = ExamScheme::find($id);
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
        return view('school.exam-scheme.edit-scheme', compact('item','scheme_header'));
    }

    public function updatescheme(Request $request){


        $request->validate([
            'exam_date' => 'required',
            'exam_type' => 'required',
            'exam_class' => 'required',
            'exam_subject' => 'required',
        ]);

        // dd($request);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $exam_scheme = ExamScheme::find($request->id);

        $exam_scheme->academic_session = $academic;
        $exam_scheme->school_id = $school->id;
        $exam_scheme->exam_type = $request->exam_type;
        $exam_scheme->exam_class = $request->exam_class;
        $exam_scheme->exam_subject = $request->exam_subject;
        $exam_scheme->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $exam_scheme->save();

        return redirect()->route('exam_list')->with('sucess','Scheme added successfull ');
    }
    public function removescheme($id){
        $record = ExamScheme::find($id);

        if ($record) {
            $record->delete();
            return redirect()->route('exam_list')->with('Success', 'Scheme Deleted Successfully!');
        } else {
            return redirect()->back()->with('Error', 'Scheme Not Found!');
        }
    }


    public function viewtestscheme($text){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
        $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();

        return view('school.exam-scheme.view-test-scheme',compact('scheme','scheme_header','text'));

    }

    public function idcard(){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,])->get();

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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> '2' ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();

        // dd($studentList);

            $mark = 2;
               return view('school.exam-scheme.id-card',compact('finalarray','schoolclass','mark','studentList'));
    }
     
    public function searchIdcard(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

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
        // dd($newroman);

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

        if($request->searchId == 2) {
            $mark = 2;
        }
        if($request->searchId == 1) {
            $mark = 1;
        }
        if($request->searchId == 3) {
            $mark = 3;
        }
        if($request->searchId == 4){
            $mark = 4;
        }
        if($request->searchId == 5){
            $mark = 2;
        }

        if (!empty($request->Class)) {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request,$mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('students.status', $mark)->get();

        }else{
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request,$mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $mark)->get();
        }

        if($request->searchId == 5){
            $mark = 5;
        }



        $studentsearch = $request->studentsearch;
        $class =  $request->Class;
        // dd($class);
        return view('school.exam-scheme.id-card', compact('studentList', 'mark', 'finalarray','studentsearch','class'));


    }
}
