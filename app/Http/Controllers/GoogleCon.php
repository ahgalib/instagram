<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Hash;
use Auth;

class GoogleCon extends Controller
{
    public function redirect_to_provider(){
        return Socialite::driver('google')->redirect();
    }

    public function provider_to_application(){
        $user = Socialite::driver('google')->user();
         //print_r($user);die;
        // echo $user->name;
        if(User::where('email',$user->getEmail())->exists()){
            if(Auth::attempt(['email' => $user->getEmail(), 'password' => 'github@123%33*all'])){
                return redirect('/imagefeed');
            }
        }else{
            User::create([
                'name' => $user->getName(),
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make('github@123%33*all'),
            ]);

            if(Auth::attempt(['email'=>$user->getEmail(), 'password'=>'github@123%33*all'])){
                return redirect('/imagefeed');
            }
        }
    }
}
