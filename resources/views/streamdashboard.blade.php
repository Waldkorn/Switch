<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Switch dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" type="image/x-icon" href="/images/Switch-logo.png" />
  	<link href="{{ asset('css/videojs.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
      background-color: #c6c8ca;
    }
    .navbar-toggler:hover {
    border: 2px solid #dc3545;
    }
    .navbar-toggler:focus {
    box-shadow: 0 0 3pt 2pt #dc3545;
    outline: none;
    border: none;
    }
    #navbar{
    padding-right:0;
    color:#f5f5dc;

    }

    #navbarToggleExternalContent{
    margin-top:0.9rem;
    background-color: #343a40;
    right:0;left:auto;
    border:0;
    border-radius: 0px 0px 0.25rem 0.25rem;
    }

    #navbardropdown{
    background-color: #343a40;
    color: #f5f5dc;
    border-top:1px;
    }
    #navbardropdown:hover {
        text-decoration: underline;
        background-color: #343a40;
        color: #f5f5dc;
        border-top:1px;
    }

    hr {
    border-color:#dc3545;
    }
    </style>
  </head>
  <body>
@include('layouts.navbar')

<ul class="nav nav-pills nav-fill navbar-dark bg-dark">
  <li class="nav-item">
    <a class="nav-link active" href="/streamdashboard" style="background-color:#dc3545">Stream</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/profiledashboard" style="color:#dc3545">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/channeldashboard" style="color:#dc3545">Channel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" style="color:#dc3545">schedule</a>
  </li>
</ul>

<div class="container-fluid" id="app">

  <dashboardstream :user="{{$user}}"></dashboardstream>
</div>

	<script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
