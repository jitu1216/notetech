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


class SchemeHeaderController extends Controller
{
    public function scheme_list(){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
        return view('school.exam-scheme.scheme-class-list', compact('scheme_header'));
    }

    public function addclass(){
        return view('school.exam-scheme.add-scheme-class');
    }

    public function saveSchemeclass(Request $request){
        // dd($request);
        $request->validate([
            'exam_header' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $scheme_header = new SchemeHeader;
        $scheme_header->academic_session = $academic;
        $scheme_header->school_id = $school->id;
        
        $scheme_header->exam_header= $request->exam_header;
        $scheme_header->save();

        return redirect()->route('scheme_list')->with('Success','Class Added Successfully');

    }

    public function editclass($id){

        $item = SchemeHeader::find($id);

        return view('school.exam-scheme.edit-scheme-class', compact('item'));
    }

    public function updateclass(Request $request){
        // dd($request);
        $request->validate([
            'exam_header' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $scheme_header = SchemeHeader::find($request->id);

        $scheme_header->academic_session = $academic;
        $scheme_header->school_id = $school->id;
        $scheme_header->exam_header= $request->exam_header;
        $scheme_header->save();

        return redirect()->route('scheme_list')->with('Success','Class Edit Successfully');

    }

    public function removeclass($id){

        $record = SchemeHeader::find($id);

        if($record){
            $record-> delete();
            return redirect()->back()->with('Success','Class delete Successfully');
        }
        else {
            return redirect()->back()->with('Success','Class Not Found');
        }
    }

    public function examTime(){

        $school = Custom::getschool();
        $data = School::find($school->id);
        return view('school.exam-scheme.exam_time',compact('data'));
    }

    public function saveExamTime(Request $request){

        $request->validate([
            'test_exam_time' => 'required',
            'monthly_exam_time' => 'required',
            'quaterly_exam_time' => 'required',
            'half_exam_time' => 'required',
            'annual_exam_time' => 'required'
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $school = School::find($school->id);
        $school->test_exam_time = $request->test_exam_time;
        $school->monthly_scheme_time = $request->monthly_exam_time;
        $school->quarter_scheme_time = $request->quaterly_exam_time;
        $school->half_scheme_time = $request->half_exam_time;
        $school->annual_scheme_time = $request->annual_exam_time;
        $school->update();

        return redirect()->back()->with('Success','Time Updated Successfully');

    }
}
