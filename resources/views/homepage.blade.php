<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://unpkg.com/video.js@6.2.5/dist/video-js.min.css" rel="stylesheet">

	<script src="https://unpkg.com/video.js@6.2.5/dist/video.min.js"></script>
	<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>

</head>
<body>

	<div class="container ml-0 mr-0 pl-0 pr-0" style="max-width: 100%; min-height:100vh;">

		<nav class="navbar navbar-dark bg-dark" style="color:beige;">

			<a class="navbar-brand" href="#"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>

			<div class="navbar float-right">
				<div class="nav-item active ml-2">Welcome, user</div>
				<div class="nav-item active ml-2">Logout</div>
				<button class="navbar-toggler ml-2" type="button">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			</div>

		</nav>

		<div class="row" style="min-height:1000px;">

			<div class="col-md-2 bg-dark">

			</div>

			<div class="col-md-6 px-0">

				<video id="vid1" class="video-js" controls preload="auto" data-setup='{}' style="max-width: 100%; min-width: 100%;">
				    <source src="http://10.0.0.61:8080/hls/test.m3u8" type='application/x-mpegURL'>
				    <p class="vjs-no-js">
				    	To view this video please enable JavaScript, and consider upgrading to a web browser that
				    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
				    </p>
				</video>

			</div>

			<div class="col-md-4 bg-dark">

			</div>

		</div> <!-- row -->
	</div> <!-- container -->

	<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
	<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>
	<script>
	  videojs.options.flash.swf = 'https://unpkg.com/videojs-swf@5.4.0/dist/video-js.swf';
	</script>
	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>