<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Switch dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

  	<link href="{{ asset('css/videojs.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>
  <body>

@include('layouts.navbar')

  <div class="container-fluid">

    <div id="app">
      <dashboardprofile></dashboardprofile>
    </div>

  </div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
