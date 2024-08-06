<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\AcademicSession;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    /** home dashboard */
    public function index()
    {
            if(!Session::get('academic_session')){
                $nextyear = substr(date("Y"), -2) + 1;
                $year = date("Y").'-'.$nextyear;
                Session::put('academic_session', $year);
            }

            $data = AcademicSession::all();
            Session::put('all_academic_session', $data);
            $schoolList = School::where('status','!=', 2)->get();
            return view('superadmin.home', compact('schoolList'));
    }

    /** profile user */
    public function userProfile()
    {

        $data = User::where('email', Session::get('email'))->first();
        return view('superadmin.profile',compact('data'));
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }

    public function UpdateProfile(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:10|min:10',
            'password' => 'confirmed',
         ]);

         $data = User::where('email', Session::get('email'))->first();

         if(!empty($request['password'])){
            $pass = bcrypt($request['password']);
         }else{
            $pass = $data->password;
         }
         $data->name = $request['name'];
         $data->email = $request['email'];
         $data->phone_number = $request['phone_number'];
         $data->password = $pass;
         $data->update();

         Session::put('name', $request['name']);
         Session::put('email', $request['email']);
         Session::put('phone_number', $request['phone_number']);

         return redirect()->back()->with('Success','Successfully Changed!');

    }

    public function ChangeSession($id){
        Session::put('academic_session', $id);
        return redirect()->back()->with('Success','Session Successfully Changed!');
        // return redirect()->back();
    }
}
