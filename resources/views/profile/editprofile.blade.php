@extends('layouts.app')
@section('title'){{'Edit Post'}}@endsection

@section('content')
<div class="container edit_container">
   <form action="/profile/{{$user->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center mt-5">
            <div class="col-md-10 m-2">
                <h2>Edit your profile</h2>
                <div class="form-group row m-3">
                    Enter title
                    <label for="title" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
                        <input id="title" type="text" name="title"class="form-control @error('title') is-invalid @enderror"value="{{old('title')?? $user->profile->title}}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row m-3">
                    Enter description for your profile (optional)
                    <label for="description" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
                        <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">
                            {{old('description') ?? $user->profile->description}}
                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- image -->
                <div class="form-group row m-3">
                    Enter  your profile image
                    <label for="image" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
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

<div class="responsive_container mt-5">
    <form action="/profile/{{$user->id}}" method="post" enctype="multipart/form-data">
    @csrf
         @method('PATCH')
        <div class="responsive_edit_content">

            <h2>Edit your profile</h2>
            <div class="form-group row m-3">
                Enter caption for your title
                <label for="title" class="col-md-4 col-form-label"></label>

                <div>
                    <input id="title" type="text" name="title"class="form-control @error('title') is-invalid @enderror"value="{{old('title')?? $user->profile->title}}">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row m-3">
                Enter caption for your description
                <label for="description" class="col-md-4 col-form-label"></label>

                <div>
                    <textarea name="description" id="" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror">
                        {{old('description') ?? $user->profile->description}}
                    </textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- image -->
            <div class="form-group row m-3">
                Enter  your profile image
                <label for="image" class="col-md-4 col-form-label"></label>

                <div>
                    <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <span style="color:red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button type="submit"class="btn btn-danger btn-sm m-3 mb-5">Save Profile</button>
        </div>


    </form>
 </div>
@endsection
