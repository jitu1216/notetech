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
    public function scheme_list(){

    $school = Custom::getschool();
    $academic = Session::get('academic_session');
    $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
    return view('school.schoolmaintenance.item-list', compact('item'));

    }

    public function additem(){
        return view('school.schoolmaintenance.add-item');
    }

    public function saveitem(Request $request){
        // dd($request);
        $request->validate([
            'item' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new Item;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        
        $item->item_name= $request->item;
        $item->save();

        return redirect()->route('item_list')->with('Success','Class Added Successfully');

    }

    public function updateitem(Request $request){
      

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new Item;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        
        $item->item_name= $request->item;
        $item->save();

        return redirect()->route('item_list')->with('Success','Class Added Successfully');

    }

    public function removeitem($id){

        $record = Item::find($id);

        if($record){
            $record-> delete();
            return redirect()->back()->with('Success','Class delete Successfully');
        }
        else {
            return redirect()->back()->with('Success','Class Not Found');
        }
    }
}
