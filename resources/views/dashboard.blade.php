<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Switch dash</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

  	<link href="{{ asset('css/videojs.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>
  <body>
@include('layouts.navbar')
<div class="container-fluid">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="stream-tab" data-toggle="tab" href="#stream" role="tab" aria-controls="home" aria-selected="true">Stream</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profilepage settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="channel-tab" data-toggle="tab" href="#channel" role="tab" aria-controls="contact" aria-selected="false">Channel settings</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div id="app">
    <div class="tab-pane fade show active" id="stream" role="tabpanel" aria-labelledby="stream-tab"><dashboardstream :auth_id="{{$auth_id}}"></dashboardstream></div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">profile stuff here soon</div>
    <div class="tab-pane fade" id="channel" role="tabpanel" aria-labelledby="channel-tab">channel settings here</div>
</div>
</div>
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
