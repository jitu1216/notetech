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
use Session;
use Custom;
use Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function takestudentattendance($id = null)
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
        $class = $id;

        if ($class != null) {
            $studentlist = Student::where(['class_id' => $class, 'school_id' => $school->id, 'academic_session' => $academic, 'status' => '2'])->get();
        } else {
            $studentlist = null;
        }
        // dd($studentlist);

        return view('school.attendance.take_student_attendance', compact('finalarray', 'class', 'studentlist'));
    }

    public function saveStudentAttendance(Request $request)
    {
        // dd($request);

        $request->validate([
            'date' => 'required'
        ]);

        if (!empty($request->attendance)) {
            for ($i = 0; $i <= $request->total; $i++) {
                // Check if $i is a key in the associative array
                if (!array_key_exists($i, $request->attendance)) {
                    return redirect()->back()->withInput();
                }
            }
        }else{
            return redirect()->back()->withInput();
        }

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $getdate =  Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $attendance = Attendance::where(['class_id' => $request->Class, 'school_id' => $school->id, 'academic_session' => $academic, 'date' => $getdate])->get();

        if($attendance->count() === 0){

            foreach($request->student as $key => $value){
                $student = new Attendance;
                $student->student_id = $value;
                $student->academic_session = $academic;
                $student->school_id = $school->id;
                $student->class_id = $request->Class;
                $student->attendance_type = $request->attendance[$key];
                $student->date = date('Y-m-d',strtotime($request->date));
                // dd($student);
                $student->save();
            }

            $return_date = date('d-m-Y',strtotime($request->date));

            return redirect()->route('school/view_student_attendance', [
                'id' => $request->Class,
                'date' => $return_date
            ])->with('Success', 'Attendance Taked Successfully!');
        }else{

            return redirect()->back()->with('Error', 'Attendance Already Taken Successfully!')->withInput();
        }

    }

    public function viewstudentattendance($id = null, $date = null)
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
        $class = $id;

        if ($class != null) {
            $studentlist = Student::where(['class_id' => $class, 'school_id' => $school->id, 'academic_session' => $academic, 'status' => '2'])->get();
        } else {
            $studentlist = null;
        }
        // dd($date);
        if($date == null){
            $date = Carbon::now()->format('d-m-Y');
            $attendance = null;
        }else{
            $getdate =  Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
            $attendance = Attendance::where(['class_id' => $class, 'school_id' => $school->id, 'academic_session' => $academic, 'date' => $getdate])->get();
        }
        // dd($attendance->count());

        return view('school.attendance.view_student_attendance', compact('finalarray', 'class', 'studentlist','date','attendance'));
    }

    public function updatestudentattendance(Request $request)
    {
        // dd($request);

        $request->validate([
            'date' => 'required'
        ]);

        if (!empty($request->attendance)) {
            for ($i = 0; $i <= $request->total; $i++) {
                // Check if $i is a key in the associative array
                if (!array_key_exists($i, $request->attendance)) {
                    return redirect()->back()->withInput();
                }
            }
        }else{
            return redirect()->back()->withInput();
        }

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');


        $getdate =  Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $attendance = Attendance::where(['class_id' => $request->Class, 'school_id' => $school->id, 'academic_session' => $academic, 'date' => $getdate])->get();

        // dd($attendance);

        foreach($request->student as $key => $value){

            foreach($attendance as $attend){
                if($attend->student_id == $value){
                    $updated = Attendance::where('id',$attend->id)->update(['attendance_type' => $request->attendance[$key]]);
                }
            }
        }

        return redirect()->back()->with('Success', 'Attendance Updated Successfully!');

    }

    public function studentAttendanceRecord($id = null, $month = null)
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
        if($month != null){
            $daysInMonth = Carbon::create(null, $month)->daysInMonth;
        }else{
            $daysInMonth = Carbon::now()->daysInMonth;
            $month = Carbon::now()->month;
        }
        $class = $id;


        if($class != null){
            $attendance = Student::with(['attendances' => function ($query) use ($month) {
                $query->whereMonth('date', $month);
            }])
            ->where('class_id', $class)
            ->where('school_id', $school->id)
            ->where('academic_session', $academic)
            ->where('status', '2')
            ->get();
        }else{

            if(Custom::getUser()->role_name == 'Staff'){
                if(Custom::getStaffRole() == 'Assistant Teacher'){
                    $allot_class = Custom::getTeacherClass();
                    $attendance = Student::with(['attendances' => function ($query) use ($month) {
                        $query->whereMonth('date', $month);
                    },'schoolClass'])
                    ->where('school_id', $school->id)
                    ->where('academic_session', $academic)
                    ->where('status', '2')
                    ->whereIn('class_id', $allot_class)
                    ->get();

                    $attendance = $attendance->sortBy(function ($student) {
                        return $student->schoolClass->classname;
                    });

                }else{
                    $attendance = Student::with(['attendances' => function ($query) use ($month) {
                        $query->whereMonth('date', $month);
                    }])
                    ->where('school_id', $school->id)
                    ->where('academic_session', $academic)
                    ->where('status', '2')
                    ->get();
                }
            }else{
                $attendance = Student::with(['attendances' => function ($query) use ($month) {
                    $query->whereMonth('date', $month);
                }])
                ->where('school_id', $school->id)
                ->where('academic_session', $academic)
                ->where('status', '2')
                ->get();
            }

        }
        // dd($sortedAttendance);

        return view('school.attendance.student-attendance-record', compact('finalarray', 'class', 'attendance','month','daysInMonth'));
    }
}
