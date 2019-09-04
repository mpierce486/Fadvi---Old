@extends('templates.default')

@section('content')

<div id="FLC-wrapper" class="global-wrapper container">

	<div id="FLC-page-header">Fadvi Learning Center</div>
	<div id="FLC-copy">We believe in helping you learn about personal finance along with connecting you with trusted advisors to help you take control of your financial future. This is why we created the Fadvi Learning Center. Here you will see original content published by those advisors themselves. This way you know the information you are reading is actually practiced by those writing about it.</div>

	<div id="FLC-filters">
		<h5>You can choose a filter if you like</h5>
		<nav id="filters" class="nav nav-pills flex-column flex-sm-row">
			<a class="btn flex-fill text-sm-center nav-link" href="#">Budgeting</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Paying Off Debt</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Investing</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Employer Retirement Plans</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Other Financial Planning</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Buying a House</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Planning for College</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Marriage</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Having Children</a>
			<a class="btn flex-fill text-sm-center nav-link" href="#">Planning for Retirement</a>
		</nav>
		<h6 id="filters-subtext"><i class="far fa-times-circle"></i>Displaying articles about "<strong id="filters-subtext-dynamic"></strong>"</h6>
	</div>

	<div class="blog-grid row">
		@foreach ($blogs as $blog)
		<div class="blog-post col-sm-4">
			@if ($blog->advisor_blog === 1)
			<div class="blog-post-inner advisor-blog-post">
				<a href="{{ $blog->blog_url }}" target="_blank"><img src="{{ $blog->blog_main_img }}" class="img-responsive" /></a>
				<div class="blog-info">
					<div class="blog-info-title"><a href="{{ $blog->blog_url }}" target="_blank">{{ $blog->blog_title }}</a></div>
					@if ($blog->advisor)
					<div class="blog-info-advisor-name">By: {{ $blog->advisor->first_name }} {{ $blog->advisor->last_name }}</div>
					<div class="blog-info-advisor-firm">{{ $blog->advisor->firm_name }}</div>
					@endif
					<div class="blog-info-snippet">{{ $blog->blog_snippet }}</div>
					<div class="blog-info-date">{{ date("F j, Y", strtotime($blog->created_at)) }}</div>
					<div class="advisor-blog-notice">Contributing Advisor Content</div>
				</div>
			</div>
			@else
			<div class="blog-post-inner">
				<a href="{{ route('blog.post', ['id' => $blog->id,'title' => $blog->url_slug]) }}"><img src="{{ $blog->blog_main_img }}" class="img-responsive" /></a>
				<div class="blog-info">
					<div class="blog-info-title"><a href="{{ route('blog.post', ['id' => $blog->id,'title' => $blog->url_slug]) }}">{{ $blog->blog_title }}</a></div>
					<div class="blog-info-snippet">{{ $blog->blog_snippet }}</div>
					<div class="blog-info-date">{{ date("F j, Y", strtotime($blog->created_at)) }}</div>
				</div>
			</div>
			@endif
		</div>
		@endforeach
	</div>

</div>

<!-- JS -->
<script src="{{ asset('js/blog.js') }}"></script>

@stop