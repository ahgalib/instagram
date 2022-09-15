<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;

class PostCon extends Controller
{
    public function index(){
        return view('addpost.post');
    }
    public function show(Post $post){
        return view('show',compact('post'));
    }

    public function like($id,Request $request,Post $post){
        //dd($post->likedBy($id));
        Like::create([
            'user_id'=>$request->user()->id,
            'post_id'=>$id,
        ]);
        return redirect()->back();
    }

    public function unlike($id,Request $request){
        $request->user()->like()->where('post_id',$id)->delete();
        return redirect()->back();
    }
    
}
