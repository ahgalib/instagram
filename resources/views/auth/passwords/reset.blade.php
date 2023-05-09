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
                <h3><a href="">Forget Password</a></h3>
                <form method="POST" action="{{ route('user_password_reset_email_send') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-5 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Request') }}
                            </button>
                        </div>
                    </div>
                    <div>
                        @if(session('success'))
                        <span style="color:#00f79c">{{session('success')}}</span>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>





