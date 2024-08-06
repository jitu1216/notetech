<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Custom;
use Auth;
use App\Models\Staff;
use App\Models\User;
use App\Models\StateCities;
use Brian2694\Toastr\Facades\Toastr;


class StaffController extends Controller
{
    public function addStaff(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $data = StateCities::all()->toarray();
        $state =  [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }

        return view('school.staff.add-staff',compact('state'));
    }


    public function storeStaff(Request $request){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');


        $request->validate([
            'application_date' => 'required',
            'staff_name'     => 'required|string',
            'staff_code'    => 'required',
            'father_name'     => 'required|string',
            'mother_name'     => 'required|string',
            'gender'        => 'required',
            'date_of_birth' => 'required|string',
            'religion'          => 'required|string',
            'category'   => 'required|string',
            'caste'         => 'required|string',
            'locality_type'         => 'required',
            'village'         => 'required|string',
            'post_type'         => 'required',
            'town'       => 'required|string',
            'state'         => 'required',
            'city'         => 'required',
            'pincode'         => 'required',
            'mobile'         => 'required|max:10|min:10',
           'email'     => 'required|string|email|max:255|unique:users',
            'nationality'  => 'required',
            'appointment_date'    => 'required',
            'appointment_position'    => 'required',
            'id_type'    => 'required',
            'qualification'    => 'required',
            'occupation'  => 'required',
            'identity_no'      => 'required',
            'experience_year'  => 'required',
            'password'       => 'required',
            'upload'        => 'required|image',

        ]);

        $power = array();
        for ($x = 1; $x < 12; $x++) {
            $powername = 'power_'.$x;
            if(isset($request[$powername])){
                array_push($power,$request[$powername]);
            }
          }

        $power =  implode(",",$power);

        $Image_fileName = time().'.'.$request->file('upload')->extension();
        $request->file('upload')->move(public_path('images'), $Image_fileName);


        if(!empty($request->file('experience_certificate'))){
            $Image_certificate = time().'.'.$request->file('experience_certificate')->extension();
            $request->file('experience_certificate')->move(public_path('images'), $Image_certificate);
          }else{
            $Image_certificate = null;
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

    public function listStaff(){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffList = Staff::where(['school_id'=> $school->id, 'academic_session'=>$academic ])->get();
        return view('school.staff.staff-list', compact('staffList'));
    }

    public function searchStaff(Request $request){

        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        if (!empty($request->staffsearch)) {
            $staffList = Staff::where(function ($query) use ($request) {
                $query->where('staff_code', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('staff_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('father_name', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('village', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('town', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('city', 'LIKE', "%" . $request->staffsearch . "%")->orwhere('state', 'LIKE', "%" . $request->staffsearch . "%");
            })->get();
        } else {
           $staffList = Staff::where(['school_id'=> $school->id, 'academic_session'=>$academic ])->get();
        }


        $staffsearch = $request->staffsearch;
        return view('school.staff.staff-list', compact('staffList','staffsearch'));
    }

    public function viewStaff($id){
        $school = Custom::getSchool();
        $academic = Session::get('academic_session');

        $data = StateCities::all()->toarray();
        $state =  [];
        $city = [];
        foreach ($data as $value) {
            if (!in_array($value['state'], $state)) {
                array_push($state, $value['state']);
            }
        }

        $staffList = Staff::where('id',$id)->first();
        $staffPower = explode(',',$staffList->staff_power);

        return view('school.staff.update-staff', compact('staffList','state','staffPower'));

    }

    public function updateStaff(Request $request){



        $school = Custom::getSchool();
        $academic = Session::get('academic_session');
        $staffdetail = Staff::where('id',$request->id)->first();

        $power = array();
        for ($x = 1; $x < 12; $x++) {
            $powername = 'power_'.$x;
            if(isset($request[$powername])){
                array_push($power,$request[$powername]);
            }
          }

        $power =  implode(",",$power);

        if(!empty($request->file('upload'))){
            $Image_fileName = time().'.'.$request->file('upload')->extension();
            $request->file('upload')->move(public_path('images'), $Image_fileName);
        }else{
            $Image_fileName = $staffdetail->image;
        }

        if(!empty($request->file('experience_certificate'))){
            $Image_certificate = time().'.'.$request->file('experience_certificate')->extension();
            $request->file('experience_certificate')->move(public_path('images'), $Image_certificate);
        }else{

            if(!empty($staffdetail->experience_certificate)){
                $Image_certificate = $staffdetail->experience_certificate;
              }else{
                  $Image_certificate = null;
              }
        }


        $user = User::where(['name'=> $staffdetail->staff_name, 'email'=> $staffdetail->email,'phone_number' => $staffdetail->mobile ])->first();

        $user->name = $request->staff_name;
        $user->email = $request->email;
        $user->phone_number = $request->mobile;
        $user->role_name = 'Staff';
        if(!empty($request->password)){
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
        $staffdetail->experience_qualification = $request->experience_qualification;
        $staffdetail->experience_year = $request->experience_year;
        $staffdetail->experience_certificate = $Image_certificate;
        $staffdetail->image = $Image_fileName;
        $staffdetail->update();

        return redirect()->back()->with('Success', 'Staff Updated Successfully!');

    }

    public function DeleteStaff(Request $request){


        $staffdetail = Staff::where('id',$request->id)->first();
        $staffdetail->delete();
        return redirect()->back()->with('Success', 'Staff Member Deleted Successfully!');
    }

}
