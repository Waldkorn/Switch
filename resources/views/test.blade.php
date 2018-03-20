<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<meta name="csrf-token" content="{{ csrf_token() }}">

  	<title>testing</title>

  	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="app">
      <!-- let people make clients -->
      <passport-clients></passport-clients>

      <!-- list of clients people have authorized to access our account -->
      <passport-authorized-clients></passport-authorized-clients>

      <!-- make it simple to generate a token right in the UI to play with -->
      <passport-personal-access-tokens></passport-personal-access-tokens>
      <test></test>
</div>
<script src="https://unpkg.com/video.js@6.2.5/dist/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.8.2/videojs-contrib-hls.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
<script src="https://unpkg.com/videojs-flash@2.0.0/dist/videojs-flash.min.js"></script>

<script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
