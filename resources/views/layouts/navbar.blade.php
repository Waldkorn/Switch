<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand" href="/"><img alt="Switch logo" src="/images/Switch-logo.png" height="56px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" style='border-left: 1px solid;border-color:rgb(220, 53, 69);color:rgb(245, 245, 220)
;padding-left:1rem;' id="navbarText"  >

		@if (Auth::check())
			<h4> Welcome, <a href="/profilepage/{{ Auth::user()->name }}" style="color:#dc3545;margin-right:2rem">{{ Auth::user()->name }}</a> </h4>
		@endif

		@if(Auth::check())
			<div class="navbar-text"><h4><a class="nav-link" id="navbardropdown" href="/dashboard">Dashboard</a></h4></div>
			<div class="navbar-text"><h4><a class="nav-link" id="navbardropdown" href="/messenger">Messenger</a></h4></div>
			<div class="navbar-text"><h4><a class="nav-link" id="navbardropdown" href="/logout" style="color:#dc3545">Logout</a></h4></div>
		@else
			<div class="navbar-text"><h4><a class="nav-link" id="navbardropdown" href="/login">Login</a></h4></div>
			<div class="navbar-text"><h4><a class="nav-link" id="navbardropdown" href="/register">Register</a></h4></div>
		@endif
  </div>
</nav>
