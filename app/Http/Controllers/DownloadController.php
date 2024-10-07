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

class DownloadController extends Controller
{
    public function idcard()
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }
        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => '2', 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();

        // dd($studentList);

        $mark = 2;
        return view('school.download.id-card', compact('finalarray', 'schoolclass', 'mark', 'studentList'));
    }

    public function searchIdcard(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }
        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        if ($request->searchId == 2) {
            $mark = 2;
        }
        if ($request->searchId == 1) {
            $mark = 1;
        }
        if ($request->searchId == 3) {
            $mark = 3;
        }
        if ($request->searchId == 4) {
            $mark = 4;
        }
        if ($request->searchId == 5) {
            $mark = 2;
        }

        if (!empty($request->Class)) {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('students.status', $mark)->get();

        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $mark)->get();
        }

        if ($request->searchId == 5) {
            $mark = 5;
        }



        $studentsearch = $request->studentsearch;
        $class = $request->Class;
        // dd($class);
        return view('school.download.id-card', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));

    }

    public function admitcard($text)
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }
        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => '2', 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();

            $mark = 2;

            // $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
            // $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();

            return view('school.download.admit-card',compact('finalarray','schoolclass','mark','studentList','text'));
    }



    public function searchadmitcard(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }
        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        if ($request->searchId == 2) {
            $mark = 2;
        }
        if ($request->searchId == 1) {
            $mark = 1;
        }
        if ($request->searchId == 3) {
            $mark = 3;
        }
        if ($request->searchId == 4) {
            $mark = 4;
        }
        if ($request->searchId == 5) {
            $mark = 2;
        }

        if (!empty($request->Class)) {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('students.status', $mark)->get();

        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $mark)->get();
        }

        if ($request->searchId == 5) {
            $mark = 5;
        }
        $text = $request->text;



        $studentsearch = $request->studentsearch;
        $class = $request->Class;
        // dd($class);
        return view('school.download.admit-card', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class','text'));

    }



       public function deskslip($text){

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
            return view('school.download.desk-slip',compact('finalarray','schoolclass','mark','studentList','text'));
    }


    public function searchdeskslip(Request $request)
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
        $text = $request->text;


        $studentsearch = $request->studentsearch;
        $class =  $request->Class;
        // dd($class);
        return view('school.download.desk-slip', compact('studentList', 'mark', 'finalarray','studentsearch','class','text'));

    }

    
    private function numberToWords($number)
    {
        $words = [
            0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five',
            6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten',
            11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
            15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen',
            20 => 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 1000 => 'thousand', 100 => 'hundred'
        ];
    
        if ($number < 20) {
            return $words[$number];
        } elseif ($number < 100) {
            return $words[intval($number / 10) * 10] . ($number % 10 ? ' ' . $words[$number % 10] : '');
        } elseif ($number < 1000) {
            return $words[intval($number / 100)] . ' hundred' . ($number % 100 ? ' ' . $this->numberToWords($number % 100) : '');
        } else {
            return $words[intval($number / 1000)] . ' thousand' . ($number % 1000 ? ' ' . $this->numberToWords($number % 1000) : '');
        }
    }
    
    

    
    public function tc($id){

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
        // dd($finalarray);
        // $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> '2' ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();
        $studentList = Student::find($id);
        // dd($studentList);

        $dob = Carbon::parse($studentList->dob);
    
        // Convert day, month, and year to words
        $day = $this->numberToWords($dob->day);
        $month = $dob->format('F'); // Month in words
        $year = $this->numberToWords($dob->year); // Convert the full year to words
    
        $dobFormatted = "{$day} {$month} {$year}";

            $mark = 2;

            // $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
            // $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
            return view('school.download.tc',compact('finalarray','schoolclass','mark','studentList','dobFormatted'));
    }


    public function cc($id){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $cc = cc::where(['school_id' => $school->id, 'academic_session' => $academic, 'student_id'=>$id ])->first();
        // dd($cc);
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
            return view('school.download.cc',compact('finalarray','schoolclass','mark','studentList','cc','session'));
    }

    public function savecc(Request $request){
        // dd($request);
        $request->validate([
            'year' => 'required',
            'date' => 'required',
            'conduct' => 'required'
        ]);
        $school = custom::getschool();
        $academic = Session::get('academic_session');
        $cc = CC::updateOrCreate([
            'student_id' => $request->student_id,
            'academic_session' => $academic,
            'school_id' => $school->id,
        ], [
            'year' => $request->year,
            'date' => date('Y-m-d', strtotime($request->date)),
            'conduct' => $request->conduct,
            'class_id' => $request->class_id,
        ]);

        // return redirect()->route('cc')->with('success','CC Information Saved');
        return redirect()->back()->with('Success','CC Information Saved');
    }

    public function tccclist(){

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
            return view('school.download.tc-cc-list',compact('finalarray','schoolclass','mark','studentList'));

    
    }

    public function searchtccc(Request $request)
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

    
}
