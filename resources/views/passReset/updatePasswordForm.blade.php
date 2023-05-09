@section('title'){{'Login'}}@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fontAewsome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="main_login">
        <div class="contant_login">
            <div class="login_form">
                <h3>Set Your New Password{{$token}}</h3>
                <form method="POST" action="/set/new/password">
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input type="hidden" name="token" value="{{$token}}">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="current-password">

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-5 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Password') }}
                            </button>

                        </div>
                    </div>


                    @if(session('error'))
                    <span style="color:#df0510">{{session('error')}}</span>

                    @endif

                </form>

            </div>
        </div>
    </div>
</body>
</html>




