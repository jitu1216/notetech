<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\StateCities;
use App\Models\AcademicSession;
use App\Models\Staff;
use Session;
use App\Helper\Custom;
use Auth;

class SchoolDashboardController extends Controller
{
    public function index(){
        if(!Session::get('academic_session')){
            $nextyear = substr(date("Y"), -2) + 1;
                $year = date("Y").'-'.$nextyear;
                Session::put('academic_session', $year);
        }

        $data = AcademicSession::all();
        Session::put('all_academic_session', $data);
        return view('school.school');
    }

    public function profileView(){

        $user = Auth::User();
        $academic = Session::get('academic_session');

        if($user->role_name == 'School'){
            $data = School::where(['Email'=> $user->email,'Name'=>$user->name])->first();
        }elseif($user->role_name == 'Super Admin'){
            $admin_school = Session::get('admin_school');
            $data = School::where('Email', $admin_school->Email)->where('Name', $admin_school->Name)->first();
        }elseif($user->role_name == 'Staff'){
            $staffList = Staff::where('email', $user->email)->where('academic_session', $academic)->first();
        }

        $statedata = StateCities::all()->toarray();
        $state =  [];
        foreach($statedata as $value){
            if(!in_array($value['state'], $state)){
                array_push($state, $value['state']);
            }
        }

        $school = Custom::getSchool();

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();
        // dd($schoolclass);
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


        if($user->role_name == 'School' || $user->role_name == 'Super Admin'){
                 return view('school.profile', compact('data','state'));
        }elseif($user->role_name == 'Staff'){

        $check = 1;
        $staffPower = explode(',',$staffList->staff_power);
        $allot_class = explode(',',$staffList->allot_class);

        return view('school.staff.update-staff', compact('staffList','state','staffPower','check','finalarray','allot_class'));
        }
    }

    public function schoolClass(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($academic);

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number =  Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }
        // dd($schoolclass);
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
        $data = array();
        foreach ($newroman as $value) {
            foreach ($schoolclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $data[] = $x;
                }
                $x = [];
            }
        }
        // dd($data);
        return view('school.class.class-list', compact('data','academic'));
    }

    public function addClass(){
        return view('school.class.addclass');
    }

    public function saveClass(Request $request){


        $this->validate($request,[
            'class' => 'required',
         ]);

        $class =Custom::getRomanNumber($request->class);
        $school = Custom::getSchool();


        $data = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($academic);
        $schooldata = SchoolClass::where(['school_id' => $data->id, 'academic_session' => $academic,'status' => '0'])->get();

        foreach($schooldata as $value){
            if($value->classname == $class){
                return redirect()->back()->with('Error','Class Already Present!');
            }
        }

        $save = new SchoolClass;
        $save->classname = $class;
        $save->school_id = $school->id;
        $save->academic_session = Session::get('academic_session');
        $save->save();
        return redirect()->route('schoolClass')->with('Success','Class Added Successfully!');
    }


    public function saveSubject(){

        $schooldata = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($academic);
        $data = Subject::where(['school_id' => $schooldata->id, 'academic_session' => $academic,'status' => '1'])->get();

        return view('school.subject.subject-list',compact('data'));
    }

    public function addSubject(){
        return view('school.subject.addsubject');
    }

    public function storeSubject(Request $request){
        $this->validate($request,[
            'subject' => 'required',
            'FA1' => 'required|numeric|max:100',
            'FA2' => 'required|numeric|max:100',
            'SA1' => 'required|numeric|max:100',
            'SA2' => 'required|numeric|max:100',
            'Practical' => 'required|numeric|max:100',
         ]);

         $school = Custom::getSchool();
         $class = 'class';

         $data = Subject::where(['subject_name' => $request->subject, 'academic_session' => Session::get('academic_session'),'school_id'=> $school->id])->first();

            $save = new Subject;
            $save->subject_name = $request->subject;
            $save->academic_session = Session::get('academic_session');
            $save->school_id = $school->id;
            $save->FA1 = $request->FA1;
            $save->FA2 = $request->FA2;
            $save->SA1 = $request->SA1;
            $save->SA2 = $request->SA2;
            $save->practicle = $request->Practical;
            $save->status = 1;
            $save->save();

            $subjectId = $save->id;
            $subarrray;
            for ($i = 1; $i < 26; $i++) {
                $class = $class.$i;
                $class_id =Custom::getRomanNumber($request[$class]);

                if(isset($request[$class])){
                    $getClass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => Session::get('academic_session'),'status' => '0','classname'=>$class_id])->first();

                    if(!empty($getClass)){
                        if(!empty($getClass->subject_id)){
                            $subarrray = $getClass->subject_id.','. $subjectId;
                        }else{
                            $subarrray = $subjectId;
                        }
                            $getClass->subject_id = $subarrray;
                            $getClass->update();
                    }else{
                        return redirect()->route('view-subject', $subjectId)->with('Error',"Class '$class_id' not Available!");
                    }
                }
                $class = 'class';
              }
              return redirect()->route('schoolsubject')->with('Success','Subject Created Successfully!');

    }

    public function viewSubject($id){
        $check = [];
        $school = Custom::getSchool();
        $data = Subject::where('id',$id)->first();
        $getClass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => Session::get('academic_session'),'status' => '0'])->get();
        foreach($getClass as $key => $value){
            $subjectId = explode(',',$value->subject_id);
            foreach($subjectId as $subject){
                if($subject == $data->id){
                    array_push($check,$value->classname);
                }
            }

        }
        // dd($check);
        return view('school.subject.updatesubject',compact('data','check'));
    }

    public function updateSubject(Request $request){

        $this->validate($request,[
            'subject' => 'required',
            'FA1' => 'required|numeric|max:100',
            'FA2' => 'required|numeric|max:100',
            'SA1' => 'required|numeric|max:100',
            'SA2' => 'required|numeric|max:100',
            'Practical' => 'required|numeric|max:100',
         ]);

         $school = Custom::getSchool();
         $class = 'class';

            $data = Subject::where('id',$request->id)->first();

            $data->subject_name = $request->subject;
            $data->FA1 = $request->FA1;
            $data->FA2 = $request->FA2;
            $data->SA1 = $request->SA1;
            $data->SA2 = $request->SA2;
            $data->practicle = $request->Practical;
            $data->update();
            $subarrray;


            $sortedArray = ['P.N.C.','N.C.','K.G.','L.K.G.','U.K.G.','I','II','III','IV','V','VI','VII','VIII','IX','X','XI (Art)','XI (Biology)','XI (Agriculture)','XI (Mathematics)','XI (Commerce)','XII (Art)','XII (Biology)','XII (Agriculture)','XII (Mathematics)','XII (Commerce)'];


            foreach($sortedArray as $key => $value){
                $Class_details = SchoolClass::where(['school_id' => $school->id, 'academic_session' => Session::get('academic_session'),'status' => '0','classname'=>$value])->first();

                if(!empty($Class_details->subject_id)){
                    $subId = explode(',',$Class_details->subject_id);
                    foreach($subId as $id => $subvalue){
                        if($subvalue == $request->id){
                            unset($subId[$id]);
                        }
                    }
                        $newsub = implode(",",$subId);
                        $Class_details->subject_id = $newsub;
                        $Class_details->update();


                }

            }

        //  dd($request);
            for ($i = 1; $i < 26; $i++) {
                $class = $class.$i;

                $class_id = Custom::getRomanNumber($request[$class]);
                if(isset($request[$class])){

                    $getClass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => Session::get('academic_session'),'status' => '0','classname'=>$class_id])->first();

                    if(!empty($getClass)){
                        if(!empty($getClass->subject_id)){
                            $subjectId = explode(',',$getClass->subject_id);
                            if(!in_array($request->id,$subjectId)){
                                array_push($subjectId,$request->id);
                            }
                            $subarrray = implode(",",$subjectId);

                        }else{
                            $subarrray = $request->id;
                        }
                            $getClass->subject_id = $subarrray;
                            $getClass->update();
                    }else{
                        return redirect()->route('view-subject', $request->id)->with('Error',"Class '$class_id' not Available!");
                    }
                }
                $class = 'class';
              }

              return redirect()->route('view-subject', $request->id)->with('Success',"Subject Updated Successfully!");
    }

}
