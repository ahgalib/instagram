<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostCon extends Controller
{
    public function index(){
        return view('addpost.post');
    }
    public function show(Post $post){
        return view('show',compact('post'));
    }
    
}
