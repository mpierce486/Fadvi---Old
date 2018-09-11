@extends('templates.default')

@section('content')



<div class="profile-wrapper container">
	@if (Session::has('topic'))
		<a href="{{ route('results') }}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to results</a>
	@endif
	<h1>{{ Auth::user()->first_name }}'s Profile</h1>

	<!-- Menu Content -->

	<ul class="nav nav-tabs">
	  <li class="nav-item" data-title="available-questions">
	    <a class="nav-link active" href="#">Available Questions</a>
	  </li>
	  <li class="nav-item" data-title="responses">
	    <a class="nav-link" href="#">My Responses</a>
	  </li>
	  <li class="nav-item" data-title="discussions">
	    <a class="nav-link" href="#">My Discussions</a>
	  </li>
	  <li class="nav-item" data-title="usernamepassword">
	    <a class="nav-link" href="#">Username & Password</a>
	  </li>
	</ul>

	<div class="main-content">
		<div class="content-section" id="available-questions">
			<h4>These are questions you can respond to.</h4>
			<div class="questions-content">
				@if (!$advisorQuestions)
					<p>There are no available questions to respond to.</p>
				@endif
				@foreach($advisorQuestions as $question)
					<div class="question-details-wrapper">
						<div class="question-details col-sm-10 col-sm-offset-1">
							<div id="details-name" class="col-sm-12 row">
								<h5 id="name-header" class="col-sm-2"><strong>Name:</strong></h5>
								<div id="name" class="col-sm-10 col-sm-offset-2">{{ $question->user->first_name }}</div>
							</div>
							@foreach ($question->topic as $topic)
							<div id="details-topic" class="col-sm-12 row">
								<h5 id="topic-header" class="col-sm-2"><strong>Topic:</strong></h5>
								<div id="topic" class="col-sm-10 col-sm-offset-2">{{ $topic->topic_name }}</div>
							</div>
							@endforeach
							<div id="details-question" class="col-sm-12 row">
								<h5 id="question-header" class="col-sm-2"><strong>Question:</strong></h5>
								<div id="question" class="col-sm-10 col-sm-offset-2">{{ $question->question }}</div>
							</div>
							<form role="form" id="response-input-form-{{ $question->id }}" class="collapse response-input-form">
								<div class="form-group">
									<textarea class="form-control input-global" id="response-form-input-{{ $question->id }}" name="response-form-input"></textarea>
								</div>
								<span class="help-block text-muted">This discussion is for general information and you should not communicate confidential details. To do so, ask to speak with the user privately offline.</span>
								<button type="submit" class="btn btn-global" id="submit-btn">Submit</button>
							</form>
							<div id="question-metrics" class="row">
								<ul>
									<li id="metric-time"><i class="fas fa-hourglass-half" title="Time Posted"></i> {{ $question->created_at->diffForHumans() }}</li>
								</ul>
							</div>
							<button class="btn btn-global" id="question-respond" type="button" data-toggle="collapse" data-target="#response-input-form-{{ $question->id }}" aria-expanded="false" aria-controls="response-input-form">Respond</button>
							<span class="hidden" data-id="{{ $question->id }}"></span>
							<div class="question-details-overlay"><p>Response Submitted. Reloading...</p></div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="content-section" id="responses">
			<h4>These are your responses to previous questions.</h4>
			<div class="responses-content">
				@if (!$advisorResponses)
					<p>You have not responded to any questions.</p>
				@endif
				@foreach ($advisorResponses as $response)
					@foreach ($response->question as $question)
					<div class="response-details-wrapper">
						<div class="question-details col-sm-10 col-sm-offset-1">
							
							<div id="details-name" class="col-sm-12 row">
								<h5 id="name-header" class="col-sm-2"><strong>Name:</strong></h5>
								<div id="name" class="col-sm-10 col-sm-offset-2">{{ $question->user->first_name }}</div>
							</div>
							<div id="details-question" class="col-sm-12 row">
								<h5 id="question-header" class="col-sm-2"><strong>Question:</strong></h5>
								<div id="question" class="col-sm-10 col-sm-offset-2">{{ $question->question }}</div>
							</div>
							<div id="details-response" class="col-sm-12 row">
								<h5 id="response-header" class="col-sm-2"><strong>Response:</strong></h5>
								<div id="response" class="col-sm-10 col-sm-offset-2">{{ $response->response }}</div>
							</div>
							<div id="question-metrics" class="row">
								<ul>
									<li id="metric-time"><i class="fas fa-hourglass-half" title="You Responded"></i> {{ $response->created_at->diffForHumans() }}</li>
								</ul>
							</div>
							
						</div>
					</div>
					@endforeach
				@endforeach
			</div>
		</div>
		<div class="content-section" id="discussions">
			<h4>These are your active discussions with users.</h4>
			<div class="discussion-content">
				@if (!$discussions->count())
					<p>You do not have any active discussions with users.</p>
				@else
					@foreach ($discussions as $discussion)
						<div class="discussion-details">
							<div class="discussion-topic col-sm-8">
								@foreach($discussion->question->topic as $topic)
									<div id="details-topic" class="col-sm-12 row">
										<h5 id="topic-header" class="col-sm-2"><strong>Topic:</strong></h5>
										<div id="topic" class="col-sm-10 col-sm-offset-2">{{ $topic->topic_name }}</div>
									</div>
								@endforeach
								<div id="details-question" class="col-sm-12 row">
									<h5 id="question-header" class="col-sm-2"><strong>Question:</strong></h5>
									<div id="question" class="col-sm-10 col-sm-offset-2">{{ $discussion->question->question }}</div>
								</div>
							</div>
							<a href="{{ route('discussion', ['id' => $discussion->id ]) }}" class="btn btn-global discussion-link">Go To Discussion</a>
						</div>
					@endforeach
				@endif
			</div>
		</div>
		<div class="content-section table-responsive" id="usernamepassword">
			<h4>Username & Password</h4>
			<table class="section-item table" id="section-name">
				<tr>
					<td class="item-col-1"><strong>Name</strong></td>
					<td class="item-col-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
				</tr>
				<tr>
					<td class="item-col-1"><strong>Email</strong></td>
					<td class="item-col-2">{{ Auth::user()->email }}</td>
					<td class="item-col-3 content-edit" id="edit-email-toggle">Change</td>
				</tr>
				<tr id="content-edit-email">
					<td class="item-col-1"></td>
					<td class="item-col-2">
						<form role="form" id="edit-email-form">
							<input type="email" class="form-control" placeholder="Enter new email" />
						</form>
					</td>
					<td class="item-col-3 content-edit"><button id="email-form-submit" class="btn btn-global">Submit</button></td>
				</tr>
				<tr>
					<td class="item-col-1"><strong>Password</strong></td>
					<td class="item-col-2">********</td>
					<td class="item-col-3 content-edit" id="edit-password-toggle">Change</td>
				</tr>
				<tr id="content-edit-password">
					<td class="item-col-1"></td>
					<td class="item-col-2">
						<form role="form" id="edit-password-form">
							<input type="password" class="form-control" id="password-input" name="password" placeholder="Enter new password" />
							<input type="password" class="form-control" id="confirm-password-input" name="password_confirmation" placeholder="Confirm new password" />
						</form>
					</td>
					<td class="item-col-3 content-edit"><button id="password-form-submit" class="btn btn-global">Submit</button></td>
				</tr>
			</table>
		</div>
	</div>

</div>

<!-- JS -->
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/favorite.js')  }}"></script>
<!-- TinyMCE JS -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script>
    tinymce.init({
        mode: "textareas",
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