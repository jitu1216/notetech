<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        $role = DB::table('role_type_users')->get();
        return view('auth.register',compact('role'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string|max:255',
            'mobile' => 'required|max:10|min:10',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $code = School::orderBy('id','desc')->limit(1)->first();
        if(empty($code)){
            $code = 1;
            $usercode = substr($request['name'],0,3).sprintf("%06d", $code);
        }else{
            $usercode = substr($request['name'],0,3).sprintf("%06d", $code->id + 1);
        }

        $pass = bcrypt($request['password']);
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone_number' => $request->mobile,
            'role_name' => 'School',
            'password'  => $pass,
        ]);

        $data = new School;
        $data->UserCode = $usercode;
        // $data->Username = $request['administrator_name'];
        $data->Name = $request['name'];
        $data->Email = $request['email'];
        $data->Mobile = $request['mobile'];
        $data->Usertype = $request['role_name'];
        $data->Package = 1;
        $data->Start_Date = date('Y-m-d');
        $data->Expiry_Date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 3 days'));
        $data->Password = $pass;
        $data->status = 1;
        $data->Source = 0;
        $data->save();

        Toastr::success('Create new account successfully :)','Success');
        return redirect('login');
    }
}
