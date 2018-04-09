<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Switch - {{$user->name}}</title>

	<link rel="shortcut icon" type="image/x-icon" href="/images/Switch-logo.png" />
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
c
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

@include('layouts.navbar')

<div id="app">
  <div class="row" style="width:100%">
  	<div class="col-3 mt-1">
			@if (auth::check())
				<profilesidebar :profile="{{$user}}":loggedin="{{$loggedin}}" :isfollowing="{{$isfollowing}}" ></profilesidebar>
			@else
				<profilesidebar  :profile="{{$user}}" v-bind:loggedin="{{$loggedin}}"></profilesidebar>
			@endif
		</div>

    <div class="col-9">
		<!-- <div class="row">
    		<profilepagemain></profilepagemain>
    	</div> -->
		<div class="row mt-1">
			<profileschedule :profile="{{$user}}"></profileschedule>
		</div>
	</div>

  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
