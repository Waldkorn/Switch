<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Switch</title>
	
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

	<div id="app">
		<div class="row" style="width:100%;margin:0">
			<div class="col-md-2 pt-1" style="padding:0;">
				@if (Auth::check())
				<Followings></Followings>
				@endif
				<nowlivebar :user="{{ Auth::user() }}"></nowlivebar>
			</div>
			@if (Auth::check()) 
				<frontpagemain :user="{{ Auth::user() }}"></frontpagemain>
			@else
				<frontpagemain></frontpagemain>
			@endif
			<games></games>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
