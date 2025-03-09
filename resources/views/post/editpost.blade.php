@extends('layouts.app')
@section('title'){{'Edit Post'}}@endsection

@section('content')
<div class="container add_post_con">
   <form action="{{route('save.post.edit',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center mt-5">

            <div class="col-md-8 m-2 mt-4">
                <h3 class="mb-4">Edit Your Post</h3>
                <div class="form-group row m-3 mt-4">
                    Enter caption for your image
                    <label for="caption" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
                        <textarea name="caption" id="caption" cols="30" rows="5" class="form-control @error('caption') is-invalid @enderror">{{old('caption',$post->caption)}}</textarea>


                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- image -->
                <div class="form-group row m-3">
                    Enter caption for your image
                    <label for="image" name="image" class="col-md-4 col-form-label"></label>

                    <div class="col-md-8">
                        <input type="file" name="image" id="image"class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img src="{{asset('uploads/posts')}}/{{$post->image}}" id="blah" alt="" style="width:100px;100px;margin-top:10px;">
                    </div>
                </div>
                <button type="submit"class="btn btn-danger m-3">Upload</button>
            </div>

        </div>
   </form>
</div>


<div class="addpost_responsive_container">
    <form action="{{route('save.post.edit',$post->id)}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="row justify-content-center">

             <div class="col-md-8 m-2 mt-4">
                 <h3 class="mb-4">Add a Post</h3>
                 <div class="form-group row m-3 mt-4">
                     Enter caption for your image
                     <label for="caption" class="col-md-4 col-form-label"></label>

                     <div class="col-md-8">
                         <textarea name="caption" id="caption" cols="30" rows="5" class="form-control @error('caption') is-invalid @enderror">{{old('caption',$post->caption)}}</textarea>


                         @error('caption')
                             <span class="invalid-feedback" role="alert">
                                 <strong style="color:red;">{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>
                 </div>
                 <!-- image -->
                 <div class="form-group row m-3">
                     Enter caption for your image
                     <label for="image" name="image" class="col-md-4 col-form-label"></label>

                     <div class="col-md-8">
                         <input type="file" name="image" id="image"class="form-control" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                         <img src="{{asset('uploads/posts')}}/{{$post->image}}" id="blah2" alt="" style="width:100px;100px;margin-top:10px;">

                     </div>
                 </div>
                 <button type="submit"class="btn btn-danger btn-sm m-3 mb-5">Upload</button>
             </div>

         </div>
    </form>
</div>
@endsection
