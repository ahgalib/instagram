<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

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
    function createPost(Request $req){
        $data = request()->validate([
            'caption'=>'required',
            'image'=>'required',
        ]);
        $imagePath = request('image')->store('uploads','public');
        $req->user()->posts()->create([
            'caption'=>$data['caption'],
             'image'=>$imagePath,
        ]);
        //$post->image = $req->file('image')->store('uploads','public');
      
        return redirect('user/'.auth()->user()->id);
      
    }
    
}
