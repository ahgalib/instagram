
@extends('layouts.app')

@section('content')
<div class="container">
   <form action="/profile/{{$user->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-md-8 m-2">
                <h2>Edit your profile</h2>
                <div class="form-group row m-3">
                    Enter caption for your title
                    <label for="description" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input id="title" type="text" name="title"class="form-control @error('title') is-invalid @enderror"value="{{old('title')?? $user->profile->title}}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row m-3">
                    Enter caption for your description
                    <label for="description" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input id="description" type="text" name="description"class="form-control @error('description') is-invalid @enderror"value="{{old('description') ?? $user->profile->description}}">

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row m-3">
                    Enter caption for your url
                    <label for="url" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input id="url" type="text" name="url"class="form-control @error('url') is-invalid @enderror"value="{{old('url')?? $user->profile->url}}">

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- image -->
                <div class="form-group row m-3">
                    Enter  your profile image
                    <label for="image" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <span style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <button type="submit"class="btn btn-danger m-3">Save Profile</button>
            </div>    
            
        </div>
   </form>
</div>
@endsection
