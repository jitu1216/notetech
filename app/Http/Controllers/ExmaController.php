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
use Session;
use Custom;
use Auth;
use Carbon\Carbon;
class ExmaController extends Controller
{
    public function exam_list(){
        $scheme = ExamScheme::all();
        return view('school.exam-scheme.exam_list', compact('scheme'));
    }

    public function addscheme()
    {
        return view('school.exam-scheme.add-scheme');
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
        $exam_scheme->exam_date = date('Y-m-d', strtotime($request->date));
        $exam_scheme->save();

        return redirect()->route('exam_list')->with('Success','Scheme Added successfull ');
    }

    public function editscheme($id){
        $item = ExamScheme::find($id);
        return view('school.exam-scheme.edit-scheme', compact('item'));
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
        $exam_scheme->exam_date = date('Y-m-d', strtotime($request->date));
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


    public function viewscheme($text){

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->get();
        
        dd($scheme);
    }
}
