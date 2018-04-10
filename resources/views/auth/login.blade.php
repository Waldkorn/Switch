<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    body {
      background-color: #c6c8ca;
    }
		.navbar-toggler:hover {
			border: 2px solid #dc3545;
		}
		.navbar-toggler:focus {
			box-shadow: 0 0 3pt 2pt #dc3545;
			outline: none;
			border: none;
		}
		#navbar{
			padding-right:0;
			color:#f5f5dc;

		}

		#navbarToggleExternalContent{
			margin-top:0.9rem;
			background-color: #343a40;
			right:0;left:auto;
			border:0;
			border-radius: 0px 0px 0.25rem 0.25rem;
		}

		#navbardropdown{
			background-color: #343a40;
			color: #f5f5dc;
			border-top:1px;
			}
		#navbardropdown:hover {
		    text-decoration: underline;
				background-color: #343a40;
				color: #f5f5dc;
				border-top:1px;
		}
    #email:hover {
      border: 2px solid #dc3545;
    }
    #email:focus {
      box-shadow: 0 0 3pt 2pt #dc3545;
      outline: none;
      border: none;
    }
    #password:hover {
      border: 2px solid #dc3545;
    }
    #password:focus {
      box-shadow: 0 0 3pt 2pt #dc3545;
      outline: none;
      border: none;
    }
    .card-body{
      background-color:white;
      color: #343a40;
    }
    .card-header{
      text-align: center;
      background-color:#343a40;
      color: #f5f5dc;
    }
  </style>
</head>
<body>

  @include('layouts.navbar')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:1rem">
                <div class="card-header"><h3 class="mb-1" >{{ __('Login') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#dc3545">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
