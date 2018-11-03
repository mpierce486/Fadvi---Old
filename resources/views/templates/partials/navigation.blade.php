<nav class="navbar fixed-top navbar-expand-lg navbar-dark">
	<a class="navbar-brand" href="#">Fadvi</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarToggler">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('advisors') }}">Our Advisors</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link" href="{{ route('why') }}">Why</a>
			</li> -->
		</ul>
		<ul class="navbar-nav">
			@if (Auth::check())
				@if (Auth::user()->hasRole('admin'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('admin') }}">Admin Dashboard</a>
					</li>
				@endif
				<li class="nav-item">
					<a class="nav-link" href="{{ route('profile', ['name' => Auth::user()->first_name.Auth::user()->last_name]) }}">My Profile</a>
				</li>
				<li class="nav-item">	
					<a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.register') }}">Register</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">Log In</a>
				</li>
			@endif
		</ul>
	</div>
</nav>
