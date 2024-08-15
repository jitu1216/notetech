<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FeesController;
use App\Models\FeesType;
use App\Models\SchoolClass;
use App\Models\FeesAmount;
use App\Models\Student;
use App\Models\StudentFees;
use App\Models\Subject;
use App\Models\FeesTransaction;
use App\Models\Staff;
use App\Models\AcademicSession;
use Session;
use Custom;
use Auth;
use Illuminate\Http\Request;

class PromoteController extends Controller
{

    public function promoteList($id)
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => $id, 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();

        if ($id == 2) {
            $mark = 2;
        }
        if ($id == 1) {
            $mark = 1;
        }
        if ($id == 3) {
            $mark = 3;
        }
        if ($id == 4) {
            $mark = 4;
        }

        $session_data = AcademicSession::all();

        // dd($session_data);
        return view('school.promote.student-list', compact('studentList', 'mark', 'finalarray','session_data'));
    }


    public function promoteSearchStudent(Request $request)
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


        if (!empty($request->Class)) {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('school_classes.school_id', $school->id)->where('school_classes.academic_session', $academic)->where('students.status', $request->searchId)->get();
        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->where('school_classes.school_id', $school->id)->where('school_classes.academic_session', $academic)->get();
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

        $studentsearch = $request->studentsearch;
        $class =  $request->Class;

        $session_data = AcademicSession::all();
        // dd($finalarray);
        return view('school.promote.student-list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class','session_data'));
    }

    public function promoteStudent(Request $request){
        $student = Student::where(['id' => $request->id])->first();
        // dd($student);
        $academic = $request->session;
        $student_id = substr($academic, -5);
        $student_id = str_replace('-','',$student_id).$student->sr_no;
        $school = Custom::getSchool();

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0','classname' => $request->class])->first();
        if(empty($schoolclass)){
            return redirect()->back()->with('Error', 'Class not Available in Promoted Session!');
        }

        $newstudent = new Student;
        $newstudent->application_no   = $student->application_no;
        $newstudent->application_date   = $student->application_date;
        $newstudent->admission_date   = $student->admission_date;
        $newstudent->sr_no   = $student->sr_no;
        $newstudent->student_id   = $student_id;
        $newstudent->roll_no   = $request->roll_no;
        $newstudent->fee_account   = $request->fees_account;
        $newstudent->student_name    = $student->student_name;
        $newstudent->father_name       = $student->father_name;
        $newstudent->mother_name   = $student->mother_name;
        $newstudent->class_id         = $schoolclass->id;
        $newstudent->gender          = $student->gender;
        $newstudent->dob             = $student->dob;
        $newstudent->religion        = $student->religion;
        $newstudent->category        = $student->category;
        $newstudent->caste           = $student->caste;
        $newstudent->locality_type           = $student->locality_type;
        $newstudent->post_type           = $student->post_type;
        $newstudent->village         = $student->village;
        $newstudent->town            = $student->town;
        $newstudent->district          = $student->district;
        $newstudent->state             = $student->state;
        $newstudent->pincode        = $student->pincode;
        $newstudent->mobile        = $student->mobile;
        $newstudent->email           = $student->email;
        $newstudent->nationality         = $student->nationality;
        $newstudent->transport            = $student->transport;
        $newstudent->father_occupation            = $student->father_occupation;
        $newstudent->aadhar_no          = $student->aadhar_no;
        $newstudent->last_institute             = $student->last_institute;
        $newstudent->subject_id        =         $student->subject_id;
        $newstudent->academic_session        = $request->session;
        $newstudent->school_id           = Custom::getSchool()->id;
        $newstudent->status        =  2;
        $newstudent->reject_reason   = null;
        $newstudent->promoted   = 0;
        $newstudent->image         = $student->image;
        // dd($newstudent);
        $newstudent->save();

        $student->promoted = 1;
        $student->update();

        $class_id = $schoolclass->id;

        $FeesAmount = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $class_id])->get()->toArray();
        $allfees = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'global' => 1])->get()->toArray();

        $feestype = array_merge($FeesAmount, $allfees);

        $studentlist = Student::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 2, 'class_id' => $class_id])->get();

        foreach ($studentlist as $student) {

            foreach ($feestype as $fees) {
                if (isset($fees['global'])) {
                    $studentFees = StudentFees::where(['school_id' => $school->id, 'academic_session' => $academic,'fees_type_id' => $fees['id'], 'student_id'=>$student->id])->first();

                    if (!empty($studentFees)) {

                        $studentFees->school_id = $school->id;
                        $studentFees->academic_session = $academic;
                        $studentFees->fees_type_id = $fees['id'];
                        $studentFees->student_id = $student->id;
                        $studentFees->class_id = $class_id;
                        $studentFees->status =  1;
                        $studentFees->update();

                    } else {

                        $data = new StudentFees;
                        $data->school_id = $school->id;
                        $data->academic_session = $academic;
                        $data->fees_type_id = $fees['id'];
                        $data->student_id = $student->id;
                        $data->class_id = $class_id;
                        $data->fees_amount = 0;
                        $data->total_installment =  0;
                        $data->status =  1;
                        $data->save();
                    }
                } else {
                    $studentFees = StudentFees::where(['school_id' => $school->id, 'academic_session' => $academic,'fees_type_id' => $fees['fees_type_id'],'student_id'=>$student->id])->first();


                    if (!empty($studentFees)) {

                        $studentFees->school_id = $school->id;
                        $studentFees->academic_session = $academic;
                        $studentFees->fees_type_id = $fees['fees_type_id'];
                        $studentFees->student_id = $student->id;
                        $studentFees->class_id = $class_id;
                        $studentFees->fees_amount = $fees['amount'];
                        $studentFees->total_installment =  $fees['installment'];
                        $studentFees->status =  1;
                        $studentFees->update();

                    } else {

                        $data = new StudentFees;
                        $data->school_id = $school->id;
                        $data->academic_session = $academic;
                        $data->fees_type_id = $fees['fees_type_id'];
                        $data->student_id = $student->id;
                        $data->class_id = $class_id;
                        $data->fees_amount = $fees['amount'];
                        $data->fees_paid =  0;
                        $data->total_installment =  $fees['installment'];
                        $data->paid_installment =  0;
                        $data->status =  1;
                        $data->save();
                    }
                }
            }
        }

        return redirect()->back()->with('Success', 'Student Promoted Successfully!');
    }

}
