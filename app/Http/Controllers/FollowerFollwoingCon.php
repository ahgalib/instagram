<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use Auth;
class FollowerFollwoingCon extends Controller
{
    function store(User $user,Request $req){
       // dd($user->followedBy($req->user()));
        Follower::create([
            'user_id' => auth::user()->id,
            'profile_id'=>$req->profile->id,
        ]);
        return back();
    }

    function unfollow(Request $req,$profile){
        // dd($user->followedBy($req->user()));
        Follower::where('profile_id',$profile)->delete();
         return back();
     }
}
