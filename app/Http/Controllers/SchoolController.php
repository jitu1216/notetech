<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Exports\ExportSchool;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AcademicSession;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\MatchOldPassword;
use App\Models\StateCities;

class SchoolController extends Controller
{
    public function AddSchoolPage(){

        $data = StateCities::all()->toarray();
        $state =  [];
        $city = [];
        foreach($data as $value){
            if(!in_array($value['state'], $state)){
                array_push($state, $value['state']);
            }
        }
        return view('superadmin.add-school',compact('state'));
    }

    public function GetState(Request $request){

        $data = StateCities::all()->toarray();
        $city = [];
        foreach($data as $value){

            if($value['state'] == $request->state){
                array_push($city, $value['city']);
            }
        }
        return $city;
    }


    public function SaveSchool(Request $request){

        $request->validate([
            'administrator_name'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'usertype' => 'required|string|max:255',
            'mobile' => 'required|max:10|min:10',
            'password'  => 'required|min:8',
            'school_name'     => 'required||max:255',
            'school_address' => 'required|string|max:255',
            'mobile' => 'required|max:10|min:10',
            'password'  => 'required|string|min:8',
            'registration' => 'required',
            'state' => 'required',
            'city' => 'required',
            'start_date' => 'required',
            'package' => 'required',
            'expiry_date' => 'required',
            'upload' => 'required|mimes:jpeg,png,jpg',
        ]);

        $code = School::orderBy('id','desc')->limit(1)->first();

        if(empty($code)){
            $code = 1;
            $usercode = substr($request['school_name'],0,3).sprintf("%06d", $code);
        }else{
            $usercode = substr($request['school_name'],0,3).sprintf("%06d", $code->id + 1);
        }

        $fileName = time().'.'.$request->file('upload')->extension();
        $request->file('upload')->move(public_path('images'), $fileName);


        $data = new School;
        $data->UserCode = $usercode;
        $data->Username = $request['administrator_name'];
        $data->Name = $request['school_name'];
        $data->Address = $request['school_address'];
        $data->Email = $request['email'];
        $data->Mobile = $request['mobile'];
        $data->Registration = $request['registration'];
        $data->Usertype = $request['usertype'];
        $data->Package = $request['package'];
        $data->State = $request['state'];
        $data->City = $request['city'];
        $data->Start_Date = date('Y-m-d H:i:s', strtotime($request['start_date']));
        $data->Expiry_Date = date('Y-m-d H:i:s', strtotime($request['expiry_date']));
        $data->Password = bcrypt($request['password']);
        $data->Logo = $fileName;
        $data->status = 1;
        $data->Source = 1;
        $data->save();

        $user = new User;
        $user->name = $request['school_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['mobile'];
        $user->role_name = 'School';
        $user->password = $data->Password;
        $user->save();


        return redirect()->route('schoollist')->with('Success','School Successfully Created!');
    }

    public function schoolList(){
        $schoolList = School::where('status','!=', 2)->get();
        $usercode = null;
        $school = null;
        $mobile = null;
        $state = null;
        return view('superadmin.schoollist', compact('schoolList','usercode','mobile','school'));
    }

    public function searhSchool(Request $request){
        if(!empty($request->usercode) || !empty($request->school) || !empty($request->mobile || !empty($request->state))){
            $schoolList = School::where(function ($query) use ($request) {
               $query->where('UserCode','LIKE',"%".$request->usercode."%")->where('Name','LIKE',"%".$request->school."%")->where('Mobile','LIKE',"%".$request->mobile."%")->where('State','LIKE',"%".$request->state."%")->orWhere('City','LIKE',"%".$request->state."%");
            })->where('status','!=', 2)->get();
            $usercode = $request->usercode;
            $school = $request->school;
            $mobile = $request->mobile;
            $state = $request->state;


            return view('superadmin.schoollist', compact('schoolList','usercode','mobile','school','state'));
        }else{
            return redirect()->intended('school/list');
        }

    }

    public function ShowSchool($id){
        $data = School::where('id',$id)->first();

        $statedata = StateCities::all()->toarray();
        $state =  [];
        foreach($statedata as $value){
            if(!in_array($value['state'], $state)){
                array_push($state, $value['state']);
            }
        }
        return view('superadmin.update-school', compact('data','state'));
    }

    public function UpdateSchool(Request $request){

        $request->validate([
            'administrator_name'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'usertype' => 'required|string|max:255',
            'mobile' => 'required|max:10|min:10',
            'school_name'     => 'required||max:255',
            'school_address' => 'required|string|max:255',
            'mobile' => 'required|max:10|min:10',
            'registration' => 'required',
            'state' => 'required',
            'city' => 'required',
            'fees_no' => 'required',
            // 'package' => 'required',
            // 'expiry_date' => 'required',
            // 'upload' => 'required|mimes:jpeg,png,jpg',
        ]);


        // dd($request);
        $data = School::where('id',$request->id)->first();
        $newdata = School::where('id',$request->id)->first();
        if(!empty($request->file('upload'))){
            $fileName = time().'.'.$request->file('upload')->extension();
            $request->file('upload')->move(public_path('images'), $fileName);
        }else{
            $fileName = $data->Logo;
        }

        if(!empty($request->password)){
            $pass = $request->password;
            $pass = bcrypt($pass);
        }else{
            $pass = $data->Password;
        }


        $data->Username = $request['administrator_name'];
        $data->Name = $request['school_name'];
        $data->Address = $request['school_address'];
        $data->Email = $request['email'];
        $data->Mobile = $request['mobile'];
        $data->Registration = $request['registration'];
        $data->Usertype = $request['usertype'];
        $data->State = $request['state'];
        $data->City = $request['city'];
        // $data->Package = $request['package'];
        // $data->Start_Date = date('Y-m-d H:i:s', strtotime($request['start_date']));
        // $data->Expiry_Date = date('Y-m-d H:i:s', strtotime($request['expiry_date']));
        $data->Password = $pass;
        $data->fees_no = $request->fees_no;
        $data->Logo = $fileName;
        $data->status = 1;
        $data->update();


        $user = User::where(['email' => $newdata->Email,'name' =>$newdata->Name,'role_name'=>'school'])->first();

        $user->name = $request['school_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['mobile'];
        $user->role_name = 'School';
        $user->password = $data->Password;
        $user->update();

        return redirect()->back()->with('Success','School Updated Successfully!');

    }

    public function OnlineList(){
        $schoolList = School::where('Source', 0)->where('status','!=', 2)->get();
        $usercode = null;
        $school = null;
        $mobile = null;
        return view('superadmin.onlinelist', compact('schoolList','usercode','mobile','school'));
    }

    public function OnlineSearchList(Request $request){
        if(!empty($request->usercode) || !empty($request->school) || !empty($request->mobile || !empty($request->state))){
            $schoolList = School::where(function ($query) use ($request) {
               $query->where('UserCode','LIKE',"%".$request->usercode."%")->where('Name','LIKE',"%".$request->school."%")->where('Mobile','LIKE',"%".$request->mobile."%")->where('State','LIKE',"%".$request->state."%")->orWhere('City','LIKE',"%".$request->state."%");
            })->where('Source', 0)->where('status','!=', 2)->get();
            $usercode = $request->usercode;
            $school = $request->school;
            $mobile = $request->mobile;
            $state = $request->state;
            return view('superadmin.onlinelist', compact('schoolList','usercode','mobile','school','state'));
        }else{
            return redirect()->intended('school/OnlineRegistration');
        }
    }

    public function ExportList(){

        return Excel::download(new ExportSchool, 'School.xlsx');
        return redirect()->intended('school/list');

    }
     public function schoolDelete(Request $request){

        try{
            School::where('id',$request->id)->update(['status' => 2]);
            return redirect()->back()->with('Success','School Deleted Successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('Error','School Failed to Delete!');
        }

     }


     public function SessionList(){
        $data = AcademicSession::all();
        Session::put('all_academic_session', $data);
        return view('superadmin.session.session-list',compact('data'));
     }

     public function SessionView($id){
        $data = AcademicSession::where('id',$id)->first();
        // dd($data);
        return view('superadmin.session.update-session',compact('data'));
     }

     public function AddSession(){
        return view('superadmin.session.add-session');
     }


     public function SaveSession(Request $request){
        $this->validate($request,[
            'session' => 'required|max:7',
         ]);

        if (preg_match("/^[0-9-]+$/", $request->session)) {

            $match = AcademicSession::where('session_date','LIKE',"%".$request->session."%")->first();

            if(empty($match)){
                $data = new AcademicSession;
                $data->session_date = $request['session'];
                $data->status = 1;
                $data->save();

                $data = AcademicSession::all();
                Session::put('all_academic_session', $data);
                return redirect()->route('sessionlist')->with('Success','Session Created Successfully!');
            }else{
                $data = AcademicSession::all();
                Session::put('all_academic_session', $data);
                return redirect()->back()->with('Error','Session Already Available!');
            }

        }else{
            $data = AcademicSession::all();
            Session::put('all_academic_session', $data);
            return redirect()->back()->with('Error','Please Fill Correct Date Format');
        }

     }


     public function UpdateSession(Request $request){

        $this->validate($request,[
            'session' => 'required|max:7',
         ]);
         if (preg_match("/^[0-9-]+$/", $request->session)) {
            $data = AcademicSession::where('id',$request->id)->first();
            $data->session_date = $request['session'];
            $data->update();
            $data = AcademicSession::all();
            Session::put('all_academic_session', $data);
            return redirect()->route('sessionlist')->with('Success','Session Updated Successfully!');
         }else{
            $data = AcademicSession::all();
            Session::put('all_academic_session', $data);
            return redirect()->back()->with('Error','Please Fill Correct Date Format');
         }
     }

     public function schoolDashboard($id){
        $data = School::where('id',$id)->first();
        Session::put('admin_school', $data);
        // dd(Session::get('admin_school'));
        return redirect()->intended('school');
     }


}
