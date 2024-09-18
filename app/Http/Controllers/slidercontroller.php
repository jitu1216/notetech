<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FeesController;
use Illuminate\Support\Facades\File;
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
use Session;
use Custom;
use Auth;

class slidercontroller extends Controller
{
    public function slider(){
            $slider = slider::all();
            return view('school.slider.slider', compact('slider'));
    }
    public function create(){
        return view('school.slider.addslider');
}

    public function saveslider(Request $request){

        // dd($request);
        $this->validate($request,[
            'upload' => 'required'
         ]);

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        // dd($request);
        $slider = new slider;
        $slider->academic_session = $academic;
        $slider->school_id = $school->id;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        if($request->hasfile('upload'))
        {
            $file = $request->file('upload');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('slider/', $filename);
            $slider->upload = $filename;
        }
        $slider->status = $request->status == true ? '1':'0';
        $slider->save();
        return redirect()->route('slider')->with('status','Slider Added Successfully');
    }

    public function edit($id){
        $slider = slider::find($id);
        return view('school.slider.editslider', compact('slider'));
    }

    public function updateslider(Request $request, $id){

    
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        // dd($request);
        $slider = slider::find($id);
        $slider->academic_session = $academic;
        $slider->school_id = $school->id;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        if($request->hasfile('upload'))
        {
            $destination = 'slider/'. $slider->upload;
            if(File::exists($destination)){
                File::delete($destination);
            };
            $file = $request->file('upload');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('slider/', $filename);
            $slider->upload = $filename;
        }
        $slider->status = $request->input('status') == true ? '1':'0';
        $slider->save();
        return redirect()->route('slider')->with('status','Slider Update Successfully');
    }
    public function removeslider($id){
        $record = slider::find($id);

        if ($record) {
            $destination = 'slider/'. $record->upload;
            if(File::exists($destination)){
                File::delete($destination);
            };
            $record->delete();
            return redirect()->back()->with('Success', 'Slider Deleted Successfully!');
        } else {
            return redirect()->back()->with('Error', 'Slider Not Found!');
        }
    }

}
