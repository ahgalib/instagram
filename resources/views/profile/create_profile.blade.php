@extends('layouts.app')
@section('title'){{'Create Profile'}}@endsection
@section('content')

<div class="container edit_container">
    <form action="{{route('save.profile.create')}}" method="post" enctype="multipart/form-data">
         @csrf

         <div class="row justify-content-center mt-5">

            <div class="col-md-8 m-2 mt-4">
                <h3 class="mb-4">Create Your Profile</h3>
                <div class="form-group row m-3 mt-4">
                    Bio
                    <label for="caption" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">

                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- image -->
                <div class="form-group row m-3">
                    Profile Picture
                    <label for="image" name="image" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
                        <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <span>
                                <strong style="color:red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit"class="btn btn-danger btn-sm m-3 mb-5">Create Profile</button>
            </div>

        </div>
    </form>
 </div>


 <div class="responsive_container mt-5">
    <form action="{{route('save.profile.create')}}" method="post" enctype="multipart/form-data">
    @csrf

         <div class="responsive_edit_content mb-5">
            <h2>Create profile</h2>
            <div class="form-group row m-3 mt-4">
                Bio
                <label for="caption" class="col-md-4 col-form-label"></label>

                <div class="col-md-8">

                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- image -->
            <div class="form-group row m-3">
                Profile Picture
                <label for="image" name="image" class="col-md-4 col-form-label"></label>

                <div class="col-md-8">
                    <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <span>
                            <strong style="color:red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit"class="btn btn-danger btn-sm m-3 mb-5">Create Profile</button>
        </div>

@endsection
