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
}
