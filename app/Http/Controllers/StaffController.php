<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use App\Models\StateCities;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Brian2694\Toastr\Facades\Toastr;
use Session;
use App\Helper\Custom;
use Auth;


class StaffController extends Controller
{
    public function addStaff()
    {


        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $data = StateCities::all()->toarray();
        $state = [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();
        // dd($schoolclass);
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

        return view('school.staff.add-staff', compact('state', 'finalarray'));
    }


    public function storeStaff(Request $request)
    {
        // dd($request);
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $request->validate([
            'application_date' => 'required',
            'staff_name' => 'required|string',
            'staff_code' => 'required',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'gender' => 'required',
            'date_of_birth' => 'required|string',
            'religion' => 'required|string',
            'category' => 'required|string',
            'caste' => 'required|string',
            'locality_type' => 'required',
            'village' => 'required|string',
            'post_type' => 'required',
            'town' => 'required|string',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'mobile' => 'required|max:10|min:10',
            'email' => 'required|string|email|max:255|unique:users',
            'nationality' => 'required',
            'appointment_date' => 'required',
            'appointment_position' => 'required',
            'id_type' => 'required',
            'qualification' => 'required',
            'occupation' => 'required',
            'identity_no' => 'required',
            'experience_year' => 'required',
            'password' => 'required',
            'upload' => 'required|image',

        ]);

        $power = array();

        // for ($x = 1; $x < 12; $x++) {
        //     $powername = 'power_' . $x;
        //     if (isset($request[$powername])) {
        //         array_push($power, $request[$powername]);
        //     }
        // }

        if (isset($request->power)) {
            $power = implode(",", $request->power);
        }else{
            $power = null;
        }


        $Image_fileName = time() . '.' . $request->file('upload')->extension();
        $request->file('upload')->move(public_path('images'), $Image_fileName);


        if (!empty($request->file('experience_certificate'))) {
            $Image_certificate = time() . '.' . $request->file('experience_certificate')->extension();
            $request->file('experience_certificate')->move(public_path('images'), $Image_certificate);
        } else {
            $Image_certificate = null;
        }

        $allot_class = array();

        if ($request->appointment_position == 'Assistant Teacher') {
            $allot_class = implode(",", $request->teacher_class);
        } else {
            $allot_class = null;
        }

        $data = new Staff;
        $data->school_id = $school->id;
        $data->academic_session = $academic;
        $data->application_date = $request->application_date;
        $data->staff_name = $request->staff_name;
        $data->staff_code = $request->staff_code;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->gender = $request->gender;
        $data->date_of_birth = $request->date_of_birth;
        $data->religion = $request->religion;
        $data->category = $request->category;
        $data->caste = $request->caste;
        $data->locality_type = $request->locality_type;
        $data->village = $request->village;
        $data->post_type = $request->post_type;
        $data->town = $request->town;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->pincode = $request->pincode;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->nationality = $request->nationality;
        $data->appointment_date = $request->appointment_date;
        $data->appointment_position = $request->appointment_position;
        $data->id_type = $request->id_type;
        $data->qualification = $request->qualification;
        $data->occupation = $request->occupation;
        $data->identity_no = $request->identity_no;
        $data->staff_power = $power;
        $data->experience_qualification = $request->experience_qualification;
        $data->experience_year = $request->experience_year;
        $data->experience_certificate = $Image_certificate;
        $data->image = $Image_fileName;
        if ($request->appointment_position == 'Assistant Teacher') {
            $data->allot_class = $allot_class;
        }
        // dd($data);
        $data->save();


        $user = new User;
        $user->name = $request->staff_name;
        $user->email = $request->email;
        $user->phone_number = $request->mobile;
        $user->role_name = 'Staff';
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('Success', 'Staff Added Successfully!');

    }

    public function promoteStaff(Request $request)
    {
        $school = Custom::getSchool();
        $academic = $request->session;
        $staffdetail = Staff::where('id', $request->id)->first();

        // dd($staffdetail);

        $data = new Staff;
        $data->school_id = $school->id;
        $data->academic_session = $academic;
        $data->application_date = $staffdetail->application_date;
        $data->staff_name = $staffdetail->staff_name;
        $data->staff_code = $staffdetail->staff_code;
        $data->father_name = $staffdetail->father_name;
        $data->mother_name = $staffdetail->mother_name;
        $data->gender = $staffdetail->gender;
        $data->date_of_birth = $staffdetail->date_of_birth;
        $data->religion = $staffdetail->religion;
        $data->category = $staffdetail->category;
        $data->caste = $staffdetail->caste;
        $data->locality_type = $staffdetail->locality_type;
        $data->village = $staffdetail->village;
        $data->post_type = $staffdetail->post_type;
        $data->town = $staffdetail->town;
        $data->state = $staffdetail->state;
        $data->city = $staffdetail->city;
        $data->pincode = $staffdetail->pincode;
        $data->mobile = $staffdetail->mobile;
        $data->email = $staffdetail->email;
        $data->nationality = $staffdetail->nationality;
        $data->appointment_date = $staffdetail->appointment_date;
        $data->appointment_position = $staffdetail->appointment_position;
        $data->id_type = $staffdetail->id_type;
        $data->qualification = $staffdetail->qualification;
        $data->occupation = $staffdetail->occupation;
        $data->identity_no = $staffdetail->identity_no;
        $data->staff_power = $staffdetail->staff_power;
        $data->experience_qualification = $staffdetail->experience_qualification;
        $data->experience_year = $staffdetail->experience_year;
        $data->experience_certificate = $staffdetail->experience_certificate;
        $data->image = $staffdetail->image;
        $data->allot_class = $staffdetail->allot_class;
        $data->promoted = 0;
        // dd($data);
        $data->save();

        $staffdetail->promoted = 1;
        $staffdetail->update();

        return redirect()->back()->with('Success', 'Staff Promoted Successfully!');


    }

    public function listStaff()
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        // dd($staffList);
        return view('school.staff.staff-list', compact('staffList'));
    }

    public function promoteListStaff()
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        // dd($staffList);
        $session_data = AcademicSession::all();
        return view('school.staff.promote-staff-list', compact('staffList', 'session_data'));
    }

    public function searchStaff(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        if (!empty($request->staffsearch)) {
            $staffList = Staff::where(function ($query) use ($request) {
                $query->where('staff_code', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('staff_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('village', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('town', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('city', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('state', 'LIKE', "%" . $request->staffsearch . "%");
            })->get();
        } else {
            $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        }


        $staffsearch = $request->staffsearch;
        return view('school.staff.staff-list', compact('staffList', 'staffsearch'));
    }

    public function searchPromoteStaff(Request $request)
    {

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        if (!empty($request->staffsearch)) {
            $staffList = Staff::where(function ($query) use ($request) {
                $query->where('staff_code', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('staff_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('village', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('town', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('city', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('state', 'LIKE', "%" . $request->staffsearch . "%");
            })->get();
        } else {
            $staffList = Staff::where(['school_id' => $school->id, 'academic_session' => $academic])->get();
        }


        $staffsearch = $request->staffsearch;
        $session_data = AcademicSession::all();
        return view('school.staff.promote-staff-list', compact('staffList', 'staffsearch', 'session_data'));
    }



    public function viewStaff($id)
    {
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $data = StateCities::all()->toarray();
        $state = [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }

        $staffList = Staff::where('id', $id)->first();
        $staffPower = explode(',', $staffList->staff_power);
        $allot_class = explode(',', $staffList->allot_class);

        $schoolclass = SchoolClass::where(['school_id' => $school->id, 'academic_session' => $academic, 'status' => '0'])->get();
        // dd($schoolclass);
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

        return view('school.staff.update-staff', compact('staffList', 'state', 'staffPower', 'finalarray', 'allot_class'));

    }

    public function updateStaff(Request $request)
    {

        // dd($request);
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffdetail = Staff::where('id', $request->id)->first();

        $power = array();
        if (isset($request->power)) {
            $power = implode(",", $request->power);
        }else{
            $power = null;
        }
        // dd($power);

        if (!empty($request->file('upload'))) {
            $Image_fileName = time() . '.' . $request->file('upload')->extension();
            $request->file('upload')->move(public_path('images'), $Image_fileName);
        } else {
            $Image_fileName = $staffdetail->image;
        }

        if (!empty($request->file('experience_certificate'))) {
            $Image_certificate = time() . '.' . $request->file('experience_certificate')->extension();
            $request->file('experience_certificate')->move(public_path('images'), $Image_certificate);
        } else {

            if (!empty($staffdetail->experience_certificate)) {
                $Image_certificate = $staffdetail->experience_certificate;
            } else {
                $Image_certificate = null;
            }
        }

        $allot_class = array();


        if ($request->appointment_position == 'Assistant Teacher') {
            $allot_class = implode(",", $request->teacher_class);
        } else {
            $allot_class = null;
        }

        // dd($allot_class);


        $user = User::where('email', $staffdetail->email)->first();

        $user->name = $request->staff_name;
        $user->email = $request->email;
        $user->phone_number = $request->mobile;
        $user->role_name = 'Staff';
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->update();


        $staffdetail->application_date = $request->application_date;
        $staffdetail->staff_name = $request->staff_name;
        $staffdetail->staff_code = $request->staff_code;
        $staffdetail->father_name = $request->father_name;
        $staffdetail->mother_name = $request->mother_name;
        $staffdetail->gender = $request->gender;
        $staffdetail->date_of_birth = $request->date_of_birth;
        $staffdetail->religion = $request->religion;
        $staffdetail->category = $request->category;
        $staffdetail->caste = $request->caste;
        $staffdetail->locality_type = $request->locality_type;
        $staffdetail->village = $request->village;
        $staffdetail->post_type = $request->post_type;
        $staffdetail->town = $request->town;
        $staffdetail->state = $request->state;
        $staffdetail->city = $request->city;
        $staffdetail->pincode = $request->pincode;
        $staffdetail->mobile = $request->mobile;
        $staffdetail->email = $request->email;
        $staffdetail->nationality = $request->nationality;
        $staffdetail->appointment_date = $request->appointment_date;
        $staffdetail->appointment_position = $request->appointment_position;
        $staffdetail->id_type = $request->id_type;
        $staffdetail->qualification = $request->qualification;
        $staffdetail->occupation = $request->occupation;
        $staffdetail->identity_no = $request->identity_no;
        $staffdetail->staff_power = $power;
        $staffdetail->allot_class = $allot_class;
        $staffdetail->experience_qualification = $request->experience_qualification;
        $staffdetail->experience_year = $request->experience_year;
        $staffdetail->experience_certificate = $Image_certificate;
        $staffdetail->experience_certificate = $Image_certificate;
        $staffdetail->image = $Image_fileName;
        $staffdetail->update();

        return redirect()->back()->with('Success', 'Staff Updated Successfully!');

    }

    public function DeleteStaff(Request $request)
    {


        $staffdetail = Staff::where('id', $request->id)->first();
        $staffdetail->delete();
        return redirect()->back()->with('Success', 'Staff Member Deleted Successfully!');
    }

}
