<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>

	<link href="{{ asset('css/videojs.css') }}" rel="stylesheet">
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

	hr {
	border-color:#dc3545;
	}
	</style>
</head>
<body>

	<div id="container" class="container ml-0 mr-0 pl-0 pr-0" style="max-width: 100%; min-height:100vh; max-height:100vh;">

		@include('layouts.navbar')

		<div id="app">

			<div id="main" class="row mr-0 ml-0" style="max-width:100%;">

				<div class="col-md-9 pl-1 pt-1" style="overflow-y:scroll;">

					<div class="card">
						<div class="card-header">
						    <ul class="nav nav-tabs card-header-tabs">
						        <li class="nav-item">
						        	<a class="nav-link active" href="#">{{ $streamer->name}}</a>
						        </li>
						        <li class="nav-item px-2">
						        	<a class="nav-link active" href="#">followers <small class="text-muted">{{ $followerCount }}</small></a>
						        </li>
						    </ul>
						</div>
						<div class="card-body" style="text-align:center">
							@if ($streamer->now_live == 1)
						 	<video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }'>
						    	<source src="http://10.0.0.61:8080/hls/{{ $streamer->stream_token }}.m3u8" type='application/x-mpegURL'>
							    <p class="vjs-no-js">
							    	To view this video please enable JavaScript, and consider upgrading to a web browser that
							    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
							    </p>
							</video>
							@else
							<img alt="{{$streamer->name}} is offline, sorry!" src="/images/offline.png" >
							@endif
						 </div>
					</div>




				</div>

				<div class="col-md-3 px-0">

					<chatroom
					@if (Auth::check())
						:user="{{ Auth::user() }}"
					@endif
					:streamer="{{$streamer}}"></chatroom>

				</div>
			</div> <!-- app -->
		</div> <!-- row -->
	</div> <!-- container -->

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
