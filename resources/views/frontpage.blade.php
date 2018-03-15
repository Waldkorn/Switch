<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

  @include('layouts.navbar')

<div id="app">
<div class="row" style="width:100%;margin:0">

<nowlivebar></nowlivebar>

<frontpagemain></frontpagemain>
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
