<nav id="navbar" class="navbar navbar-dark bg-dark" style="color:beige;">

	<a class="navbar-brand" href="/"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>

	<div class="navbar float-right">
		<div class="nav-item active ml-2">
			@if (Auth::check())
				Welcome, <a href="/profilepage/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a>
			@endif
			<button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse dropdown-menu pull-menu-right dropdown-menu-right" id="navbarToggleExternalContent" style="right:0;left:auto;background-color:beige">
		    	@if(Auth::check())
		    	<a class="dropdown-item" href="/logout">Logout</a>
		    	@else
		    	<a class="dropdown-item" href="/login">Login</a>
		    	<a class="dropdown-item" href="/register">Register</a>
		    	@endif
	    </div>
		</div>
	</div>

</nav>