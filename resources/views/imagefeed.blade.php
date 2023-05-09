@extends('layouts.app')
@section('title'){{'ImageFeed'}}@endsection

@section('content')

<div class="header-responsive">
    <div class="logo">
        <p><a href="/">Instagram</a></p>
    </div>
    <div class="icon">
        <ul>
            <li><i class="fa-regular fa-message"></i></li>
            <li><i class="fa-regular fa-heart"></i></li>
        </ul>
    </div>
</div>

<div class="newsfeed_section">

    @foreach($post as $posts)
        <div class="main_seciton">
            <div class="header_section">
                @if($posts->user->profile->image)
                    <a href="/user/{{$posts->user->id}}"><img src="{{asset('uploads/profile')}}/{{$posts->user->profile->image}}" alt="" class="profile_image"></a>
                @else
                    <img src="{{ Avatar::create($posts->user->name)->toBase64() }}" alt="" class="profile_image">
                @endif
                <a href="/user/{{$posts->user->id}}"><h3>{{$posts->user->name}}</h3></a>
                <p> {{$posts->created_at->diffForHumans()}}</p>
            </div>
            <div class="body_section">
                <img src="{{asset('uploads/posts')}}/{{$posts->image}}" alt="" class="upload_image">
            </div>
            <div class="footer_section">
                <div class="like_part">
                    @if(!$posts->likedBy(auth::user()))
                        <form action="/post/{{$posts->id}}/like" method="post">
                            @csrf
                                <button type="submit"  class="fa-regular fa-heart" data-post="{{$posts->id}}" style="border:none;font-size:25px;margin-right:30px;"> </button>
                        </form>
                    @else
                        <form action="/post/{{$posts->id}}/unlike" method="post">
                        @csrf
                            <button type="submit"  class="fa-regular fa-heart red" data-post="{{$posts->id}}" style="border:none;font-size:25px;color:red;margin-right:30px;"> </button>

                        </form>
                    @endif
                    <a href="/post/comment/{{$posts->id}}"><i class="fa-regular fa-comment"></i></a>
                    <i class="fa-regular fa-paper-plane"></i>
                </div>
                <div class="like_count">
                    @if($posts->like->count()==0)
                        <p>no one like this</p>
                    @elseif($posts->like->count() == 1 && $posts->likedBy(auth::user()))
                        <p class="normal-like">you <span style="color:red;">liked </span> this</p>

                    @elseif($posts->like->count() ==2 && $posts->likedBy(auth::user()))
                        <p>you and {{$posts->like->count()-1}} other <span style="color:red;">liked </span> this </p>
                    @else
                        <p>{{$posts->like->count()}} likes</p>
                    @endif
                </div>
                <div class="caption_section">
                    <h4>{{$posts->user->name}}</h4>
                    <p>{{$posts->caption}}</p>
                </div>
                <div class="view_comment">
                    @if($posts->comment->count() == 0)
                        <p>No comments yet</p>
                    @elseif($posts->comment->count() == 1)
                        <p><a href="/post/comment/{{$posts->id}}">1 comment only </a></p>
                    @else
                        <p><a href="/post/comment/{{$posts->id}}"> View all {{$posts->comment->count()}} comments </a></p>
                    @endif
                    <p>Add a comment</p>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
