<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AcademicSession;
use Session;
use Custom;


class StudentAuthController extends Controller
{
    protected $redirectTo = '/student'; // Redirect path after login

    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    /** Display login form */
    public function login()
    {
        $mark = '2';
        return view('studentDashboard.login.login', compact('mark'));
    }

    /** Handle login attempt */
    public function authenticate(Request $request)
    {

        if ($request->mark == '2') {
            $request->validate([
                'mobile' => 'required|max:10|min:10',
                'password' => 'required|string',
            ]);
            Custom::academicSession();
            $academic = Session::get('academic_session');
            $credentials = $request->only('mobile', 'password');
            $students = Student::where(['mobile' => $request->mobile, 'show_pass' => $request->password, 'academic_session' => $academic])->get();


            if (count($students) > 1) {
                $mark = '1';
                return view('studentDashboard.login.login', compact('mark','students'));
            } elseif (count($students) == 1) {
                if (Auth::guard('student')->attempt(['mobile' => $credentials['mobile'], 'password' => $credentials['password']])) {
                    // Authentication passed, redirect to student home
                    Toastr::success('Login successfully :)', 'Success');
                    return redirect()->intended($this->redirectTo);
                } else {
                    // Authentication failed, redirect back with error
                    Toastr::error('Login Failed, WRONG MOBILE NUMBER OR PASSWORD :)', 'Error');
                    return redirect()->back()->withInput();
                }

            } else {
                // Authentication failed, redirect back with error
                Toastr::error('Login Failed, WRONG MOBILE NUMBER OR PASSWORD :)', 'Error');
                return redirect()->back()->withInput();
            }
        }else{

            // dd($request);
            $student = Student::where('id', $request->student_id)->first();
            // $credentials = $student->only('mobile', 'password');
            if (Auth::guard('student')->login($student)) {
                Session::put('name', $student->student_name);
                Session::put('email', $student->email);
                Session::put('user_id', $student->id);

                Session::put('phone_number', $student->mobile);
                Session::put('status', $student->status);
                Session::put('role_name', 'Student');
                Session::get('admin_school','');
                Toastr::success('Login successfully :)', 'Success');
                return redirect()->intended($this->redirectTo);
            } else {
                // Authentication failed, redirect back with error
                Toastr::error('Login Failed, WRONG MOBILE NUMBER OR PASSWORD :)', 'Error');
                return redirect()->back()->withInput();
            }
            // dd($student);

        }
    }

    /** Logout student */
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        // Clear session
        $request->session()->flush();

        Toastr::success('Logout successfully :)', 'Success');
        return redirect('/student/login');
    }
}
