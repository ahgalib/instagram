<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class CommentCon extends Controller
{
    public function show(Post $post){
        $comments = Comment::with('replies')->where('post_id',$post->id)->whereNull('parent_id')->get();
        //echo"<pre>";print_r($comments);die;
        return view('comment',compact('post','comments'));
    }

    public function create(Request $request){
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);
        return back();
    }
}
