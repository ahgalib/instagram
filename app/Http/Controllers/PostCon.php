<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Auth;
use Image;

class PostCon extends Controller
{
    public function index(){
        return view('post.post');
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

    public function ajax_like(Request $request){
        //echo "heooloow this is wokrj";
        Like::create([
            'user_id'=>Auth::id(),
            'post_id'=>$request->postId,
        ]);

        $unlike = '<button type="submit" class="fa-regular fa-heart red unlike" data-post="{{$posts->id}}" style="border:none;font-size:25px;color:red;margin-right:30px;"></button>';
        // $unlike .= 'you <span style="color:red;">liked </span> this';
        echo $unlike;
        //echo $like_count;

    }

    public function show_edit_page($id){
        $post = Post::find($id);
        return view('post.editpost',compact('post'));
    }

    public function save_edit_post(Request $request,$id){
        $data = request()->validate([
            'caption'=>'required',
            'image'=>'image|mimes:jpg,png,jpeg',

        ]);


        if(request('image')){

            //check if old image is exist or not
            $find_image = Post::where('id', $id)->first();
            if ($find_image['image']) {
                $image = $find_image['image'];
                $image_path = public_path('uploads/posts/'.$image);
                //delete old image
                unlink($image_path);
            }

            $upload_file = $request->image;
            $extension = $upload_file->getClientOriginalExtension();
            $image_name = rand(000000,999999).'.'.$extension;
            Image::make($upload_file)->save(public_path('uploads/posts/'.$image_name));


            Post::where('id',$id)->update([
                'caption' => $request->caption,
                'image' => $image_name,
            ]);

        }else{
            Post::where('id',$id)->update([
                'caption' => $request->caption,
            ]);
        }

        return redirect('user/'.auth()->user()->id);
    }

}
