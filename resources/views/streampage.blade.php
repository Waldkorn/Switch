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

				<stream :streamer="{{$streamer}}" :followers="{{$followers}}" :viewers="viewers" :darkmode="darkmode" v-on:darkmode="toggleDarkMode"></stream>

				<div class="col-md-3 px-0">

					<chatroom
					@if (Auth::check())
						:user="{{ Auth::user() }}"
					@endif
					:streamer="{{$streamer}}"
					v-on:user-list="setUsers"
					v-on:user-joined="addUser"
					v-on:user-left="removeUser"
					:viewers="viewers"
					:darkmode="darkmode"
					></chatroom>

				</div>
			</div> <!-- app -->
		</div> <!-- row -->
	</div> <!-- container -->

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
