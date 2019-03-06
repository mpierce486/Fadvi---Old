@extends('templates.default')

@section('content')

<div class="global-wrapper container">
	<div id="blog-post-wrapper">
		<div id="blog-post-img" class="col-sm">
			<img src="{{ $blog->blog_main_img }}" class="img-fluid" />
		</div>
		<div id="blog-post-title"><h2>{{ $blog->blog_title }}</h2></div>
		<div id="blog-post-date">{{ date("F j, Y", strtotime($blog->created_at)) }}</div>
		<div id="blog-post-content-wrapper">
			<?php echo $blog->blog_content ?>
		</div>
	</div>
</div>

@stop