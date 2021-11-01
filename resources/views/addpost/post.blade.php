
@extends('layouts.app')

@section('content')
<div class="container">
   <form action="/createpost" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8 m-2">
                <div class="form-group row m-3">
                    Enter caption for your image
                    <label for="caption" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input id="caption" type="text" name="caption"class="form-control @error('caption') is-invalid @enderror"value="{{old('caption')}}">

                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- image -->
                <div class="form-group row m-3">
                    Enter caption for your image
                    <label for="image" name="image" class="col-md-4 col-form-label"></label>

                    <div class="col-md-6">
                        <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <span style="color:red;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit"class="btn btn-danger m-3">Upload</button>
            </div>    
            
        </div>
   </form>
</div>
@endsection
