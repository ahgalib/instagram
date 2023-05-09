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
                <h3><a href="{{route('register')}}">Dont't have any account?</a></h3>
                @if(session('success'))
                    <span style="color:#00f79c">{{session('success')}}</span>

                @endif
                <form method="POST" action="{{ route('login') }}">
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
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-5 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            <div class="mt-4">
                                <a class="pl-4 mt-4" href="{{ route('password.forget.form') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row social">
                        <div class="col-md-7 offset-md-3">
                            <p>or sign in with</p>

                            <button class="btn btn-dark pl-3"><a href="{{route('github.redirect')}}">
                                <i class="fa-brands fa-github">&nbsp;&nbsp;</i>github</a>
                            </button>

                            {{-- <button class="btn btn-dark pl-3"><a href="" class="">
                                <i class="fa-brands fa-facebook">&nbsp;&nbsp;</i>facebook</a>
                            </button> --}}

                            <button class="btn btn-dark pl-2"><a href="{{route('google.redirect')}}">
                                <i class="fa-brands fa-google">&nbsp;&nbsp;</i>Google</a></button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>



{{-- <!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('login_register_asset/css/style.css')}}">

	</head>
	<body class="img js-fullheight" style="background-image: url(login_register_asset/images/bg.jpg);background-position: center center;background-repeat: no-repeat; background-size: cover;height: 100vh; width: 100%;opacity: 0.8;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Ginsta</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center"><a href="{{route('register')}}">Have an account?</a></h3>
		      	<form method="POST" action="{{ route('login') }}">
                @csrf
		      		<div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:#fff">{{ $message }}</strong>
                            </span>
                        @enderror
		      		</div>
	            <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:#fff">{{ $message }}</strong>
                        </span>
                    @enderror
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                        </label>
					</div>
                    <div class="w-50 text-md-right">
                        <a href="#" style="color: #fff">Forgot Password</a>
                    </div>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('login_register_asset/js/jquery.min.js')}}"></script>
  <script src="{{asset('login_register_asset/js/popper.js')}}"></script>
  <script src="{{asset('login_register_asset/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('login_register_asset/js/main.js')}}"></script>

	</body>
</html> --}}

