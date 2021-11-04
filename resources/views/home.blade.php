@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 ml-3">
             <div style="margin-left:90px;">
                 <img class="rounded-circle"src="/storage/{{$user->profile->image}}" style="width:190px;height:170px">
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex">
                <div style="margin-right:30px;"><h3 style="font-family:Ravie">{{$user->name}}</h3></div>
                @if($user->followedBy(auth()->user()))
                    <div style="margin-right:10px;">
                        <form action="{{route('user.following',$user->id)}}" method="post">
                            @csrf
                            <button type="submit"class="btn btn-primary btn-sm">follow</button>
                        </form>
                    </div>
                @else
                    <div style="margin-right:200px;">
                        <form action="" method="post">
                            @csrf
                            <button type="submit"class="btn btn-dark text-light btn-sm">Unfollow</button>
                        </form>
                    </div>
                @endif
                <div>
                    @can('update',$user->profile)
                        <button class="btn btn-success p-2"><a style="color:white;text-decoration:none;font-family:Tempus Sans ITC;"href="/addpost">Add new post</a></button>
                    @endcan
                </div>
            </div>
            <div class="d-flex">
                <div style="margin-right:30px;font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->posts->count()}} </strong>posts</div>
                <div style="margin-right:30px;font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->following->count()}}k </strong>follower</div>
                <div style="font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->profile->follow->count()}} </strong>following</div>
            </div>
            <div>
                @can('update',$user->profile)
                    <button class="btn btn-warning btn-sm m-2"><a style="color:black;font-weight:bold;text-decoration:none;font-family:Tempus Sans ITC;"href="/profile/{{$user->id}}/edit">Edit Porfile</a></button>
                @endcan
            </div>
            <div class="mt-2"><a style="font-weight:bold;font-family:Tempus Sans ITC;"href="">{{$user->profile->url}}</a></div>
            <div>
                <p style="font-weight:bold">{{$user->profile->title}}</p>
            </div>
            <div class="">
                <p style="font-family:Comic Sans MS;">{{$user->profile->description}}</p>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        @foreach($user->posts as $post)
            <div class="col-md-4 mb-5">
                <a href="/p/{{$post->id}}">
                <img src="/storage/{{ $post['image'] }}" style="width:350px;height:360px;">
                </a>
                <p style="font-size:22px;font-family:Forte;">{{$post->caption}}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
