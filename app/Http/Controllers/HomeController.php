<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user){
        $user = User::find($user);
       return view('home',['user'=>$user]);

    }
   function createPost(Request $request){
       $data = $request->validate([
           'caption'=>'required',
           'image'=>'required|image|mimes:jpeg,png,jpg',
       ]);
      // $imagePath = request('image')->store('uploads','public');
       $upload_file = $request->image;
       $extension = $upload_file->getClientOriginalExtension();
       $file_name = rand(00000,88888).'.'.$extension;
        Image::make($upload_file)->save(public_path('uploads/posts/'.$file_name));
       $request->user()->posts()->create([
           'caption'=>$data['caption'],
            'image'=>$file_name,

       ]);
       //$post->image = $req->file('image')->store('uploads','public');

       return redirect('user/'.auth()->user()->id);

   }
}
