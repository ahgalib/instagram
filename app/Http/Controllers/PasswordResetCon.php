<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPasswordReset;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordResetNotification;
use Hash;

class PasswordResetCon extends Controller
{
    public function forget_password(){
        return view('auth.passwords.reset');
    }

    public function forget_password_email_send(Request $request){
        $user_info = User::where('email',$request->email)->firstOrFail();
        //echo $user_info;
        UserPasswordReset::where('user_id',$user_info->id)->delete();
        $new_user_inserted = UserPasswordReset::create([
            'user_id' => $user_info->id,
            'token' => uniqid(),
        ]);

        Notification::send($user_info, new PasswordResetNotification($new_user_inserted));

        return back()->with('success','password reset link send successfully');
    }

    public function reset_password_form($token){
        return view('passReset.updatePasswordForm',[
            'token'=>$token
        ]);
    }

    public function set_new_password(Request $request){
        $pass_reset_info = UserPasswordReset::where('token',$request->token)->first();
        if($pass_reset_info){
            $request->validate([
                'password'=>'required|confirmed',
            ]);
            User::where('id',$pass_reset_info->user_id)->update([
                'password'=>Hash::make($request->password)
            ]);

            $pass_reset_info->delete();
            return redirect()->route('login')->with('success','Your New password set successfully..You can login with your new password');
        }else{
            return back()->with('error','Your link hasbeen expired...please try a new link');
        }

    }
}
