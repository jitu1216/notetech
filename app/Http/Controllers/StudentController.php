<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FeesController;
use DB;
use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\StateCities;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\School;
use App\Models\Subject;
use App\Models\StudentFees;
use App\Models\AcademicSession;
use Session;
use Custom;
use Auth;

class StudentController extends Controller
{
    // index page student list
    public function pendingList()
    {

        $school = Custom::getSchool();

        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();
        // dd($schoolclass);
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
        // dd($newroman);

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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> 1 ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();
        // dd($studentList);
        $mark = 1;
        return view('school.student.student-list', compact('studentList', 'mark', 'finalarray'));
    }

    public function studentList($id)
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> $id ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();

        if($id == 2) {
            $mark = 2;
        }
        if($id == 1) {
            $mark = 1;
        }
        if($id == 3) {
            $mark = 3;
        }
        if($id == 4){
            $mark = 4;
        }

        // dd($studentList);
        return view('school.student.student-list', compact('studentList', 'mark', 'finalarray'));
    }

    public function searchStudent(Request $request)
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
        // dd($newroman);

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
            })->where('class_id', $request->Class)->where('students.status', $request->searchId)->get();

        }else{
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->get();
        }

        if($request->searchId == 2) {
            $mark = 2;
        }
        if($request->searchId == 1) {
            $mark = 1;
        }
        if($request->searchId == 3) {
            $mark = 3;
        }
        if($request->searchId == 4){
            $mark = 4;
        }

        $studentsearch = $request->studentsearch;
        $class =  $request->Class;
        return view('school.student.student-list', compact('studentList', 'mark', 'finalarray','studentsearch','class'));


    }

    // index page student grid
    public function studentGrid()
    {
        $studentList = Student::all();
        return view('student.student-grid', compact('studentList'));
    }

    // student add page
    public function studentAdd()
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($academic);
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();
        $data = StateCities::all()->toarray();
        $state =  [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }
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
        // dd($newroman);
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

        // dd($finalarray);


        return view('school.student.add-student', compact('state', 'schoolclass', 'finalarray'));
    }

    /** student save record */
    public function studentSave(Request $request)
    {



        $request->validate([
            'student_name'    => 'required|string',
            'father_name'     => 'required|string',
            'mother_name'     => 'required|string',
            'class'          => 'required',
            'gender'        => 'required',
            'date_of_birth' => 'required|string',
            'religion'          => 'required',
            'category'   => 'required',
            'religion'      => 'required|string',
            'caste'         => 'required',
            'locality_type'   => 'required',
            'post_type'       => 'required',
            'village'         => 'required|string',
            'town'       => 'required|string',
            'state'         => 'required',
            'city'         => 'required',
            'pincode'         => 'required',
            'mobile'         => 'required|max:10|min:10',
            'email'         => 'required|email',
            'nationality'  => 'required',
            'transport'    => 'required',
            'occupation'  => 'required',
            'aadhar'      => 'required',
            'institute'  => 'required',
            'password'  => 'required',
            'upload'        => 'required|image',
        ]);



        $upload_file = rand() . '.' . $request->upload->extension();
        $request->upload->move(public_path('student-photos'), $upload_file);


        $schoolclass = SchoolClass::where('id', $request->class)->first();
        $subjectList = explode(",", $schoolclass->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data->id;
        }
        foreach ($subject as $key => $data) {
            $x = 'subject' . $key;
            if (isset($request[$x])) {
                $newSubarray[] =  $request[$x];
            }
        }


        $subjectIds = implode(",", $newSubarray);

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $code = Student::where(['school_id'=>$school->id,'academic_session'=>$academic])->orderBy('id','desc')->limit(1)->first();

        if(empty($code)){
            $code = 1;
            $usercode = substr($school->Name,0,3).sprintf("%06d", $code);
        }else{
            $usercode = substr($school->Name,0,3).sprintf("%06d", $code->id + 1);
        }



        if (!empty($request->upload)) {
            $student = new Student;
            $student->application_no   = $usercode;
            $student->application_date   = date("d-m-Y");
            $student->student_name    = $request->student_name;
            $student->father_name       = $request->father_name;
            $student->mother_name   = $request->mother_name;
            $student->class_id         = $request->class;
            $student->gender          = $request->gender;
            $student->dob             = $request->date_of_birth;
            $student->religion        = $request->religion;
            $student->category        = $request->category;
            $student->caste           = $request->caste;
            $student->locality_type     = $request->locality_type;
            $student->post_type         = $request->post_type;
            $student->village         = $request->village;
            $student->town            = $request->town;
            $student->district          = $request->city;
            $student->state             = $request->state;
            $student->pincode        = $request->pincode;
            $student->mobile        = $request->mobile;
            $student->email           = $request->email;
            $student->nationality         = $request->nationality;
            $student->transport            = $request->transport;
            $student->father_occupation            = $request->occupation;
            $student->aadhar_no          = $request->aadhar;
            $student->last_institute             = $request->institute;
            $student->subject_id        = $subjectIds;
            $student->academic_session        = Session::get('academic_session');
            $student->school_id           = Custom::getSchool()->id;
            $student->status        =  1;
            $student->image              = $upload_file;
            $student->password         = Hash::make($request->password);
            $student->show_pass         = $request->password;
            $student->save();
        }

        // return view('school.student.student-print',compact('student','schoolclass'));
        return redirect()->route('printstudent', $student->id)->with('Success', 'Student Created Successfully!');

        // } catch(\Exception $e) {
        //     DB::rollback();
        //     Toastr::error('fail, Add new student  :)','Error');
        //     return redirect()->back();
        // }
    }

    /** view for edit student */
    public function studentEdit($id)
    {
        $studentEdit = Student::where('id', $id)->first();
        return view('student.edit-student', compact('studentEdit'));
    }

    /** update record */
    public function studentUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->upload)) {
                unlink(storage_path('app/public/student-photos/' . $request->image_hidden));
                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(storage_path('app/public/student-photos/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }

            $updateRecord = [
                'upload' => $upload_file,
            ];
            Student::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update student  :)', 'Error');
            return redirect()->back();
        }
    }

    /** student delete */
    public function studentDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Student::destroy($request->id);
                unlink(storage_path('app/public/student-photos/' . $request->avatar));
                DB::commit();
                Toastr::success('Student deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Student deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** student profile page */
    public function studentProfile($id)
    {
        $studentProfile = Student::where('id', $id)->first();
        return view('student.student-profile', compact('studentProfile'));
    }

    public function getSubject(Request $request)
    {

        $subject = array();
        $schoolclass = SchoolClass::where('id', $request->schoolclass)->first();
        $subjectList = explode(",", $schoolclass->subject_id);
        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data;
        }
        return $subject;
    }

    public function studentPrint($id)
    {
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $subjectList = explode(",", $schoolclass->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data;
        }
        return view('school.student.student-print', compact('student', 'schoolclass', 'subject'));
    }

    public function updateStudent($id)
    {

        $student = Student::where('id', $id)->first();

        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $subjectList = explode(",", $student->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data->subject_name;
        }

        $data = StateCities::all()->toarray();
        $state =  [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
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
        // dd($newroman);

        $finalarray = array();


        foreach ($newroman as $value) {
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }
        if ($student->status == 1) {
            return view('school.student.update', compact('student', 'schoolclass', 'subject', 'state', 'finalarray'));
        } else {
            return view('school.student.student-update', compact('student', 'schoolclass', 'subject', 'state', 'finalarray'));
        }
    }

    public function updateStudentrecord(Request $request)
    {

        if (isset($request->rejectbtn)) {

             $request->validate([
                'reject'    => 'required',
            ]);

            if (isset($request->reject)) {
                $student = Student::where(['id' => $request->id])->first();
                $student->reject_reason   = $request->reject;
                $student->status        =  3;
                $student->update();


                $school = Custom::getSchool();
                $academic = Session::get('academic_session');

                $data = StudentFees::where(['school_id'=> $school->id, 'academic_session'=> $academic, 'student_id'=> $student->id])->get();

                if(!empty($data)){

                    foreach($data as $feesdata){
                        $studentfees = StudentFees::where('id', $feesdata->id)->first();
                        $studentfees->status = 2;
                        $studentfees->update();
                    }
                }

                return redirect()->route('studentlist', 2)->with('Success', 'Student Created Successfully!');
            }
        } else {
            $request->validate([
                'student_name'    => 'required|string',
                'father_name'     => 'required|string',
                'mother_name'     => 'required|string',
                'class'          => 'required',
                'gender'        => 'required',
                'date_of_birth' => 'required|string',
                'religion'          => 'required',
                'category'   => 'required',
                'religion'      => 'required|string',
                'caste'         => 'required',
                'locality_type'   => 'required',
                'post_type'       => 'required',
                'village'         => 'required|string',
                'town'       => 'required|string',
                'state'         => 'required',
                'city'         => 'required',
                'pincode'         => 'required',
                'mobile'         => 'required|max:10|min:10',
                'email'         => 'required|email',
                'nationality'  => 'required',
                'transport'    => 'required',
                'occupation'  => 'required',
                'aadhar'      => 'required',
                'institute'  => 'required',
                'admission_date' => 'required',
                'sr_no' => 'required',
                'roll_no' => 'required',
                'fees_account' => 'required',
                'password' => 'required',
            ]);

            $student = Student::where(['id' => $request->id])->first();

            $academic = Session::get('academic_session');
            $student_id = substr($academic, -5);
            $student_id = str_replace('-','',$student_id).$request->sr_no;

            if (!empty($request->upload)) {

                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(public_path('student-photos'), $upload_file);
            } else {
                $upload_file = $student->image;
            }

            $schoolclass = SchoolClass::where('id', $request->class)->first();
            $subjectList = explode(",", $schoolclass->subject_id);

            foreach ($subjectList as $value) {
                $data = Subject::where('id', $value)->first();
                $subject[] = $data->id;
            }
            foreach ($subject as $key => $data) {
                $x = 'subject' . $key;
                if (isset($request[$x])) {
                    $newSubarray[] =  $request[$x];
                }
            }
            $subjectIds = implode(",", $newSubarray);

            $student->admission_date   = $request->admission_date;
            $student->sr_no   = $request->sr_no;
            $student->student_id   = $student_id;
            $student->roll_no   = $request->roll_no;
            $student->fee_account   = $request->fees_account;
            $student->student_name    = $request->student_name;
            $student->father_name       = $request->father_name;
            $student->mother_name   = $request->mother_name;
            $student->class_id         = $request->class;
            $student->gender          = $request->gender;
            $student->dob             = $request->date_of_birth;
            $student->religion        = $request->religion;
            $student->category        = $request->category;
            $student->caste           = $request->caste;
            $student->locality_type           = $request->locality_type;
            $student->post_type           = $request->post_type;
            $student->village         = $request->village;
            $student->town            = $request->town;
            $student->district          = $request->city;
            $student->state             = $request->state;
            $student->pincode        = $request->pincode;
            $student->mobile        = $request->mobile;
            $student->email           = $request->email;
            $student->nationality         = $request->nationality;
            $student->transport            = $request->transport;
            $student->father_occupation            = $request->occupation;
            $student->aadhar_no          = $request->aadhar;
            $student->last_institute             = $request->institute;
            $student->subject_id        = $subjectIds;
            $student->academic_session        = Session::get('academic_session');
            $student->school_id           = Custom::getSchool()->id;
            $student->status        =  2;
            $student->reject_reason   = null;
            $student->image         = $upload_file;
            $student->password         = Hash::make($request->password);
            $student->show_pass         = $request->password;
            $student->update();

            $result = (new FeesController)->updateStudentFees($request->class);

            $school = Custom::getSchool();
            $academic = Session::get('academic_session');

            $data = StudentFees::where(['school_id'=> $school->id, 'academic_session'=> $academic, 'student_id'=> $student->id])->get();

            if(!empty($data)){

                foreach($data as $feesdata){
                    $studentfees = StudentFees::where('id', $feesdata->id)->first();
                    $studentfees->status = 1;
                    $studentfees->update();
                }
            }

            return redirect()->route('updateStudent', $student->id)->with('Success', 'Student Created Successfully!');
        }
    }


    public function studentPrintmain($id)
    {
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $subjectList = explode(",", $schoolclass->subject_id);

        foreach ($subjectList as $value) {
            $data = Subject::where('id', $value)->first();
            $subject[] = $data;
        }
        return view('school.student.main-student-print', compact('student', 'schoolclass', 'subject'));
    }


    public function deleteStudent(Request $request)
    {
        // dd($request);
        $student = Student::where('id', $request->id)->first();
        $student->status = 4;
        $student->update();


        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $data = StudentFees::where(['school_id'=> $school->id, 'academic_session'=> $academic, 'student_id'=> $student->id])->get();

        if(!empty($data)){

            foreach($data as $feesdata){
                $studentfees = StudentFees::where('id', $feesdata->id)->first();
                $studentfees->status = 2;
                $studentfees->update();
            }
        }


        return redirect()->back()->with('Success', 'Student Deleted Successfully!');


    }

    public function recoverStudent(Request $request)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $student = Student::where('id', $request->id)->first();

        $data = StudentFees::where(['school_id'=> $school->id, 'academic_session'=> $academic, 'student_id'=> $student->id])->get();

        if(!empty($student)){
            if(!empty($student->sr_no)){
                $student->status = 2;

                if(!empty($data)){

                    foreach($data as $feesdata){
                        $studentfees = StudentFees::where('id', $feesdata->id)->first();
                        $studentfees->status = 1;
                        $studentfees->update();
                    }
                }

            }elseif(!empty($student->reject_reason))
            {
                $student->status = 3;
            }else{
                $student->status = 1;
            }
        }
        $student->update();
        return redirect()->back()->with('Success', 'Student Recovered Successfully!');
    }


    public function allStudentList($id)
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

        if($id == 5){
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> '2' ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();
        }else{
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status'=> $id ,'students.school_id'=> $school->id, 'students.academic_session' => $academic])->get();
        }




        if($id == 2) {
            $mark = 2;
        }
        if($id == 1) {
            $mark = 1;
        }
        if($id == 3) {
            $mark = 3;
        }
        if($id == 4){
            $mark = 4;
        }
        if($id == 5){
            $mark = 5;
        }

        // dd($studentList);
        return view('school.student.student-list', compact('studentList', 'mark', 'finalarray'));
    }
}
