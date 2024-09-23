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
use Custom;
use Auth;
use Carbon\Carbon;


class SchemeHeaderController extends Controller
{
    public function scheme_list(){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->get();
        return view('school.exam-scheme.scheme-class-list', compact('scheme_header'));
    }

    public function addclass(){
        return view('school.exam-scheme.add-scheme-class');
    }
    
    public function saveclass(Request $request){
        // dd($request);
        $request->validate([
            'exam_header' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $scheme_header = new SchemeHeader;
        $scheme_header->academic_session = $academic;
        $scheme_header->school_id = $school->id;
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
        if($academic == null){
            $academic = Custom::academicSession();
            }
        dd($request);
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
}
