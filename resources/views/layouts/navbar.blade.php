<nav id="navbar" class="navbar navbar-dark bg-dark" >

	<a class="navbar-brand" href="/"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>

	<div class="navbar float-right">
		<div class="nav-item active ml-2">
			@if (Auth::check())
				<strong> Welcome, <a href="/profilepage/{{ Auth::user()->name }}" style="color:#dc3545;margin-right:1rem">{{ Auth::user()->name }}</a> </strong>
			@endif
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse dropdown-menu pull-menu-right dropdown-menu-right" id="navbarToggleExternalContent">
		    	@if(Auth::check())
					<a class="dropdown-item" id="navbardropdown" href="/dashboard">Dashboard</a><hr>
		    		<a class="dropdown-item" id="navbardropdown" href="/logout">Logout</a>
		    	@else
			    	<a class="dropdown-item" id="navbardropdown" href="/login">Login</a><hr>
			    	<a class="dropdown-item" id="navbardropdown" href="/register">Register</a>
		    	@endif
	    </div>
		</div>
	</div>

</nav>
