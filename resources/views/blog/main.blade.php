@extends('templates.default')

@section('content')

<div class="global-wrapper container">

	<div class="blog-grid row">
		@foreach ($blogs as $blog)
		<div class="blog-post col-sm-4">
			@if ($blog->advisor_blog === 1)
			<div class="blog-post-inner advisor-blog-post">
				<a href="{{ route('blog.post', ['id' => $blog->id,'title' => $blog->url_slug]) }}"><img src="{{ $blog->blog_main_img }}" class="img-responsive" /></a>
				<div class="blog-info">
					<div class="blog-info-title"><a href="{{ route('blog.post', ['id' => $blog->id,'title' => $blog->url_slug]) }}">{{ $blog->blog_title }}</a></div>
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