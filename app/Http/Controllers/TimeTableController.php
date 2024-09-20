<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Helper\Custom;
use App\Models\Subject;
use App\Models\TimeTable;
use Session;
use Auth;

class TimeTableController extends Controller
{
    public function addTimeTable()
    {

        $finalarray = Custom::getAllClass();
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic, 'appointment_position' => 'Assistant Teacher'])->get();

        $subject = Subject::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();
        // dd($subject);
        $class = null;
        return view('school.time-table.add-time-table', compact('finalarray', 'class', 'staffList', 'subject'));
    }

    public function saveTimeTable(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');


        $request->validate([
            'teacher' => 'required'
        ]);

        $gettimetable = TimeTable::where(['school_id' => $school->id, 'academic_session'=> $academic, 'staff_id' => $request->teacher])->get();

        if($gettimetable->isNotEmpty()){
            return redirect()->route('edit-time-table', $request->teacher);
        }

        // dd($request);
        if (!empty($request->subject) || !empty($request->class) || !empty($request->time)) {
            for ($i = 1; $i <= $request->total; $i++) {
                if ($i != 5) {
                    if (!empty($request->subject)) {
                        if (!array_key_exists($i, $request->subject)) {
                            // return redirect()->back()->withInput();
                            $errors['subject.' . $i] = 'Subject is required' . ($i + 1);
                        }
                    }else{
                        $errors['subject.' . $i] = 'Subject is required' . ($i + 1);
                    }
                    if (!empty($request->class)) {
                        if (!array_key_exists($i, $request->class)) {
                            // return redirect()->back()->withInput();
                            $errors['class.' . $i] = 'Class is required' . ($i + 1);
                        }
                    }else{
                        $errors['class.' . $i] = 'Subject is required' . ($i + 1);
                    }
                    if (!$request->time[$i]) {
                        $errors['time.' . $i] = 'Time is required' . ($i + 1);
                    }

                }
            }
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors)->withInput();
            }
        } else {
            return redirect()->back()->withInput();
        }

        // dd($request);
        $classess = [];
        $subject = [];

        for ($i = 1; $i <= $request->total; $i++) {
            if ($i != 5) {
                $time = new TimeTable;
                $time->staff_id = $request->teacher;
                $time->academic_session = $academic;
                $time->school_id = $school->id;
                $time->time = $request->time[$i];
                foreach ($request->class[$i] as $value) {
                    $classess = implode(",", $request->class[$i]);
                    $subject = implode(",", $request->subject[$i]);
                }
                $time->class_id = $classess;
                $time->subjects = $subject;
                $time->save();
            }
        }
        ;
        return redirect()->route('view-time-table', $request->teacher)->with('Success', 'Time Table Added Successfully!');
    }

    public function editTimeTable($id = null)
    {
        $finalarray = Custom::getAllClass();
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic, 'appointment_position' => 'Assistant Teacher'])->get();

        $subject = Subject::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();
        if ($id) {
            $timetable = TimeTable::where(['school_id' => $school->id, 'academic_session' => $academic, 'staff_id' => $id])->get();
        } else {
            $timetable = null;
            $timetable = collect($timetable);
        }
        // dd($timetable);
        $check = false;
        $checkteacher = false;


        return view('school.time-table.edit-time-table', compact('finalarray', 'staffList', 'subject', 'id', 'timetable','check','checkteacher'));
    }

    public function updateTimeTable(Request $request)
    {

        $request->validate([
            'teacher' => 'required'
        ]);

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        // dd($request);
        if (!empty($request->subject) || !empty($request->class) || !empty($request->time)) {
            for ($i = 1; $i <= $request->total; $i++) {
                if ($i != 5) {
                    if (!empty($request->subject)) {
                        if (!array_key_exists($i, $request->subject)) {
                            // return redirect()->back()->withInput();
                            $errors['subject.' . $i] = 'Subject is required' . ($i + 1);
                        }
                    }else{
                        $errors['subject.' . $i] = 'Subject is required' . ($i + 1);
                    }
                    if (!empty($request->class)) {
                        if (!array_key_exists($i, $request->class)) {
                            // return redirect()->back()->withInput();
                            $errors['class.' . $i] = 'Class is required' . ($i + 1);
                        }
                    }else{
                        $errors['class.' . $i] = 'Subject is required' . ($i + 1);
                    }
                    if (!$request->time[$i]) {
                        $errors['time.' . $i] = 'Time is required' . ($i + 1);
                    }

                }
            }
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors)->withInput();
            }
        } else {
            return redirect()->back()->withInput();
        }

        $classess = [];
        $subject = [];

        // dd($request);


        for ($i = 1; $i <= 9; $i++) {

            if ($i != 5) {
                $time = TimeTable::find($request->row[$i]);
                $time->staff_id = $request->teacher;
                $time->academic_session = $academic;
                $time->school_id = $school->id;
                $time->time = $request->time[$i];
                foreach ($request->class[$i] as $value) {
                    $classess = implode(",", $request->class[$i]);
                    $subject = implode(",", $request->subject[$i]);
                }
                $time->class_id = $classess;
                $time->subjects = $subject;
                // dd($time);
                $time->update();
            }
        }
        ;
        return redirect()->back()->with('Success', 'Time Table Updated Successfully!');
    }



    public function viewTimeTable($id = null)
    {
        $user = Auth::User();
        $finalarray = Custom::getAllClass();
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic, 'appointment_position' => 'Assistant Teacher'])->get();

        $subject = Subject::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();

        $user = Auth::User();
        $checkteacher = false;
        // dd($user);
        if ($user->role_name == 'Staff') {
            if (Custom::getStaffRole() == 'Assistant Teacher') {
                $staff = Staff::where(['staff_name' => $user->name, 'email' => $user->email])->first();
                $timetable = TimeTable::where(['school_id' => $school->id, 'academic_session' => $academic, 'staff_id' => $staff->id])->get();
                $id = $staff->id;
                $checkteacher = true;

            } else {
                if ($id) {
                    $timetable = TimeTable::where(['school_id' => $school->id, 'academic_session' => $academic, 'staff_id' => $id])->get();
                } else {
                    $timetable = null;
                    $timetable = collect($timetable);
                }
                $checkteacher = false;
            }
        } else {
            if ($id) {
                $timetable = TimeTable::where(['school_id' => $school->id, 'academic_session' => $academic, 'staff_id' => $id])->get();
            } else {
                $timetable = null;
                $timetable = collect($timetable);
            }
            $checkteacher = false;
        }
        $check = true;

        return view('school.time-table.edit-time-table', compact('finalarray', 'staffList', 'subject', 'id', 'timetable','check','checkteacher'));
    }
}
