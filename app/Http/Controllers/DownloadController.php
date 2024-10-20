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
use App\Models\Tc;
use App\Models\NOC;
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

            $tcdata = Tc::where(['student_id' => $id])->first();
            // dd($tcdata);

            // $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
            // $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
            return view('school.download.tc',compact('finalarray','schoolclass','mark','studentList','dobFormatted','tcdata'));
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


    public function storeTc(Request $request){


        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($request);

        $request->validate([
            'admission_file_no' => 'required',
            'withdraw_file_no' => 'required',
            'transfer_certificate_no' => 'required',
            'tc_date' => 'required'
        ]);



        $data = [
            'student_id' => $request->input('student_id'),
            'academic_session' => $academic,
            'school_id' => $school->id,
            'class_id' => $school->id,
            'class_1' => $request->input('class_1'),
            'date_of_admission_1' => $request->input('date_of_admission_1'),
            'date_of_promotion_1' => $request->input('date_of_promotion_1'),
            'date_of_removal_1' => $request->input('date_of_removal_1'),
            'Causes_1' => $request->input('causes_1'),
            'session_1' => $request->input('session_1'),
            'conduct_1' => $request->input('conduct_1'),
            'work_1' => $request->input('work_1'),
            'class_2' => $request->input('class_2'),
            'date_of_admission_2' => $request->input('date_of_admission_2'),
            'date_of_promotion_2' => $request->input('date_of_promotion_2'),
            'date_of_removal_2' => $request->input('date_of_removal_2'),
            'Causes_2' => $request->input('causes_2'),
            'session_2' => $request->input('session_2'),
            'conduct_2' => $request->input('conduct_2'),
            'work_2' => $request->input('work_2'),
            'class_3' => $request->input('class_3'),
            'date_of_admission_3' => $request->input('date_of_admission_3'),
            'date_of_promotion_3' => $request->input('date_of_promotion_3'),
            'date_of_removal_3' => $request->input('date_of_removal_3'),
            'Causes_3' => $request->input('causes_3'),
            'session_3' => $request->input('session_3'),
            'conduct_3' => $request->input('conduct_3'),
            'work_3' => $request->input('work_3'),
            'class_4' => $request->input('class_4'),
            'date_of_admission_4' => $request->input('date_of_admission_4'),
            'date_of_promotion_4' => $request->input('date_of_promotion_4'),
            'date_of_removal_4' => $request->input('date_of_removal_4'),
            'Causes_4' => $request->input('causes_4'),
            'session_4' => $request->input('session_4'),
            'conduct_4' => $request->input('conduct_4'),
            'work_4' => $request->input('work_4'),
            'class_5' => $request->input('class_5'),
            'date_of_admission_5' => $request->input('date_of_admission_5'),
            'date_of_promotion_5' => $request->input('date_of_promotion_5'),
            'date_of_removal_5' => $request->input('date_of_removal_5'),
            'Causes_5' => $request->input('causes_5'),
            'session_5' => $request->input('session_5'),
            'conduct_5' => $request->input('conduct_5'),
            'work_5' => $request->input('work_5'),
            'class_6' => $request->input('class_6'),
            'date_of_admission_6' => $request->input('date_of_admission_6'),
            'date_of_promotion_6' => $request->input('date_of_promotion_6'),
            'date_of_removal_6' => $request->input('date_of_removal_6'),
            'Causes_6' => $request->input('causes_6'),
            'session_6' => $request->input('session_6'),
            'conduct_6' => $request->input('conduct_6'),
            'work_6' => $request->input('work_6'),
            'class_7' => $request->input('class_7'),
            'date_of_admission_7' => $request->input('date_of_admission_7'),
            'date_of_promotion_7' => $request->input('date_of_promotion_7'),
            'date_of_removal_7' => $request->input('date_of_removal_7'),
            'Causes_7' => $request->input('causes_7'),
            'session_7' => $request->input('session_7'),
            'conduct_7' => $request->input('conduct_7'),
            'work_7' => $request->input('work_7'),
            'class_8' => $request->input('class_8'),
            'date_of_admission_8' => $request->input('date_of_admission_8'),
            'date_of_promotion_8' => $request->input('date_of_promotion_8'),
            'date_of_removal_8' => $request->input('date_of_removal_8'),
            'Causes_8' => $request->input('causes_8'),
            'session_8' => $request->input('session_8'),
            'conduct_8' => $request->input('conduct_8'),
            'work_8' => $request->input('work_8'),
            'class_9' => $request->input('class_9'),
            'date_of_admission_9' => $request->input('date_of_admission_9'),
            'date_of_promotion_9' => $request->input('date_of_promotion_9'),
            'date_of_removal_9' => $request->input('date_of_removal_9'),
            'Causes_9' => $request->input('causes_9'),
            'session_9' => $request->input('session_9'),
            'conduct_9' => $request->input('conduct_9'),
            'work_9' => $request->input('work_9'),
            'class_10' => $request->input('class_10'),
            'date_of_admission_10' => $request->input('date_of_admission_10'),
            'date_of_promotion_10' => $request->input('date_of_promotion_10'),
            'date_of_removal_10' => $request->input('date_of_removal_10'),
            'Causes_10' => $request->input('causes_10'),
            'session_10' => $request->input('session_10'),
            'conduct_10' => $request->input('conduct_10'),
            'work_10' => $request->input('work_10'),
            'transfer_certificate_no' => $request->input('transfer_certificate_no'),
            'withdrwal_file_no' => $request->input('withdraw_file_no'),
            'addmission_file_no' => $request->input('admission_file_no'),
            'tc_date' => $request->input('tc_date'),
            'tc_count' => $request->input('tc_count'),

        ];

        // Set the conditions for updateOrCreate
        $conditions = [
            'academic_session' => $academic,
            'school_id' => $school->id,
            'student_id' => $request->input('student_id'),
        ];

        // Use updateOrCreate to either update an existing record or create a new one
        $record = Tc::updateOrCreate($conditions, $data);

        return redirect()->back()->with('Success','TC Information Saved');



    }

    public function viewnoc($id,$text){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
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
        $noc = NOC::where(['school_id' => $school->id, 'academic_session' => $academic, 'student_id'=>$id ])->first();
        $studentList = Student::find($id);

            $mark = 2;
            return view('school.download.noc',compact('finalarray','text','schoolclass','mark','studentList','session','noc'));
    }

    public function noclist($text){
        // dd($text);
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
            $mark = 2;

        return view('school.download.noc-list',compact('finalarray','schoolclass','mark','studentList','text'));


    }

    public function searchnoc(Request $request)
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
        return view('school.download.noc-list', compact('studentList', 'mark', 'finalarray','studentsearch','class'));

    }

    public function savenoc(Request $request){
        // dd($request);
        $request->validate([
            'date' => 'required',
            'receipt_no' => 'required',
        ]);
        $school = custom::getschool();
        $academic = Session::get('academic_session');
        $cc = NOC::updateOrCreate([
            'student_id' => $request->student_id,
            'academic_session' => $academic,
            'school_id' => $school->id,
        ], [
            'date' => date('Y-m-d', strtotime($request->date)),
            'receipt_no' => $request->receipt_no,
            'exam_type' => $request->exam_type,
        ]);

        // return redirect()->route('cc')->with('success','CC Information Saved');
        return redirect()->back()->with('Success','CC Information Saved');
    }

}