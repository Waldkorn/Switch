<!DOCTYPE html>
<html>
<head>
	<title>You are streaming live!</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<div id="app">

<!-- 		<div class="alert alert-success mt-5">

			<h1 class="text-center alert-heading">You are now streaming live!</h1>

			<hr>

			<h3 class="text-center py-5">Keep this tab open to let others know you are streaming</h3>

		</div> -->



	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		axios.post('/api/stream/alive', {
            stream_token: "{{ $streamToken }}"
        });
		setInterval(function(){
	        axios.post('/api/stream/alive', {
	            stream_token: "{{ $streamToken }}"
	        });
        }, 30000);
	</script>
</body>
</html>