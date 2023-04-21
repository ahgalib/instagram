<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ProfileCon extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function edit(User $user){
        $this->authorize('update',$user->profile);
        return view('addpost.editpost',compact('user'));
    }
    public function update(User $user){
        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'required',
            'image'=>'',

        ]);
        if(request('image')){
            $imagePath = request('image')->store('profile','public');
            $imageArray = ['image'=>$imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));
        //auth()->user()->profile->update($data);
        return redirect('user/'.auth()->user()->id);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
