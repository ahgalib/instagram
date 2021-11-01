@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 ml-3">
             <div style="margin-left:90px;">
                 <img class="rounded-circle"src="/image/IMG_20210818_164126.jpg" style="width:150px;height:150px">
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex">
                <div style="margin-right:200px;"><h3>{{$user->name}}</h3></div>
                <div>
                    <button class="btn btn-primary"><a style="color:white;text-decoration:none;"href="/addpost">Add new post</a></button>
                </div>
            </div>
            <div class="d-flex">
                <div style="margin-right:30px;"class="pr-3"><strong>{{$user->posts->count()}} </strong>posts</div>
                <div style="margin-right:30px;"class="pr-3"><strong>22k </strong>follower</div>
                <div class="pr-3"><strong>155 </strong>following</div>
            </div>
            <div>
                <button class="btn btn-warning btn-sm m-2"><a style="color:black;font-weight:bold;text-decoration:none;"href="/profile/{{$user->id}}/edit">Edit Porfile</a></button>
            </div>
            <div class="mt-2"><a style="font-weight:bold;"href="">{{$user->profile->url}}</a></div>
            <div>
                <p style="font-weight:bold">{{$user->profile->title}}</p>
            </div>
            <div class="">
                <p>{{$user->profile->description}}</p>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        @foreach($user->posts as $post)
            <div class="col-md-4">
                <p>{{$post->caption}}</p>
                <img src="/storage/{{ $post['image'] }}">
            </div>
        @endforeach
    </div>
</div>
@endsection
