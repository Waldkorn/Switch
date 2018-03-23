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
    .nav-link {
      color:#dc3545;

    }
    .nav-link:hover {
      color:#dc3545;
      text-decoration: underline;
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

<div  class="container-fluid" id="app" style="padding:0px">
  <dashboard :user="{{$user}}"></dashboard>
</div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
