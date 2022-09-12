<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class NewsfeedCon extends Controller
{
    public function index(){
        $post = Post::get();
        return view('imagefeed',['post'=>$post]);
    }
    
}
