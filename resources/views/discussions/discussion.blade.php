@extends('templates.default')

@section('content')

<div id="discussion-wrapper" class="container">
	<div id="discussion-top">
		<h2>Discussion With</h2>
		<div id="discussion-top-advisor">
			<img src="{{ asset('/') }}{{ $advisor->image_path }}" data-id="{{ $advisor->username }}" class="img-responsive img-circle" />
			<h3 id="discussion-advisor-name">{{ $advisor->first_name }} {{ $advisor->last_name }}</h3>
			<h4 id="discussion-advisor-title">{{ $advisor->title }}</h4>
			<h5 id="discussion-advisor-firm">{{ $advisor->firm_name }}</h5>
		</div>
	</div>

	@if ($posts->count())
		@foreach($posts as $post)
			@if ($post->user->username === null)
				<div class="discussion-post-wrapper col-sm-12 col-md-12 col-lg-12">
					<div class="discussion-post-content-user col-xs-12 col-sm-5">
						<h4><?php echo $post->post ?></h4>
					</div>
					<div class="discussion-post-name-user">
						<h5>{{ $post->user->first_name }}</h5>
						<h6>{{ $post->created_at->diffForHumans() }}</h6>
					</div>
				</div>
			@else
				<div class="discussion-post-wrapper col-sm-12 col-md-12 col-lg-12">
					<div class="discussion-post-content-advisor col-xs-12 col-sm-5">
						<h4>{{ $post->post }}</h4>
					</div>
					<div class="discussion-post-name-advisor">
						<h5>{{ $post->user->first_name }} {{ $post->user->last_name }}</h5>
						<h6>{{ $post->created_at->diffForHumans() }}</h6>
					</div>
				</div>
			@endif
		@endforeach
	@endif
	<form role="form" id="email-notifications" class="col-xs-12 col-sm-8 col-sm-offset-2">
		<div class="form-check">
			@if ($disNotif === true)
			<input type="checkbox" class="form-check-input" id="email-notification-check" checked>
			@else
			<input type="checkbox" class="form-check-input" id="email-notification-check">
			@endif
			<label class="form-check-label" for="email-notification-check">Enable email notifications</label>
		</div>
	</form>
	<div id="discussion-input" class="col-xs-12 col-sm-8 col-sm-offset-2">
		<form role="form" id="discussion-input-form">
			<div class="form-group">
				<textarea class="form-control input-global" id="discussion-form-input" name="discussion-form-input"></textarea>
			</div>
			<span class="help-block">This discussion is for general information and you should not communicate confidential details. To do so, ask to speak with the advisor privately offline.</span>
			<button type="submit" class="btn btn-global" id="submit-btn">Submit</button>
			<span class="hidden" data-id="{{ $post->discussion_id }}"></span>
		</form>		
	</div>

</div>
	
<script src="{{ asset('js/discussion.js')  }}"></script>	
<!-- TinyMCE JS -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#discussion-form-input',
        menubar: false,
        plugins: ['advlist, lists, placeholder'],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        forced_root_block : "", 
        force_br_newlines : true,
        force_p_newlines : false,
        statusbar: false,
        content_css: '/css/app.css',
    });
</script>
@stop