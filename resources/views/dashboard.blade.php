<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Switch dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
<div class="container-fluid">

  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-stream-tab" data-toggle="tab" href="#nav-stream" role="tab" aria-controls="nav-stream" aria-selected="true">Home</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
    <a class="nav-item nav-link" id="nav-channel-tab" data-toggle="tab" href="#nav-channel" role="tab" aria-controls="nav-channel" aria-selected="false">Contact</a>
  </div>

  <div class="tab-content" id="nav-tabContent">
    <div id="app">
      <div class="tab-pane fade show active" id="nav-stream" role="tabpanel" aria-labelledby="nav-stream-tab"><dashboardstream></dashboardstream></div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><dashboardprofile></dashboardprofile></div>
      <div class="tab-pane fade" id="nav-channel" role="tabpanel" aria-labelledby="nav-channel-tab">channel settings here</div>
    </div>
  </div>
</div>

	<script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
