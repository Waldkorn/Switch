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

	<nav class="navbar bg-dark">

		<a class="navbar-brand" href="#"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>

		<div class="navbar-nav">
			<div class="nav-item"><a class="nav-link" href="#">Test</a></div>
		</div>

	</nav>

	<video id="vid1" class="video-js" controls preload="auto" width="640" height="264" data-setup='{}'>
	    <source src="http://10.0.0.61:8080/hls/test.m3u8" type='application/x-mpegURL'>
	    <p class="vjs-no-js">
	    	To view this video please enable JavaScript, and consider upgrading to a web browser that
	    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
	    </p>
	</video>

	<p>test</p>

	<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
	<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>
	<script>
	  videojs.options.flash.swf = 'https://unpkg.com/videojs-swf@5.4.0/dist/video-js.swf';
	  //videojs('vid1');
	</script>
<!-- 	<script>
	    var vid = document.getElementById("vid1");
	    var player = videojs(vid, {techOrder: ['flash', 'html5']});
	</script> -->
	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>