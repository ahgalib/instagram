<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class FollowerFollwoingCon extends Controller
{
    function store(User $user,Request $req){
       // dd($user->followedBy($req->user()));
        $user->follow()->create([
            'profile_id'=>$req->user()->id,
        ]);
        return back();
    }
}
