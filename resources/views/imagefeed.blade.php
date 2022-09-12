@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($post as $posts)
            <div class="col-md-5 m-3 text-center" style="margin:auto;">
                <div class="card">
                    <div class="card-header d-flex">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <div style="">
                                    <img class="rounded-circle"src="/storage/{{$posts->user->profile->image}}" style="width:60px;height:50px";>
                                </div>
                                <div style="margin-left:30px;margin-top:10px;">
                                    <h5>{{$posts->user->name}}</h5>
                                </div>
                                <div style="margin-left:50px;margin-top:10px;">
                                    <p>{{$posts->created_at->format('M d, Y')}}</p>
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
                            <p>Like <i class="fa-solid fa-heart"></i></p>
                        </div>
                    </div>    
                </div>
            </div>
        @endforeach
        
     </div>
</div>
@endsection
