@extends('templates.default')

@section('content')

<div id="FLC-wrapper" class="global-wrapper container">

	<div id="FLC-page-header">Fadvi Learning Center</div>
	<div id="FLC-copy">We believe in helping you learn about personal finance along with connecting you with trusted advisors to help you take control of your financial future. This is why we created the Fadvi Learning Center. Here you will see original content published by those advisors themselves. This way you know the information you are reading is actually practiced by those writing about it.</div>

	<div id="FLC-filters">
		<h5>You can choose a filter if you like</h5>
		<nav id="filters" class="nav nav-pills flex-column flex-sm-row">
			@foreach ($topics as $topic)
				<a class="btn flex-fill text-sm-center nav-link" href="#" data-id="{{ $topic->id }}">{{ $topic->topic_name }}</a>
			@endforeach
			@foreach ($life_events as $life_event)
				<a class="btn flex-fill text-sm-center nav-link" href="#" data-id="{{ $life_event->id }}">{{ $life_event->topic_name }}</a>
			@endforeach
		</nav>
		<h6 id="filters-subtext"><i class="far fa-times-circle"></i>Displaying articles about "<strong id="filters-subtext-dynamic"></strong>"</h6>
	</div>

	<div class="blog-grid row grid">
		@foreach ($blogs as $blog)
		<div class="blog-post col-sm-4 grid-item 1 @foreach($blog->topics as $topic) {{$topic->id}}@endforeach">
			<div class="blog-post-inner advisor-blog-post 1">
				<a href="{{ $blog->blog_url }}" target="_blank"><img src="{{ $blog->blog_main_img }}" class="img-responsive" /></a>
				<div class="blog-info">
					<div class="blog-info-title"><a href="{{ $blog->blog_url }}" target="_blank">{{ $blog->blog_title }}</a></div>
					<div class="blog-info-advisor-name">By: {{ $blog->advisor_name }}</div>
					<div class="blog-info-advisor-firm">{{ $blog->firm_name }}</div>
					<div class="blog-info-snippet">{{ $blog->blog_snippet }}</div>
					<div class="blog-info-date">{{ date("F j, Y", strtotime($blog->created_at)) }}</div>
<!-- 					<div class="advisor-blog-notice">Contributing Advisor Content</div>-->				
				</div>
			</div>
		</div>
		@endforeach
	</div>

</div>

<!-- JS -->
<script src="{{ asset('js/blog.js') }}"></script>

@stop