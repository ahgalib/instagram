
@extends('layouts.app')
@section('title'){{$post->user->name.'/image'}}@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="/storage/{{$post->image}}" style="width:600px;height:500px;">
        </div>
        <div class="col-md-4" style="margin-left:-100px;margin-top:100px;">
            <div class="d-flex">
                <div>
                    <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle"style="width:100px;height:70px;">
                </div>
                <div style="margin-top:16px;margin-left:10px;">
                    <h4>{{$post->user->name}}</h4>
                </div>
            </div>
            <div style="margin-top:16px;">
            <p></span><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a> </span>{{$post->caption}}</p>
            </div>
        </div>
        

    </div>
    
 
</div>
@endsection
