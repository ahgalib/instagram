@extends('layouts.app')
@section('title'){{$user->name}}@endsection
@section('content')

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-4 ml-3">
             <div style="margin-left:90px;">
                 <img class="rounded-circle"src="/storage/{{$user->profile->image}}" style="width:190px;height:170px">
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex">
                <div style="margin-right:30px;"><h3 style="font-family:Ravie">{{$user->name}}</h3></div>
                @if(auth::user()->id == $user->id)
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
                            <form action="{{route('user.unFollow',auth()->user()->id)}}" method="post">
                                @csrf
                                <button type="submit"class="btn btn-dark text-light btn-sm">Unfollow</button>
                            </form>
                        </div>
                    @endif
                @endif
                <div>
                    @can('update',$user->profile)
                        <button class="btn btn-success p-2 ml-3"><a style="color:white;text-decoration:none;font-family:Tempus Sans ITC;"href="/addpost">Add new post</a></button>
                    @endcan
                </div>
                <div>
                    @if(Auth::user()->profile->id === $user->id)
                        <button class="btn btn-secondary p-2" style="margin-left:45px;"><a style="color:white;text-decoration:none;font-family:Tempus Sans ITC;"href="/setting">Setting</a></button>
                    @endif
                </div>
            </div>
            <div class="d-flex">
                <div style="margin-right:30px;font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->posts->count()}} </strong>posts</div>

                <a href="{{route('seeFollowers',$user->profile->id)}}" style="text-decoration:none;color:black;">
                    <div style="margin-right:30px;font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->profile->follow->count()}} </strong>followers</div>
                </a>

                <a href="{{route('seeFollowing',$user->id)}}" style="text-decoration:none;color:black;">
                    <div style="font-family:Lucida Calligraphy"class="pr-3"><strong>{{$user->following->count()}} </strong>following</div>
                </a>
            </div>
            <div>
                @can('update',$user->profile)
                    <button class="btn btn-warning btn-sm m-2"><a style="color:black;font-weight:bold;text-decoration:none;font-family:Tempus Sans ITC;"href="/profile/{{$user->id}}/edit">Edit Porfile</a></button>
                @endcan
            </div>
            <div class="mt-2">
                <a style="font-weight:bold;font-family:Tempus Sans ITC;"href="">{{$user->profile->url}}</a>
            </div>
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
</div> --}}

<div class="profile_page">
    <div class="profile_section">
        <div class="container">
            <div class="profile_header">
                <div class="profile_header_image">
                    <img src="/storage/{{$user->profile->image}}" alt="">
                </div>
                <div class="profile_header_info">
                    <div class="name_info">
                        <h3>{{$user->username}}</h3>
                        <button>Edit profile</button>
                        <p>More</p>
                    </div>
                    <div class="post_follower_info">
                        <p><strong>6 </strong> posts</p>
                        <p><strong>6 </strong> follow</p>
                        <p><strong>6 </strong> follower</p>
                    </div>
                    <div class="caption_info">
                        <h3>{{$user->name}}</h3>
                        <p>{{$user->profile->title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="post_section">
        <div class="container">
            <p class="post_section_p">post</p>
            <div class="post_image_section">
                @foreach($user->posts as $post)
                <img src="/storage/{{ $post['image'] }}" alt="">
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
