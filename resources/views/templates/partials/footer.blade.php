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
		<div class="footer-social">
			<ul>
				<li><a href="https://www.facebook.com/FadviAdvice" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
				<li><a href="https://www.linkedin.com/company/fadvi" target="_blank"><i class="fab fa-linkedin"></i></a></li>
				<li><a href="https://www.instagram.com/fadviadvice/" target="_blank"><i class="fab fa-instagram"></i></a></li>
			</ul>
		</div>
		<div class="footer-copy">
			<p>&copy;<?php echo date("Y"); ?> Fadvi, LLC</p>
		</div>
	</div>

	@if (env('APP_ENV') == "production")
		@include('templates.partials.analytics')
	@endif
	
</footer>