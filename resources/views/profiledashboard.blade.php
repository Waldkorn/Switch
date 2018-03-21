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

<ul class="nav nav-pills nav-fill navbar-dark bg-dark">
  <li class="nav-item">
    <a class="nav-link" href="/streamdashboard" style="color:#dc3545">Stream</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="/profiledashboard" style="background-color:#dc3545">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/channeldashboard" style="color:#dc3545">Channel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">schedule</a>
  </li>
</ul>

  <div class="container-fluid">

    <div id="app">
      <dashboardprofile></dashboardprofile>
    </div>

  </div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
