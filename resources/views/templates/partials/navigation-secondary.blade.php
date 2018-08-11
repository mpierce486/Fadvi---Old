<nav class="navbar navbar-secondary fixed-top navbar-expand-lg navbar-dark">
	<a class="navbar-brand" href="{{ route('index') }}">Fadvi</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		</ul>
		<ul class="navbar-nav">
			@if (Auth::check())
				@if (Auth::user()->hasRole('admin'))
					<li class="nav-item">
						<a class="nav-link" id="navigation-link" href="{{ route('admin') }}">Admin Dashboard</a>
					</li>
				@endif
				<li class="nav-item">
					<a class="nav-link" id="navigation-link" href="{{ route('profile', ['name' => Auth::user()->first_name.Auth::user()->last_name]) }}">My Profile</a>
				</li>
				<li class="nav-item">	
					<a class="nav-link" id="navigation-link" href="{{ route('auth.logout') }}">Logout</a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" id="navigation-link" href="{{ route('auth.register') }}">Register</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="navigation-link" href="{{ route('login') }}">Log In</a>
				</li>
			@endif
		</ul>
	</div>
</nav>
