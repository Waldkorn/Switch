<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<meta name="csrf-token" content="{{ csrf_token() }}">

  	<title>testing</title>

  	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <img src="/storage/julesoverwatch.png">
<img src="{{ storage_path('app/public/julestest.jpg')  }}" alt="">
  </body>
</html>
