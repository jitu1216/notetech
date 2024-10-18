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

class NoticeController extends Controller
{

    public function notice_item()
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $item = NoticeItem::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        return view('school.notice.notice_item', compact('item'));

    }

    public function addnoticeitem()
    {
        return view('school.notice.add_notice_item');
    }

    public function savenoticeitem(Request $request)
    {
        // dd($request);
        $request->validate([
            'item_name' => 'required',
            'item_type' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new NoticeItem;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        $item->item_name = $request->item_name;
        $item->item_type = $request->item_type;
        $item->save();

        return redirect()->route('notice_item')->with('Success', 'Notice Added Successfully');

    }

    public function editnoticeitem($id)
    {

        $item = NoticeItem::find($id);

        return view('school.notice.edit_notice_item', compact('item'));
    }

    public function updatenoticeitem(Request $request)
    {


        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = NoticeItem::find($request->id);
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        $item->item_type = $request->item_type;
        $item->item_name = $request->item_name;
        $item->update();

        return redirect()->route('notice_item')->with('Success', 'Notice Edit Successfully');

    }

    public function removenoticeitem($id)
    {

        $record = NoticeItem::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('Success', 'Notice delete Successfully');
        } else {
            return redirect()->back()->with('Success', 'Notice Not Found');
        }
    }

    public function studentnoticelist()
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,])->get();

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

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(['students.status' => '2', 'students.school_id' => $school->id, 'students.academic_session' => $academic])->get();

        // dd($studentList);

        $mark = 2;

        // $scheme = ExamScheme::where(['school_id' => $school->id, 'academic_session' => $academic, 'exam_type' => $text])->select('exam_date')->distinct('exam_date')->get();
        // $scheme_header = SchemeHeader::where(['school_id'=> $school->id, 'academic_session'=> $academic ])->orderBy('updated_at', 'asc')->get();
        return view('school.notice.student_notice_list', compact('finalarray', 'schoolclass', 'mark', 'studentList'));
    }

    public function searchstudentnotice(Request $request)
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
        if ($request->searchId == 5) {
            $mark = 2;
        }

        if (!empty($request->Class)) {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('students.status', $mark)->get();

        } else {
            $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $mark)->get();
        }

        if ($request->searchId == 5) {
            $mark = 5;
        }

        $studentsearch = $request->studentsearch;
        $class = $request->Class;
        // dd($class);
        return view('school.notice.student_notice_list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));

    }

    public function studentnotice($id)
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        // dd($item);
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

        $session = Session::get('all_academic_session');
        // dd($session);

        $sugg_notice = NoticeItem::where(['school_id' => $school->id, 'academic_session' => $academic, 'item_type' => 'suggestion'])->get();

        $compl_notice = NoticeItem::where(['school_id' => $school->id, 'academic_session' => $academic, 'item_type' => 'complaints'])->get();

        $studentList = Student::where(['school_id' => $school->id, 'academic_session' => $academic, 'id' => $id])->first();
        // dd($studentList);
        $mark = 2;

        return view('school.notice.student_notice', compact(
            'finalarray',
            'schoolclass',
            'mark',
            'studentList',
            'session',
            'compl_notice',
            'sugg_notice'
        ));
    }

    public function savestudentnotice(Request $request)
    {

        // dd($request);

        $school = custom::getschool();
        $academic = Session::get('academic_session');

        $request->validate([
            'notice_no' => 'required',
            'date' => 'required',
        ]);

        $data = StudentNotice::where(['student_id' => $request->student_id, 'academic_session' => $academic, 'school_id' => $school->id])->get();


        if ($data->isEmpty()) {

            if ($request->status) {
                foreach ($request->item as $value) {
                    $status = 0;
                    foreach ($request->status as $item) {
                        if ($item == $value) {
                            $status = 1;
                        }
                    }

                    $main = new StudentNotice();
                    $main->student_id = $request->student_id;
                    $main->school_id = $school->id;
                    $main->academic_session = $academic;
                    $main->class_id = $request->class_id;
                    $main->notice_no = $request->notice_no;
                    $main->date = $request->date;
                    $main->item_status = $status;
                    $main->item_id = $value;
                    $main->save();
                }
            }

            if ($request->suggest_status) {
                foreach ($request->suggest_item as $value) {
                    $status = 0;
                    foreach ($request->suggest_status as $item) {
                        if ($item == $value) {
                            $status = 1;
                        }
                    }
                    $main = new StudentNotice();
                    $main->student_id = $request->student_id;
                    $main->school_id = $school->id;
                    $main->academic_session = $academic;
                    $main->class_id = $request->class_id;
                    $main->notice_no = $request->notice_no;
                    $main->date = $request->date;
                    $main->item_status = $status;
                    $main->item_id = $value;
                    $main->save();
                }
            }

        } else {
            foreach ($request->item as $value) {
                $status = 0;
                if ($request->status) {
                    foreach ($request->status as $item) {
                        if ($item == $value) {
                            $status = 1;
                        }
                    }
                }
                $main = StudentNotice::where(['student_id' => $request->student_id, 'academic_session' => $academic, 'school_id' => $school->id, 'item_id' => $value])->first();
                $check = $main;
                if (!$check) {
                    $main = new StudentNotice();
                }
                $main->student_id = $request->student_id;
                $main->school_id = $school->id;
                $main->academic_session = $academic;
                $main->class_id = $request->class_id;
                $main->notice_no = $request->notice_no;
                $main->date = $request->date;
                $main->item_status = $status;
                $main->item_id = $value;
                if (!$check) {
                    $main->save();
                } else {
                    $main->update();
                }
            }


            foreach ($request->suggest_item as $value) {
                $status = 0;
                if ($request->suggest_status) {
                    foreach ($request->suggest_status as $item) {
                        if ($item == $value) {
                            $status = 1;
                        }
                    }
                }

                $main = StudentNotice::where(['student_id' => $request->student_id, 'academic_session' => $academic, 'school_id' => $school->id, 'item_id' => $value])->first();
                $check = $main;
                if (!$check) {
                    $main = new StudentNotice();
                }
                $main->student_id = $request->student_id;
                $main->school_id = $school->id;
                $main->academic_session = $academic;
                $main->class_id = $request->class_id;
                $main->notice_no = $request->notice_no;
                $main->date = $request->date;
                $main->item_status = $status;
                $main->item_id = $value;
                if (!$check) {
                    $main->save();
                } else {
                    $main->update();
                }
            }
        }

        return redirect()->back()->with('Success', 'Notice Saved');
    }

    public function notice_for_all_list()
    {
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $notice = NoticeForAll::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        return view('school.notice.notice_for_all_list', compact('notice'));

    }

    public function add_notice_for_all()
    {
        return view('school.notice.add_notice_for_all');
    }

    public function savenoticeforall(Request $request)
    {
        // dd($request);
        $request->validate([
            'notice_text' => 'required',
            'date' => 'required',
        ]);

        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = new NoticeForAll;
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        $item->notice_text = $request->notice_text;
        $item->date = date('Y-m-d', strtotime($request->date));
        $item->save();

        return redirect()->route('notice-for-all-list')->with('Success', 'Notice Added Successfully');

    }

    public function editnoticeforall($id)
    {

        $item = NoticeForAll::find($id);

        return view('school.notice.edit_notice_for_all', compact('item'));
    }

    public function updatenoticeforall(Request $request)
    {


        $school = Custom::getschool();
        $academic = Session::get('academic_session');

        $item = NoticeForAll::find($request->id);
        $item->academic_session = $academic;
        $item->school_id = $school->id;
        $item->notice_text = $request->notice_text;
        $item->date = date('Y-m-d', strtotime($request->date));
        $item->update();

        return redirect()->route('notice-for-all-list')->with('Success', 'Notice Edit Successfully');

    }

    public function remove_notice($id)
    {

        $record = NoticeForAll::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('Success', 'Notice delete Successfully');
        } else {
            return redirect()->back()->with('Success', 'Notice Not Found');
        }
    }

    public function notice_for_all($id)
    {
        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $notice = NoticeForAll::where(['school_id' => $school->id, 'academic_session' => $academic,'id' => $id])->first();

        return view('school.notice.student_notice_for_all',compact('notice'));

    }

    public function genratenoticelist()
    {

        $school = Custom::getschool();
        $academic = Session::get('academic_session');
        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic,])->get();

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

        $studentIds = StudentNotice::where(['item_status' => '1', 'school_id' => $school->id, 'academic_session' => $academic])
        ->pluck('student_id')
        ->unique(); // Get unique student IDs

        $studentList = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->whereIn('students.id', $studentIds)
        ->get();

        // dd($studentList);

        $mark = 2;

        return view('school.notice.genrate_notice_list', compact('finalarray', 'schoolclass', 'mark', 'studentList'));
    }

    public function searchgenratenotice(Request $request)
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
        if ($request->searchId == 5) {
            $mark = 2;
        }

        if (!empty($request->Class)) {
            $students = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('class_id', $request->Class)->where('students.status', $mark)->get();

        } else {
            $students = SchoolClass::join('students', 'students.class_id', '=', 'school_classes.id')->where(function ($query) use ($request, $mark) {
                $query->where('application_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('sr_no', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('student_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('district', 'LIKE', "%" . $request->studentsearch . "%")->orwhere('state', 'LIKE', "%" . $request->studentsearch . "%");
            })->where('students.status', $mark)->get();
        }



        $studentIdsWithNotices  = StudentNotice::where(['item_status' => '1', 'school_id' => $school->id, 'academic_session' => $academic])
        ->pluck('student_id')
        ->unique();


        // Filter the provided student collection
        $studentList = $students->filter(function ($student) use ($studentIdsWithNotices) {
        return $studentIdsWithNotices->contains($student->id);
        });

        // dd($studentList);

        if ($request->searchId == 5) {
            $mark = 5;
        }

        $studentsearch = $request->studentsearch;
        $class = $request->Class;
        // dd($class);
        return view('school.notice.genrate_notice_list', compact('studentList', 'mark', 'finalarray', 'studentsearch', 'class'));

    }
}
