<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ForgotPassword;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showForgetPasswordForm(){
        $check =  null;
        return view('auth.forgot-password',compact('check'));
    }

    public function otpSend(Request $request){




       if($request->form_type == 0){

        $request->validate([
            'email' => 'required|email',
            'form_type' => 'required',
        ]);

       $user = User::where('email',$request->email)->count();

            if($user > 0){
             $token  = random_int(100000, 999999);

                if(ForgotPassword::where('email',$request->email)->count() > 0){
                    ForgotPassword::where('email',$request->email)->update([
                        'email' => $request->email,
                        'token' => $token
                    ]);
                }else{
                    ForgotPassword::insert([
                        'email' => $request->email,
                        'token' => $token
                    ]);
                }


            Mail::send('auth.forget-password-email', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                $message->subject('Reset Password');
            });

            return redirect()->route('new-password')->with('Success', 'Password Reset OTP Send Successfully!');

            }else{
                return redirect()->back()->with('Error',"User Doesn't Exist!");
            }
        }else{

            $request->validate([
                'email' => 'required|email',
                'form_type' => 'required',
                'otp' => 'required|min:6',
                'password' => 'required|min:6',
                'confirm-password' => 'required_with:password|same:password',

            ]);

                $user = User::where('email',$request->email)->first();
                $pass = ForgotPassword::where('email',$request->email)->first();

                $password = bcrypt($request->password);

                if(!empty($user)){
                    if(!empty($pass)){
                        if($pass->token == $request->otp){
                            User::where('email',$request->email)->update(['password' => $password]);
                            return redirect()->route('login')->with('Success', 'Password Changed Successfully!');
                        }else{
                            return redirect()->back()->with('Error',"Please Enter Correct Verification Code!");
                        }
                    }else{
                        return redirect()->back()->with('Error',"Verification Code Doesn't Exist!");
                    }
                }else{
                    return redirect()->back()->with('Error',"User Doesn't Exist!");
                }


        }
    }

    public function showNewPasswordForm(){
        $check =  1;
        return view('auth.forgot-password',compact('check'));
    }
}
