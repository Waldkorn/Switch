<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>
	
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

  @include('layouts.navbar')

	<div id="app">
		<div class="row" style="width:100%;margin:0">
			<div class="col-md-2">
				<nowlivebar></nowlivebar>
			</div>
			<streams :game="{{json_encode($game)}}" :streamers="{{json_encode($streamers)}}"></streams>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
