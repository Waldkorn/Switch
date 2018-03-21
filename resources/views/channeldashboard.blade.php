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
    <a class="nav-link" href="/profiledashboard" style="color:#dc3545">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="/channeldashboard" style="background-color:#dc3545">Channel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" style="color:#dc3545">schedule</a>
  </li>
</ul>

<div class="container-fluid" id="app">


</div>

	<script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
