@extends('layouts.app')
@section('title'){{$user->name}}@endsection
@section('content')

<div class="profile_page">
    <div class="container">
        <div class="profile_section">

            <div class="profile_header">
                <div class="profile_header_image">
                    @if($user->profile->image)
                        <img src="{{asset('uploads/profile')}}/{{$user->profile->image}}" alt="">
                    @else
                        <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="">
                    @endif
                </div>
                <div class="profile_header_info">
                    <div class="name_info">
                        <h3>{{$user->username}}</h3>
                        @if(auth::user()->id == $user->id)
                        <a href="/profile/{{$user->id}}/edit"><button class="btn btn-light">Edit profile</button></a>
                        @else
                            @if(!$user->profile->followedBy(auth()->user()))
                                <div style="margin-right:10px;">
                                    <form action="{{route('user.following',$user->id)}}" method="post">
                                        @csrf
                                        <button type="submit"class="btn btn-primary btn-sm">follow</button>
                                    </form>
                                </div>
                            @else
                                <div style="margin-right:200px;">
                                    <form action="{{route('user.unfollow',$user->profile->id)}}" method="post">
                                        @csrf
                                        <button type="submit"class="btn btn-dark btn-sm">Unfollow</button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        <a href="/setting"><button class="btn btn-secondary p-2" style="margin-left:45px;">Setting</button></a>

                    </div>
                    <div class="post_follower_info">
                        <p><strong>{{$user->posts->count() ?? null}} </strong> posts</p>
                        <p><strong>{{$user->profile->follow->count() ?? null}} </strong> followers</p>
                        <p><strong>{{$user->following->count() ?? null}} </strong> following</p>
                    </div>
                    <div class="caption_info">
                        <h4>{{$user->name}}</h4>
                        <p>{{$user->profile->title}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="post_section">
            <div class="add_post_div">
                <p class="post_section_p">posts</p>
                @if(auth::user()->id == $user->id)
                    <a href="/addpost"><button class="btn btn-light">add post</button></a>
                @endif

            </div>

            <div class="post_image_section">
                @foreach($user->posts as $post)
                    <div class="single_post">
                        <div class="single_post_image">
                            <img src="{{asset('uploads/posts/')}}/{{$post->image}}" alt="upload-image">
                        </div>
                        <div class="single_post_like">
                            @if(!$post->likedBy(auth::user()))
                                <form action="/post/{{$post->id}}/like" method="post">
                                    @csrf
                                    <button type="submit" class="fa-regular fa-heart" style="border:none;font-size:25px;"> </button>
                                    <a href="/post/comment/{{$post->id}}"><i class="fa-regular fa-comment"></i></a>
                                    <i class="fa-regular fa-paper-plane"></i>
                                    <a href="{{route('post.edit',$post->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                </form>
                            @else
                                <form action="/post/{{$post->id}}/unlike" method="post">
                                @csrf
                                    <button type="submit"  class="fa-regular fa-heart red" style="border:none;font-size:25px;color:red;"> </button>
                                    <a href="/post/comment/{{$post->id}}"><i class="fa-regular fa-comment"></i></a>
                                    <i class="fa-regular fa-paper-plane"></i>
                                    <a href="{{route('post.edit',$post->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                </form>
                            @endif

                        </div>
                        <div class="like_count">
                            @if($post->like->count()==0)
                                <p>no one like this</p>
                            @elseif($post->like->count() == 1 && $post->likedBy(auth::user()))
                                <p>you <span style="color:red;">liked </span> this</p>
                            @elseif($post->like->count() ==2 && $post->likedBy(auth::user()))
                                <p>you and {{$post->like->count()-1}} other <span style="color:red;">liked </span> this </p>
                            @else
                                <p>{{$post->like->count()}} likes</p>
                            @endif
                        </div>

                        <div class="comment_count" style="margin-bottom:5px;">
                            @if($post->comment->count()==0)
                                <p><a href="/post/comment/{{$post->id}}">no comment yet </a></p>
                            @elseif($post->comment->count() == 1)
                                <p><a href="/post/comment/{{$post->id}}">1 comment only </a></p>

                            @else
                                <p><a href="/post/comment/{{$post->id}}">{{$post->comment->count()}} comments </a></p>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

</div>


{{-- this part is for mobile users --}}
<div class="phone_view">
   <!-- Example split danger button -->
   <div class="phone_view_header">
        <div class="btn-group front_header_content">
            <button type="button" class="instagram_button">Instagram</button>
            <button type="button" class="dropdown-toggle dropdown-toggle-split instagram_button_droupdown" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu droupdown_ul">
                <li class="droupdown_li"><a class="dropdown-item" href="#">Action</a></li>

                @if(auth::user()->id == $user->id)
                    <li class="droupdown_li"><a class="dropdown-item" href="/profile/{{$user->id}}/edit">Edit Profile</a></li>
                    <li class="droupdown_li"><a class="dropdown-item" href="/addpost">Add post</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="phone_header">


        <div class="p_h_profile_pic">
           <div class="main_p_pic">
            @if($user->profile->image)
                <img src="{{asset('uploads/profile')}}/{{$user->profile->image}}" alt="">
            @else
                <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="">
            @endif
           </div>

        </div>
        <div class="p_h_profile_info">
            <div class="posts_info"><p><h6>{{$user->posts->count()}} </h6> posts</p></div>
            <div class="follow_info"> <p><h6>{{$user->profile->follow->count()}} </h6> followers</p></div>
            <div class="followers_info"><p><h6>{{$user->following->count()}} </h6> following</p></div>

        </div>
    </div>
    <div class="p_h_bio">
        <div class="bio_content">
            <h4>{{$user->name}}</h4>
            <p>{{$user->profile->title}}</p>
        </div>
        <div class="follow_content">
            @if(auth::user()->id == $user->id)

            @else
                @if(!$user->profile->followedBy(auth()->user()))
                    <div style="margin-right:10px;">
                        <form action="{{route('user.following',$user->id)}}" method="post">
                            @csrf
                            <button type="submit"class="btn btn-primary btn-sm m-3">follow</button>
                        </form>
                    </div>
                @else
                    <div style="margin-right:200px;">
                        <form action="{{route('user.unfollow',$user->profile->id)}}" method="post">
                            @csrf
                            <button type="submit"class="btn btn-dark btn-sm m-3">Unfollow</button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="phone_profile_body">
        <h5>posts</h5>
        <div class="p_h_profile_images">
            @foreach($user->posts as $post)
                <div class="p_h_single_post">
                    <div class="p_h_single_post_image">
                        <img src="{{asset('uploads/posts')}}/{{ $post['image'] }}" alt="">
                    </div>
                    <div class="p_h_single_post_like">
                        @if(!$post->likedBy(auth::user()))
                            <form action="/post/{{$post->id}}/like" method="post">
                                @csrf
                                <button type="submit"  class="fa-regular fa-heart" style="border:none;font-size:17px;margin-right:17px;"> </button>
                                <i class="fa-regular fa-comment"></i>
                                <i class="fa-regular fa-paper-plane"></i>
                                <a href="{{route('post.edit',$post->id)}}" class="edit-btn"><i class="fa-solid fa-pen-to-square "></i></a>
                            </form>
                        @else
                            <form action="/post/{{$post->id}}/unlike" method="post">
                            @csrf
                                <button type="submit"  class="fa-regular fa-heart red" style="border:none;font-size:17px;margin-right:17px;color:red;"> </button>
                                <a href="/post/comment/{{$post->id}}"><i class="fa-regular fa-comment"></i></a>
                                <i class="fa-regular fa-paper-plane"></i>
                                <a href="{{route('post.edit',$post->id)}}" class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                            </form>
                        @endif

                    </div>
                    <div class="p_h_like_count">
                        @if($post->like->count()==0)
                            <p>no one like this</p>
                        @elseif($post->like->count() == 1 && $post->likedBy(auth::user()))
                            <p>you <span style="color:red;">liked </span> this</p>
                        @elseif($post->like->count() ==2 && $post->likedBy(auth::user()))
                            <p>you and {{$post->like->count()-1}} other <span style="color:red;">liked </span> this </p>
                        @else
                            <p>{{$post->like->count()}} likes</p>
                        @endif
                    </div>

                    <div class="p_h_comment_count" style="margin-bottom:5px;">
                        @if($post->comment->count()==0)
                            <p><a href="/post/comment/{{$post->id}}" style="font-size:14px;">no comment yet </a></p>
                        @elseif($post->comment->count() == 1)
                            <p><a href="/post/comment/{{$post->id}}" style="font-size:14px;">1 comment only </a></p>

                        @else
                            <p><a href="/post/comment/{{$post->id}}" style="font-size:14px;">{{$post->comment->count()}} comments </a></p>
                        @endif
                    </div>
                </div>

            @endforeach

        </div>
    </div>

</div>

@endsection


