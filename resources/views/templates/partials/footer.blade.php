<footer class="footer">
	<div class="container">
		<div class="footer-about">
			<ul>
				<!-- <li><a href="#">About</a></li> -->
				<li><a href="{{ route('support') }}">Support</a></li>
				<li><a href="{{ route('terms') }}">Terms of Service</a></li>
				<li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
			</ul>
		</div>
		<div class="footer-copy">
			<p>&copy;<?php echo date("Y"); ?> Fadvi</p>
		</div>
	</div>

	@if (env('APP_ENV') == "production")
		@include('templates.partials.analytics')
	@endif
	
</footer>