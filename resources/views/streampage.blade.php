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

		<div id="app">

			<div id="main" class="row mr-0 ml-0" style="max-width:100%;">

				<stream :streamer="{{$streamer}}" :followercount="{{$followerCount}}" :viewers="viewers"></stream>

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
					></chatroom>

				</div>
			</div> <!-- app -->
		</div> <!-- row -->
	</div> <!-- container -->

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
