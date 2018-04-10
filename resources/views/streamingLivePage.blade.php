<!DOCTYPE html>
<html>
<head>
	<title>You are streaming live!</title>
	<link rel="shortcut icon" type="image/x-icon" href="/images/Switch-logo.png" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<div id="app">

	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		Echo.join('StreamPresence.' + {{ $streamer->stream->id }}, "{{ $streamer }}")
            .here((users) => {
            	console.log(users);
	            axios.post('/api/stream/alive', {
		            stream_token: "{{ $streamToken }}",
		            viewer_count: users.length
		        });
		        Echo.leave('StreamPresence.' + {{ $streamer->stream->id }})
	        })
	        
		setInterval(function(){
	        Echo.join('StreamPresence.' + {{ $streamer->stream->id }}, "{{ $streamer }}")
            .here((users) => {
	            axios.post('/api/stream/alive', {
		            stream_token: "{{ $streamToken }}",
		            viewer_count: users.length
		        });
		        Echo.leave('StreamPresence.' + {{ $streamer->stream->id }})
	        })
        }.bind(this), 30000);
	</script>
</body>
</html>