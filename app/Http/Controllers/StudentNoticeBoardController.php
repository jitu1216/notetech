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
use App\Models\NoticeItem;
use App\Models\StudentNotice;
use App\Models\NoticeForAll;
use Session;
use App\Helper\Custom;
use Auth;
use Carbon\Carbon;

class StudentNoticeBoardController extends Controller
{
    public function notice_for_you()
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $id = Auth::guard('student')->User()->id;
        // dd($id);
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $subjectList = explode(",", $schoolclass->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data;
        }
       
        $compl_notice = StudentNotice::where(['school_id' => $school->id, 'academic_session' => $academic, 'item_status' => '1','student_id' => $id])->with('item')->get();
        // dd($compl_notice);
        // $compl_notice = StudentNotice::where(['school_id' => $school->id, 'academic_session' => $academic, 'item_status' => '1','student_id' => $id])->get();

        return view('studentDashboard.noticeboard.notice-for-you', compact('student', 'schoolclass', 'subject', 'compl_notice'));

    }

    public function notice_for_all($id)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
       
        $notice = NoticeForAll::find($id);

        return view('studentDashboard.noticeboard.notice-for-all', compact('notice'));

    }

    public function notice_for_all_list()
    {
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $notice = NoticeForAll::where(['school_id' => $school->id, 'academic_session' => $academic])->orderBy('updated_at', 'asc')->get();
        return view('studentDashboard.noticeboard.notice-for-all-list', compact('notice'));

    }
}
