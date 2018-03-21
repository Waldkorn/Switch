<!DOCTYPE html>
<html>
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Switch - {{$user->name}}</title>

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

@include('layouts.navbar')

<div id="app">
  <div class="row" style="width:100%">
  	<div class="col-3">
			@if (auth::check())
			<profilesidebar :profile="{{$user}}":loggedin="{{$loggedin}}" :isfollowing="{{$isfollowing}}"></profilesidebar>
			@else
			<profilesidebar  :profile="{{$user}}" v-bind:loggedin="{{$loggedin}}"></profilesidebar>
			@endif
		</div>

    <div class="col-9">
      <profilepagemain></profilepagemain>
    </div>

  </div>
</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
