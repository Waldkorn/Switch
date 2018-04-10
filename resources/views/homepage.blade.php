<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" type="image/x-icon" href="/images/Switch-logo.png" />

	<title>Switch</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

	<div class="container ml-0 mr-0 pl-0 pr-0" style="max-width: 100%; min-height:100vh; max-height:100vh;">

		<div class="row" style="max-width:100%;">

			<div class="col-md-8 px-0">

				<video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }' style="width: 100%;">
				    <source src="http://10.0.0.61:8080/hls/test.m3u8" type='application/x-mpegURL'>
				    <p class="vjs-no-js">
				    	To view this video please enable JavaScript, and consider upgrading to a web browser that
				    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
				    </p>
				</video>

			</div>

		</div> <!-- row -->
	</div> <!-- container -->

	<!-- vermoedelijk zijn een paar van deze scripts optioneel, moet testen met strema up -->

	<script src="https://unpkg.com/video.js@6.2.5/dist/video.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
	<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>
	<script>
		videojs.options.flash.swf = 'https://unpkg.com/videojs-swf@5.4.0/dist/video-js.swf';
	</script>
	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
