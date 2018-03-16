<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="{{ asset('css/videojs.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

	<div id="container" class="container ml-0 mr-0 pl-0 pr-0" style="max-width: 100%; min-height:100vh; max-height:100vh;">

		@include('layouts.navbar')

		<div id="main" class="row mr-0 ml-0" style="max-width:100%;">

			<div class="col-md-9 pl-1 pt-1">

				<video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }'>
				    <source src="http://10.0.0.61:8080/hls/test.m3u8" type='application/x-mpegURL'>
				    <p class="vjs-no-js">
				    	To view this video please enable JavaScript, and consider upgrading to a web browser that
				    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
				    </p>
				</video>

			</div>

			<div id="app" class="col-md-3 px-0">

				<chatroom :user="{{ Auth::user() }}"></chatroom>

			</div>

		</div> <!-- row -->
	</div> <!-- container -->

	<!-- vermoedelijk zijn een paar van deze scripts optioneel, moet testen met strema up -->

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
