@extends('layouts.app')
@section('title'){{'ImageFeed'}}@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="">
                <div class="form-group">
                    <input type="text" name="search" placeholder="search" value="{{$search}}" style="border-radius:10px;">
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
                                <p>you and {{$posts->like->count()}} other Like   </p>
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
</div>
@endsection
