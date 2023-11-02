<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    function forgotPassword()
    {
        return view('pages.forgot-password');
    }

    function forgotPasswordPost(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
        ]);

        $token = Str::random(64);
        $email = $request->email;


        $user = User::where('email', $email)->first();


            if ($user) {

                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);

                Mail::send('emails.forgot-password-email', ['token' => $token], function($message) use ($request){
                    $message->to($request->email);
                    $message->subject('Recover your iBake account');

                });

                return redirect()->back()->with('success', "We've sent a password reset link to your email address. $email");


            } else {

                return redirect()->back()->with('error', "We couldn't find an account registered with the email address $email");

         

            }

    }


    function  resetPassword($token)
    {
        return view('pages.reset-password', ['token' => $token]);
    }

    function  resetPasswordPost(Request $request)
    {
 

        $request->validate([
            'password' => 'required|string|min:8|max:16|confirmed',
            'password_confirmation' => 'required',
        ]);

        $newPassword = Hash::make($request->password);


        $updatePassword = DB::table('password_resets')
        ->where([
            'token' => $request->token,
        ])->first();


        if(!$updatePassword){

            return redirect()->back()->with('error', "Invalid reset password request");
        }
        
   

            $email = $updatePassword->email;
        
                DB::table('users')
                ->where('email', $email)
                ->update(['password' => $newPassword]);


                DB::table('password_resets')->where(['email' => $email])->delete();


                return redirect()->to(route('login'))->with('success', "Password reset success");

 


    }
    



}


