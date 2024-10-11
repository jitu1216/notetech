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
use App\Models\Maintenance;
use App\Models\Item;
use Session;
use App\Helper\Custom;
use Auth;
use Carbon\Carbon;

class MaintenanceController extends Controller
{

    public function item_list(){

    $school = Custom::getschool();
    $academic = Session::get('academic_session');
    $item = Item::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
    return view('school.schoolmaintenance.item-list', compact('item'));

    }

    public function additem(){
        return view('school.schoolmaintenance.add-item');
    }

    public function saveitem(Request $request){
        // dd($request);
        $request->validate([
            'item_name' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new Item;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        $item->item_name= $request->item_name;
        $item->save();

        return redirect()->route('item_list')->with('Success','Class Added Successfully');

    }

    public function edititem($id){

        $item = Item::find($id);

        return view('school.schoolmaintenance.edit-item', compact('item'));
    }

    public function updateitem(Request $request){
      

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new Item;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        
        $item->item_name= $request->item_name;
        $item->save();

        return redirect()->route('item_list')->with('Success','Class Edit Successfully');

    }

    public function removeitem($id){

        $record = Item::find($id);

        if($record){
            $record-> delete();
            return redirect()->back()->with('Success','Item delete Successfully');
        }
        else {
            return redirect()->back()->with('Success','Item Not Found');
        }
    }

    public function studentmaintenancelist(){

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

            // $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
            // $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
            return view('school.schoolmaintenance.student-maintenance-list',compact('finalarray','schoolclass','mark','studentList'));
    }

    public function searchstudentmaintenance(Request $request)
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
        return view('school.download.tc-cc-list', compact('studentList', 'mark', 'finalarray','studentsearch','class'));

    }

    public function studentmaintenance($id){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $item = Item::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        // dd($item);
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

        

        $studentList = Student::find($id);
            $mark = 2;

            return view('school.schoolmaintenance.student-maintenance',compact('finalarray',
            'schoolclass','mark','studentList','item','session'));
    }

    public function savestudentmaintenance(Request $request){
       
        // dd($request);
        $school = custom::getschool();
        $academic = Session::get('academic_session');

        $data =  Maintenance::where(['student_id' => $request->student_id, 'academic_session' => $academic,'school_id' => $school->id])->get();

        // dd($data);


        if($data->isEmpty()){

            foreach($request->item as $value){
                $status = 0;
                foreach($request->status as $item){
                    if($item == $value){
                        $status = 1;
                    }
                }
    
                $main = new Maintenance();
                $main->student_id = $request->student_id;
                $main->school_id = $school->id;
                $main->academic_session = $academic;
                $main->class_id = $request->class_id;
                $main->item_status = $status;
                $main->item_id = $value;
                $main->save();
            }
            
        }else{
            foreach($request->item as $value){
                $status = 0;
                foreach($request->status as $item){
                    if($item == $value){
                        $status = 1;
                    }
                }
    
                $main = Maintenance::where(['student_id' => $request->student_id, 'academic_session' => $academic,'school_id' => $school->id,  'item_id' => $value])->first();
                $main->student_id = $request->student_id;
                $main->school_id = $school->id;
                $main->academic_session = $academic;
                $main->class_id = $request->class_id;
                $main->item_status = $status;
                $main->item_id = $value;
                $main->update();
            }
        }
       
        return redirect()->back()->with('Success','Maintenance Saved');
    }
}
