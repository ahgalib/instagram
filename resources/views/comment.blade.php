@extends('layouts.app')
@section('title'){{'Comment'}}@endsection

@section('content')
    <div class="comment_section">
        <div class="comment_content">
            <div class="header_section">
                <a href="/user/{{$post->user->id}}"><img src="/storage/{{$post->user->profile->image}}" alt="" class="profile_image"></a>
                <a href="/user/{{$post->user->id}}"><h3>{{$post->user->name}}</h3></a>
                <p> {{$post->created_at->diffForHumans()}}</p>
            </div>
            <div class="body_section">
                <img src="/storage/{{$post->image}}" alt="" class="comment_upload_image">
            </div>
            <div class="footer_section">
                <div class="like_part">
                    @if(!$post->likedBy(auth::user()))
                        <form action="/post/{{$post->id}}/like" method="post">
                            @csrf
                            <button type="submit"  class="fa-regular fa-heart" style="border:none;font-size:25px;margin-right:30px;"> </button>
                        </form>
                    @else
                        <form action="/post/{{$post->id}}/unlike" method="post">
                        @csrf
                            <button type="submit"  class="fa-regular fa-heart red" style="border:none;font-size:25px;color:red;margin-right:30px;"> </button>
                        </form>
                    @endif
                    <a href="/post/comment/{{$post->id}}"><i class="fa-regular fa-comment"></i></a>
                    <i class="fa-regular fa-paper-plane"></i>
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
                <div class="caption_section">
                    <h4>{{$post->user->name}}</h4>
                    <p>{{$post->caption}}</p>
                </div>
                <div class="comment_area">

                    <div class="comment_user_profile">
                        <a href="/user/{{$post->user->id}}"><img src="/storage/{{$post->user->profile->image}}" alt="" class="comment_profile_image"></a>
                    </div>
                    <form action="{{route('comment.create')}}" method="post">
                        @csrf
                        <div class="comment_input">
                            <input type="hidden" name="post_id" value={{$post->id}}>
                            <input type="text" class="comment_input" name="comment" placeholder="leave a comment">
                            <button class="btn-comment">comment</button>
                        </div>
                    </form>
                </div>
                <div>
                    <h5>{{$comments->count()}} Comment </h5>
                </div>
                @foreach ($comments as $comment)
                    <div class="show_comment_area">
                        <div class="comment_user_profile">
                            <a href="/user/{{$comment->user->id}}"><img src="/storage/{{$comment->user->profile->image}}" alt="" class="comment_profile_image"></a>
                        </div>

                        <form action="{{route('comment.create')}}" method="post">
                            @csrf
                            <div class="comment_body">
                                <div class="comment_header">
                                    <h5>{{$comment->user->name}}</h5>
                                    <p>{{$comment->comment}}</p>
                                </div>
                                <a href="#reply" class="reply" data-parent={{$comment->id}}>reply</a>
                            </div>
                    </div>
                    @foreach ($comment->replies as $reply)
                        <div class="show_comment_area" style="margin-left:60px">
                            <div class="comment_user_profile">
                                <a href="/user/{{$reply->user->id}}"><img src="/storage/{{$reply->user->profile->image}}" alt="" class="comment_profile_image"></a>
                            </div>

                            {{-- comment er jaygay duita foreach ace ekta comment show korbe r ekta oi comment er reply show korbe,kintu form ace ektai..comment create er form r reply er form ektai --}}
                                <div class="comment_body">
                                    <div class="comment_header">
                                        <h5>{{$reply->user->name}}</h5>
                                        <p>{{$reply->comment}}</p>
                                    </div>
                                    <a href="#reply" class="reply" data-parent={{$comment->id}}>reply</a>
                                </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="reply-div" id="reply">
                    <input type="hidden" name="post_id" value={{$post->id}}>
                    <input type="text" name="parent_id" class="parent">
                    <input type="text" name="comment" placeholder="reply">
                    <button>submit</button>
                </div>
                            </form>
                            {{-- ai from ta srart hoise line 69 a --}}
                </div>
            </div>


    </div>
@endsection
