@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="margin:auto;">
          
        @foreach($post as $name)
        
            <h3>{{$name->user_id}}</h3>
            <h3>{{$name->caption}}</h3>
            <img style="width:300px;height:250px;"src="storage/{{$name->image}}" alt="">
           
            @endforeach
        </div>
     </div>
</div>
@endsection
