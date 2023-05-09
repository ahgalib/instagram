<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Auth;
use Image;
class ProfileCon extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function create_profile(){
        return view('profile.create_profile');
    }

    public function save_create_profile(Request $request){
        $data = request()->validate([
            'title'=>'required',
            'image'=>'',
        ]);

        if($request->image){
            $upload_file = $request->image;
            $extension = $upload_file->getClientOriginalExtension();
            $image_name = rand(000000,999999).'.'.$extension;
            Image::make($upload_file)->resize(200,250)->save(public_path('uploads/profile/'.$image_name));
        }else{
            $image_name = '';
        }

        Profile::create([
            'user_id' => auth::id(),
            'title' => $request->title,
            'url' => 'ginsta.top'.'/'.Auth::user()->username,
            'image' => $image_name,
        ]);

        return redirect('user/'.auth()->user()->id);
    }

    public function edit(User $user){
        // root model binding
        return view('profile.editprofile',compact('user'));
    }

    public function update($id,Request $request){
        $data = request()->validate([
            'title'=>'required',
            'description'=>'',
            'image'=>'',

        ]);
        if(request('image')){

            //check if old image is exist or not
            $find_image = Profile::where('user_id', $id)->first();
            if ($find_image['image']) {
                $image = $find_image['image'];
                $image_path = public_path('/uploads/profile/'. $image);
                //delete old image
                unlink($image_path);
            }

            $upload_file = $request->image;
            $extension = $upload_file->getClientOriginalExtension();
            $image_name = rand(000000,999999).'.'.$extension;
            Image::make($upload_file)->resize(200,250)->save(public_path('uploads/profile/'.$image_name));


            Profile::where('user_id',$id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $image_name,
            ]);

        }else{
            Profile::where('user_id',$id)->update([
                'title' => $request->title,
                'description' => $request->description,

            ]);
        }

        return redirect('user/'.auth()->user()->id);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
