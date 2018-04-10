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

		<div class="row" id="main" style="max-width:100%;">

			<div class="col-md-2 pt-1" style="padding:0; overflow-y:scroll;">
				@if (Auth::check())
					<Followings></Followings>
					<nowlivebar :user="{{ Auth::user() }}"></nowlivebar>
				@else
					<nowlivebar></nowlivebar>
				@endif
			</div>

			<div class="col-md-10" style="margin-right:-15px;padding:0;">

				<div class="row" style="height:100%;">

					<div class="col-md-4 pr-0">
						<userlist :followings="{{ $followings }}" v-on:new-chat-window="setMessages"></userlist>
					</div>

					<div class="col-md-8 p-0">
						<messenger :messages="messages" :user="{{ Auth::user() }}" :chatter="chatter"></messenger>
					</div>
					
				</div>

			</div>

		</div>

	</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>