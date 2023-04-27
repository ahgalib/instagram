<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class NewsfeedCon extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
        $search = $request['search'];
        if($search != ""){
            $post = Post::where('caption','LIKE',"%$search%")->paginate(4);
        }else{
            $post = Post::all();
        }

        return view('imagefeed',['post'=>$post,'search'=>$search]);
    }

}
