<?php

namespace App\Http\Controllers;

use App\Models\FeesType;
use App\Models\SchoolClass;
use App\Models\FeesAmount;
use App\Models\Student;
use App\Models\StudentFees;
use App\Models\Subject;
use App\Models\FeesTransaction;
use App\Models\Staff;
use Session;
use App\Helper\Custom;
use Auth;

use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function feesTypeList()
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $data = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();
        return view('school.fees.feestypelist', compact('data'));
    }

    public function addfeesType()
    {

        $check = 0;
        return view('school.fees.addfesstype', compact('check'));
    }
    public function SavefeesType(Request $request)
    {

        $request->validate([
            'feesType' => 'required||string',
        ]);

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        // dd($request);
        if ($request->check == 0) {
            $data = new FeesType;
            $data->school_id = $school->id;
            $data->academic_session = $academic;
            $data->fees_name = $request->feesType;
            if (isset($request->global)) {
                $data->global = $request->global;
            } else {
                $data->global = 0;
            }
            $data->save();
            return redirect()->back()->with('Success', 'Fees Type Created Successfully!');
        } else {
            $data = FeesType::where('id', $request->id)->first();
            $data->fees_name = $request->feesType;
            if (isset($request->global)) {
                $data->global = $request->global;
            } else {
                $data->global = 0;
            }
            $data->update();
            return redirect()->back()->with('Success', 'Fees Type Updated Successfully!');
        }
    }

    public function viewfeestype($id)
    {
        $feestype = FeesType::where('id', $id)->first();
        $check = 1;
        return view('school.fees.addfesstype', compact('check', 'feestype'));
    }

    public function feesSetting($classIds = null)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        if ($classIds == null) {
            $classid = null;
        } else {
            $classid = $classIds;
        }

        $feestype = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'global' => 0])->get();
        return view('school.fees.fees-setting.addfees', compact('feestype', 'finalarray', 'classid'));
    }

    public function storeFees(Request $request)
    {

        $request->validate([
            'Class' => 'required||string',
        ]);


        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $feestype = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'global' => 0])->get();
        $feesClass = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $request->Class])->get();
        // dd($request);



        foreach ($feestype as $fees) {
            $feesId = 'feesId_' . $fees->id;
            $feesName = 'feesName_' . $fees->id;
            $feesammount = 'feesamount_' . $fees->id;
            $feesinstall = 'feesInstall_' . $fees->id;

            $feesPresent = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $request->Class, 'fees_type_id' => $fees->id])->first();

            if (!empty($feesPresent)) {
                $check = 0;
            } else {
                $data = new FeesAmount;
                $data->school_id = $school->id;
                $data->academic_session = $academic;
                $data->fees_type_id = $request[$feesId];
                $data->fees_name = $request[$feesName];
                $data->class = $request->Class;
                $data->amount = $request[$feesammount];
                $data->installment = $request[$feesinstall];
                $data->save();
                $check = 1;
            }
        }

        $studentfees = $this->updateStudentFees($request->Class);

        if ($check == 1) {
            return redirect()->back()->with('Success', 'Fees Added Successfully Exist!');
        } else {
            return redirect()->route('viewfeessetting', $request->Class)->with('Success', 'This Class Fees Already Exist!');
        }
    }

    public function viewFeesSetting($classId = null)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        if ($classId == null) {
            $classId = $finalarray[0]['id'];
            $feestype = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $classId])->get();
        } else {
            $feestype = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $classId])->get();
        }
        return view('school.fees.fees-setting.updatefees', compact('feestype', 'finalarray', 'classId'));
    }


    public function updateFees(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $feestype = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'global' => 0])->get();
        $feesClass = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $request->Class])->get();

        foreach ($feesClass as $fees) {

            $feesId = 'feesId_' . $fees->id;
            $feesName = 'feesName_' . $fees->id;
            $feesammount = 'feesamount_' . $fees->id;
            $feesinstall = 'feesInstall_' . $fees->id;

            $data = FeesAmount::where('id', $fees->id)->first();
            $data->fees_name = $request[$feesName];
            $data->amount = $request[$feesammount];
            $data->installment = $request[$feesinstall];
            $data->update();
        }


        $studentfees = $this->updateStudentFees($request->Class);

        return redirect()->back()->with('Success', 'Fees Updated Successfully!');
    }


    public function feeEditList($id)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        // dd($finalarray);
        return view('school.fees.fee-edit.student-list', compact('studentList', 'mark', 'finalarray'));
    }


    public function feeSearchStudent(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }


        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
        $class = $request->Class;
        return view('school.fees.fee-edit.student-list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));
    }

    public function viewFeesEdit($id)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $studentEdit = Student::where('id', $id)->first();
        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];
        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        $classId = $studentEdit->class_id;
        $studentfees = $this->updateStudentFees($classId);

        $feestype = StudentFees::join('fees_types', 'fees_types.id', '=', 'student_fees.fees_type_id')->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.status' => 1, 'student_fees.class_id' => $classId, 'student_fees.student_id' => $id])->get();


        return view('school.fees.fee-edit.updatefees', compact('feestype', 'finalarray', 'classId', 'studentEdit'));
    }


    static function updateStudentFees($class_id)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $FeesAmount = FeesAmount::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class' => $class_id])->get()->toArray();
        $allfees = FeesType::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'global' => 1])->get()->toArray();

        $feestype = array_merge($FeesAmount, $allfees);

        $studentlist = Student::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 2, 'class_id' => $class_id])->get();

        foreach ($studentlist as $student) {

            foreach ($feestype as $fees) {
                if (isset($fees['global'])) {
                    $studentFees = StudentFees::where(['school_id' => $school->id, 'academic_session' => $academic, 'fees_type_id' => $fees['id'], 'student_id' => $student->id])->first();

                    if (!empty($studentFees)) {

                        $studentFees->school_id = $school->id;
                        $studentFees->academic_session = $academic;
                        $studentFees->fees_type_id = $fees['id'];
                        $studentFees->student_id = $student->id;
                        $studentFees->class_id = $class_id;
                        $studentFees->status = 1;
                        $studentFees->update();

                    } else {

                        $data = new StudentFees;
                        $data->school_id = $school->id;
                        $data->academic_session = $academic;
                        $data->fees_type_id = $fees['id'];
                        $data->student_id = $student->id;
                        $data->class_id = $class_id;
                        $data->fees_amount = 0;
                        $data->total_installment = 0;
                        $data->status = 1;
                        $data->save();
                    }
                } else {
                    $studentFees = StudentFees::where(['school_id' => $school->id, 'academic_session' => $academic, 'fees_type_id' => $fees['fees_type_id'], 'student_id' => $student->id])->first();


                    if (!empty($studentFees)) {

                        $studentFees->school_id = $school->id;
                        $studentFees->academic_session = $academic;
                        $studentFees->fees_type_id = $fees['fees_type_id'];
                        $studentFees->student_id = $student->id;
                        $studentFees->class_id = $class_id;
                        $studentFees->fees_amount = $fees['amount'];
                        $studentFees->total_installment = $fees['installment'];
                        $studentFees->status = 1;
                        $studentFees->update();

                    } else {

                        $data = new StudentFees;
                        $data->school_id = $school->id;
                        $data->academic_session = $academic;
                        $data->fees_type_id = $fees['fees_type_id'];
                        $data->student_id = $student->id;
                        $data->class_id = $class_id;
                        $data->fees_amount = $fees['amount'];
                        $data->fees_paid = 0;
                        $data->total_installment = $fees['installment'];
                        $data->paid_installment = 0;
                        $data->status = 1;
                        $data->save();
                    }
                }
            }
        }
        return 'Success';
    }



    public function updateEditFees(Request $request)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $feesdetail = StudentFees::join('fees_types', 'fees_types.id', '=', 'student_fees.fees_type_id')->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.status' => 1, 'student_fees.class_id' => $request->class, 'student_fees.student_id' => $request->id])->get();

        foreach ($feesdetail as $fees) {

            if ($fees->global == 1) {
                $feesId = 'feesId_' . $fees->fees_type_id;
                $feesName = 'feesName_' . $fees->fees_type_id;
                $feesammount = 'feesamount_' . $fees->fees_type_id;
                $feesinstall = 'feesInstall_' . $fees->fees_type_id;

                $data = StudentFees::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => 1, 'class_id' => $request->class, 'student_id' => $request->id, 'fees_type_id' => $fees->fees_type_id])->first();

                $data->fees_amount = $request[$feesammount];
                $data->total_installment = $request[$feesinstall];
                $data->update();
            }
        }

        return redirect()->back()->with('Success', 'Fees Updated Successfully!');

    }


    public function feeDepositeList($id)
    {

        $school = \App\Helper\Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }


        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')
            ->where(['students.status' => $id, 'students.school_id' => $school->id, 'students.academic_session' => $academic])
            ->get();


        $onlineRecieptNos = array();

        for ($i = 0; $i < count($studentList); $i++) {

            $onlineRecieptNo = FeesTransaction::select('online_receipt_no')->where('student_id', '=', $studentList[$i]->id)->get();
            $onlineRecieptNos[$studentList[$i]->student_id][] = $onlineRecieptNo ?? [];
        }
        //        dd($onlineRecieptNos);
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
        return view('school.fees.fees-deposite.student-list', compact('studentList', 'mark', 'finalarray', 'onlineRecieptNos'));
    }
    public function feesCard($id)
    {

        $school = \App\Helper\Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }


        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')
            ->where(['students.status' => $id, 'students.school_id' => $school->id, 'students.academic_session' => $academic])
            ->get();


        $onlineRecieptNos = array();

        for ($i = 0; $i < count($studentList); $i++) {

            $onlineRecieptNo = FeesTransaction::select('online_receipt_no')->where('student_id', '=', $studentList[$i]->id)->get();
            $onlineRecieptNos[$studentList[$i]->student_id][] = $onlineRecieptNo ?? [];
        }
        //        dd($onlineRecieptNos);
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
        return view('school.fees.fees-deposite.fees-card', compact('studentList', 'mark', 'finalarray', 'onlineRecieptNos'));
    }

    public function feedepositeSearchStudent(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            })->where('class_id', $request->Class)->where('students.status', $request->searchId)->get();
        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->get();
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
        $class = $request->Class;
        $onlineRecieptNos = array();

        for ($i = 0; $i < count($studentList); $i++) {

            $onlineRecieptNo = FeesTransaction::select('online_receipt_no')->where('student_id', '=', $studentList[$i]->id)->get();
            $onlineRecieptNos[$studentList[$i]->student_id][] = $onlineRecieptNo ?? [];
        }

        return view('school.fees.fees-deposite.student-list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class', 'onlineRecieptNos'));
    }
    // change end
    public function viewDepositeEdit($id)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $studentEdit = Student::where('id', $id)->first();
        $scclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();


        foreach ($scclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            foreach ($scclass as $class) {
                if ($class->classname == $value) {
                    $x['classname'] = $class->classname;
                    $x['id'] = $class->id;
                    $finalarray[] = $x;
                }
                $x = [];
            }
        }

        $data = FeesTransaction::where(['school_id' => $school->id, 'academic_session' => $academic])->orderBy('id', 'DESC')->first();

        if (!empty($data)) {
            $online_receipt_no = (int) $data->online_receipt_no + 1;
        } else {
            $online_receipt_no = (int) $school->fees_no + 1;
        }

        $classId = $studentEdit->class_id;
        $studentfees = $this->updateStudentFees($classId);
        $stafflist = Staff::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '1'])->get();

        $feestype = StudentFees::join('fees_types', 'fees_types.id', '=', 'student_fees.fees_type_id')->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.status' => 1, 'student_fees.class_id' => $classId, 'student_fees.student_id' => $id])->get();

        return view('school.fees.fees-deposite.depositefees', compact('feestype', 'finalarray', 'classId', 'studentEdit', 'stafflist', 'online_receipt_no'));
    }

    public function updateDepositeFees(Request $request)
    {

        $request->validate([
            'online_receipt_no' => 'required||numeric',
            'deposor' => 'required||string',
            'reciever_name' => 'required||string',
            'payemnt' => 'required',
            'date' => 'required',
        ]);
        // dd($request->deposor);
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $feestype = FeesType::join('student_fees', 'fees_types.id', '=', 'student_fees.fees_type_id')->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.status' => 1, 'student_fees.class_id' => $request->class, 'student_fees.student_id' => $request->id])->get();

        foreach ($feestype as $key => $fees) {
            $feesId = 'feesId_' . $fees->fees_type_id;
            if (!$fees->total_installment == 0) {
                $installmentPrice = $fees->fees_amount / $fees->total_installment;
            } else {
                $installmentPrice = 0;
            }
            if ($fees->fees_type_id == $request[$feesId]) {
                $feesname = 'today_' . $fees->fees_type_id;
                $feePending = 'pendingFees_' . $fees->fees_type_id;
                $feespaid = $request[$feesname] + $fees->fees_paid;
                if (!$installmentPrice == 0) {
                    $paidInstallment = $feespaid / $installmentPrice;
                } else {
                    $paidInstallment = 0;
                }
                $data = StudentFees::where('id', $fees->id)->first();
                $data->fees_paid = $feespaid;
                $data->paid_installment = $paidInstallment;
                $data->update();

                if (!$installmentPrice == 0) {
                    $oldinstallment = $fees->fees_paid / $installmentPrice;
                    $newinstallment = $request[$feesname] / $installmentPrice;
                    $transaction_installment = $oldinstallment + $newinstallment;
                } else {
                    $transaction_installment = 0;
                }

                $Newdata = new FeesTransaction;
                $Newdata->school_id = $school->id;
                $Newdata->academic_session = $academic;
                $Newdata->fees_type_id = $request[$feesId];
                $Newdata->student_id = $request->id;
                $Newdata->class_id = $request->class;
                $Newdata->reciept_no = $request->offline_receipt_no;
                $Newdata->online_receipt_no = $request->online_receipt_no;
                $Newdata->transactio_no = $request->transactio_no;
                $Newdata->transaction_date = date('Y-m-d', strtotime($request->transaction_date));
                $request->transaction_date;
                $Newdata->fees_pending = $request[$feePending];
                $Newdata->fees_paid_today = $request[$feesname];
                $Newdata->reciever_name = $request->reciever_name;
                $Newdata->depositor_code = $request->depositor_code_2;
                $Newdata->payment_mode = $request->payemnt;
                $Newdata->deposor_name = $request->deposor;
                $Newdata->paid_installment = $transaction_installment;
                $Newdata->date = date('Y-m-d', strtotime($request->date));
                $Newdata->save();
            }
        }

        return redirect()->route('recieptprint', array($request->online_receipt_no, $request->id))->with('Success', 'Fees Updated Successfully!');
    }

    public function printReciept($id, $studentId)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $feesTransaction = FeesType::join('student_fees', 'student_fees.fees_type_id', '=', 'fees_types.id')->join('fees_transactions', 'student_fees.fees_type_id', '=', 'fees_transactions.fees_type_id')->where(['fees_transactions.school_id' => $school->id, 'fees_transactions.academic_session' => $academic, 'fees_transactions.online_receipt_no' => $id, 'fees_transactions.student_id' => $studentId])->where(['student_fees.school_id' => $school->id, 'student_fees.academic_session' => $academic, 'student_fees.student_id' => $studentId])->get();

        // dd($feesTransaction);
        // dd($id);

        $student = Student::where('id', $studentId)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();

        $feesdetails = FeesTransaction::where(['online_receipt_no' => $id, 'school_id' => $school->id, 'academic_session' => $academic])->orderBy('id', direction: 'desc')->first();
        // dd($feesdetails);

        return view('school.fees.fees-deposite.reciept-print', compact('student', 'schoolclass', 'feesTransaction', 'feesdetails'));
    }

    public function feesReportList($id)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        // dd($studentList);
        $from_date = date('Y-m-d');
        $today = date('Y-m-d');
        $from_date = date("d-m-Y", strtotime($from_date));
        $today = date("d-m-Y", strtotime($today));

        return view('school.fees.fees-deposite.fees-student-list', compact('studentList', 'mark', 'finalarray', 'from_date', 'today'));
    }

    public function printReport($id)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $data = FeesTransaction::where(['school_id' => $school->id, 'academic_session' => $academic, 'class_id' => $student->class_id, 'student_id' => $id])->get();
        $unique = $data->unique('reciept_no');
        // dd($unique);
        if (!empty($unique->toArray())) {
            return view('school.fees.fees-deposite.fees-report', compact('student', 'schoolclass', 'unique'));
        } else {
            return redirect()->back()->with('Warning', 'No Fees Receipt Found!');
        }

    }

    public function feeReportSearchStudent(Request $request)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            })->where('class_id', $request->Class)->where('students.status', $request->searchId)->get();
        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->get();
        }
        $from_date = date('Y-m-d');
        $today = date('Y-m-d');


        if (isset($request->from_date)) {
            $from_date = date('Y-m-d', strtotime($request->from_date));
            if (!isset($request->to_date)) {
                $today = date('Y-m-d');
            } else {
                $today = date('Y-m-d', strtotime($request->to_date));
                ;
            }

            if (!empty($request->Class)) {
                $studentList = SchoolClass::join('fees_transactions', 'fees_transactions.class_id', '=', 'school_classes.id')->join('students', 'students.id', '=', 'fees_transactions.student_id')->where(function ($query) use ($request) {
                    $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
                })->whereBetween('fees_transactions.date', [$from_date, $today])->where('fees_transactions.class_id', $request->Class)->where('students.status', $request->searchId)->get();
            } else {
                $studentList = SchoolClass::join('fees_transactions', 'fees_transactions.class_id', '=', 'school_classes.id')->join('students', 'students.id', '=', 'fees_transactions.student_id')->where(function ($query) use ($request) {
                    $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
                })->whereBetween('fees_transactions.date', [$from_date, $today])->where('students.status', $request->searchId)->get();
            }
            // dd($studentList);

            $studentList = collect($studentList)->unique('online_receipt_no');
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



        $feesstudentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => $request->searchId, 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();

        $totalfeesamount = 0;
        $totalfeesdeposite = 0;
        $totalfeespending = 0;
        foreach ($feesstudentList as $feesStd) {
            $totalfeesamount = $totalfeesamount + Custom::gettotalFees($feesStd->class_id, $feesStd->id);
            $totalfeesdeposite = $totalfeesdeposite + Custom::getDepositeFees($feesStd->class_id, $feesStd->id);
            $totalfeespending = $totalfeespending + Custom::getPendingFees($feesStd->class_id, $feesStd->id);
        }

        $feesSearch = 0;

        $studentsearch = $request->studentsearch;
        $class = $request->Class;
        $from_date = date("d-m-Y", strtotime($from_date));
        $today = date("d-m-Y", strtotime($today));

        return view('school.fees.fees-deposite.fees-student-list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class', 'from_date', 'today', 'totalfeesamount', 'feesSearch', 'totalfeesdeposite', 'totalfeespending'));
    }

    public function feesPendingList($id)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }


        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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

        // dd($finalarray);
        return view('school.fees.fees-deposite.pending-fees', compact('studentList', 'mark', 'finalarray'));
    }


    public function feependingSearchStudent(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            })->where('class_id', $request->Class)->where('students.status', $request->searchId)->get();
        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->get();
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
        $class = $request->Class;
        return view('school.fees.fees-deposite.pending-fees', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));
    }


    public function feesStudentList(){
        {
            $id = 2;
            $school = Custom::getSchool();
            $academic = Session::get('academic_session');

            $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

            $newClass = [];
            foreach ($schoolclass as $class) {
                $number = Custom::romanToInt($class->classname);
                $newClass[$class->id] = $number;
            }

            $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

            $newroman = [];
            sort($newClass);
            $newromanclass = [];

            foreach ($sortedArray as $organize) {
                if (in_array($organize, $newClass)) {
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

            // dd($studentList);
            $from_date = date('Y-m-d');
            $today = date('Y-m-d');
            $from_date = date("d-m-Y", strtotime($from_date));
            $today = date("d-m-Y", strtotime($today));

            return view('school.fees.fees-deposite.fees-card-student-list', compact('studentList', 'mark', 'finalarray', 'from_date', 'today'));
        }
    }
    public function feeCardSearchStudent(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();

        $newClass = [];
        foreach ($schoolclass as $class) {
            $number = Custom::romanToInt($class->classname);
            $newClass[$class->id] = $number;
        }

        $sortedArray = ['P.N.C.', 'N.C.', 'K.G.', 'L.K.G.', 'U.K.G.', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI (Art)', 'XI (Biology)', 'XI (Agriculture)', 'XI (Mathematics)', 'XI (Commerce)', 'XII (Art)', 'XII (Biology)', 'XII (Agriculture)', 'XII (Mathematics)', 'XII (Commerce)'];

        $newroman = [];
        sort($newClass);
        $newromanclass = [];

        foreach ($sortedArray as $organize) {
            if (in_array($organize, $newClass)) {
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
            })->where('class_id', $request->Class)->where('students.status', $request->searchId)->get();
        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $request->searchId)->get();
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
        $class = $request->Class;
        return view('school.fees.fees-deposite.fees-card-student-list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));
    }

    public function feesCardList($id){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $student = Student::where('id', $id)->first();

        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $data = FeesTransaction::where(['school_id' => $school->id, 'academic_session' => $academic, 'class_id' => $student->class_id, 'student_id' => $id])->get();
        $unique = $data->unique('reciept_no');
        // dd($unique);
        if (!empty($unique->toArray())) {
            return view('school.fees.fees-deposite.fees-card-list', compact('student', 'schoolclass', 'unique'));
        } else {
            return redirect()->back()->with('Warning', 'No Fees Receipt Found!');
        }

    }

    public function printSingleReport($reciept,$id){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $student = Student::where('id', $id)->first();
        $schoolclass = SchoolClass::where('id', $student->class_id)->first();
        $data = FeesTransaction::where(['school_id' => $school->id, 'academic_session' => $academic, 'class_id' => $student->class_id, 'id' => $reciept])->get();
        $unique = $data->unique('reciept_no');
        return view('school.fees.fees-deposite.fees-report', compact('student', 'schoolclass', 'unique'));

    }

}
