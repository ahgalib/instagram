@extends('layouts.app')
@section('title'){{'ImageFeed'}}@endsection

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="">
                <div class="form-group">
                    <input type="text" name="search" placeholder="search" value="" style="border-radius:10px;">
                    <button class="btn btn-primary btn-sm" style="border-radius:10%;">Search</button>
                </div>
            </form>
        </div>
     </div>
    <div class="row">
        @foreach($post as $posts)
            <div class="col-md-5 m-3 text-center" style="margin:auto;">
                <div class="card">
                    <div class="card-header d-flex">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <div style="">
                                    <a href="/user/{{$posts->user->id}}"><img class="rounded-circle"src="/storage/{{$posts->user->profile->image}}" style="width:60px;height:50px";></a>
                                </div>
                                <div style="margin-left:30px;margin-top:10px;">
                                    <h5>{{$posts->user->name}}</h5>
                                </div>
                                <div style="margin-left:50px;margin-top:10px;">
                                    <small>share this post on {{$posts->created_at->format('M d, Y')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <div class="col-md-12 mt-4">
                                <h3>{{$posts->caption}}</h3>
                            </div>
                            <div class="col-md-12 mt-3">
                                <img style="width:300px;height:250px;"src="storage/{{$posts->image}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-footer">
                            <div class="d-flex text-center">
                                @if(!$posts->likedBy(auth::user()))
                                <form action="/post/{{$posts->id}}/like" method="post">
                                    @csrf
                                    <button type="submit"  class="fa-solid fa-heart" style="border:none;font-size:25px;"> </button>
                                </form>
                                <strong>{{$posts->like->count()}} Like</strong>
                                @else
                                    @if($posts->like->count()<=1)
                                        <p>you Like this</p>
                                    @else
                                        <p>you and {{$posts->like->count()-1}} other Like   </p>
                                    @endif
                                <form action="/post/{{$posts->id}}/unlike" method="post">
                                @csrf
                                    <button type="submit"  class="fa-solid fa-thumbs-down bg" style="border:none;font-size:25px;margin-left:190px;"> </button>unlike
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- paginate -->
        {{$post->links()}}
     </div>
</div> --}}



<div class="newsfeed_section">
    @foreach($post as $posts)
        <div class="main_seciton">
            <div class="header_section">
                <a href="/user/{{$posts->user->id}}"><img src="/storage/{{$posts->user->profile->image}}" alt="" class="profile_image"></a>
                <a href="/user/{{$posts->user->id}}"><h3>{{$posts->user->name}}</h3></a>
                <p> {{$posts->created_at->diffForHumans()}}</p>
            </div>
            <div class="body_section">
                <img src="storage/{{$posts->image}}" alt="" class="upload_image">
            </div>
            <div class="footer_section">
                <div class="like_part">
                    @if(!$posts->likedBy(auth::user()))
                        <form action="/post/{{$posts->id}}/like" method="post">
                            @csrf
                            <button type="submit"  class="fa-regular fa-heart" style="border:none;font-size:25px;margin-right:30px;"> </button>
                        </form>
                    @else
                        <form action="/post/{{$posts->id}}/unlike" method="post">
                        @csrf
                            <button type="submit"  class="fa-regular fa-heart red" style="border:none;font-size:25px;color:red;margin-right:30px;"> </button>
                        </form>
                    @endif
                    <a href="/post/comment/{{$posts->id}}"><i class="fa-regular fa-comment"></i></a>
                    <i class="fa-regular fa-paper-plane"></i>
                </div>
                <div class="like_count">
                    @if($posts->like->count()==0)
                        <p>no one like this</p>
                    @elseif($posts->like->count() == 1 && $posts->likedBy(auth::user()))
                        <p>you <span style="color:red;">liked </span> this</p>
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
                        <p><a href="/post/comment/{{$posts->id}}"> comment only </a></p>
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
