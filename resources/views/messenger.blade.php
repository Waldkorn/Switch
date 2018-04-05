<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="/images/Switch-logo.png" />
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

	<div id="app">

		@include('layouts.navbar')

		<div class="row">
			<div class="col-md-2 pt-1" style="padding:0;">
				@if (Auth::check())
					<Followings></Followings>
					<nowlivebar :user="{{ Auth::user() }}"></nowlivebar>
				@else
					<nowlivebar></nowlivebar>
				@endif
			</div>
			<div class="col-md-10">
				
			</div>
		</div>

	</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>