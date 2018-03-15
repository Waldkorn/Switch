<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>


    <nav class="navbar navbar-dark bg-dark" style="color:beige;">

      <a class="navbar-brand" href="#"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>

      <div class="navbar float-right">
        <div class="nav-item active ml-2">Welcome, user</div>
        <div class="dropdown">
          <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse dropdown-menu pull-menu-right dropdown-menu-right" id="navbarToggleExternalContent" style="right:0;left:auto;background-color:beige">
                <a class="dropdown-item" href="/login">Login</a>
                <a class="dropdown-item" href="/register">Register</a>
            </div>
        </div>
      </div>

    </nav>


<div id="app">
<div class="row" style="width:100%;margin:0">

<nowlivebar></nowlivebar>
<div class="col">
<frontpagemain></frontpagemain>
</div>

<games></games>

</div>

</div>

  <!-- vermoedelijk zijn een paar van deze scripts optioneel, moet testen met strema up -->

	<script src="https://unpkg.com/video.js@6.2.5/dist/video.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
	<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>

	<script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>
