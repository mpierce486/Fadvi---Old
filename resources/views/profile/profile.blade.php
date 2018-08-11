@extends('templates.default')

@section('content')



<div class="profile-wrapper container">
	<h1>{{ Auth::user()->first_name }}'s Profile</h1>

	<!-- Menu Content -->

	<ul class="nav nav-tabs">
	  <li class="nav-item" data-title="questions">
	    <a class="nav-link active" href="#">My Questions</a>
	  </li>
	  <li class="nav-item" data-title="discussions">
	    <a class="nav-link" href="#">My Discussions</a>
	  </li>
	  <li class="nav-item" data-title="usernamepassword">
	    <a class="nav-link" href="#">Username & Password</a>
	  </li>
	</ul>

	<div class="main-content">
		<div class="content-section" id="questions">
			<h2>Questions I Have Asked</h2>
			<div class="questions-content">
				<div class="content-section">
					@if (!$questions->count())
						<p>You have not asked any questions yet.</p>
					@else
						@foreach($questions as $question)
							<div class="question-details col-sm-10">
								@foreach($question->topic as $topic)
								<div id="details-topic" class="col-sm-12 row">
									<h5 id="topic-header" class="col-sm-2"><strong>Topic:</strong></h5>
									<div id="topic" class="col-sm-10 col-sm-offset-2">{{ $topic->topic_name }}</div>
								</div>
								@endforeach
								<div id="details-question" class="col-sm-12 row">
									<h5 id="question-header" class="col-sm-2"><strong>Question:</strong></h5>
									<div id="question" class="col-sm-10 col-sm-offset-2">{{ $question->question }}</div>
								</div>
								<div id="question-metrics" class="row">
									<ul>
										<li id="metric-time"><i class="fas fa-hourglass-half" title="Time Posted"></i> {{ $question->created_at->diffForHumans() }}</li>
										<li id="metric-responses"><i class="fas fa-comments" title="Responses"></i> {{ $question->countResponses() > 1 ? $question->countResponses().' Responses' : $question->countResponses().' Response'}} </li>
									</ul>
								</div>
								@if ($question->countResponses())
									<button class="btn btn-global view-responses" data-toggle="collapse" data-target="#questionResponses-{{ $question->id }}" aria-expanded="false">View Responses</button>
									<div class="collapse" id="questionResponses-{{ $question->id }}">
										@foreach ($question->getResponses() as $response)
											<div class="card">
												<div class="card-body row">
													<div class="response-advisor-info col-sm">
														@foreach ($response->advisor as $advisor)
															<div class="advisor-img">
																<img src="{{ asset('/') }}{{ $advisor->image_path }}" class="img-fluid" />
															</div>
															<ul class="advisor-details">
																<li class="advisor-name">
																	<h4>{{ $advisor->first_name }} {{ $advisor->last_name }}</h4>
																</li>
																<li class="advisor-firm">
																	<h6>{{ $advisor->firm_name }}</h6>
																</li>
																<li class="advisor-location">
																	<h6>{{ $advisor->firm_city }}, {{ $advisor->firm_state }}</h6>
																</li>
															</ul>
														@endforeach
													</div>
													<div class="response-text col-sm">
														<span class="upper-quote text-muted"><i class="fas fa-quote-left"></i></span>
														<blockquote class="blockquote">{{ $response->response }}</blockquote>
														<span class="lower-quote text-muted"><i class="fas fa-quote-right"></i></span>
													</div>
													<div class="discussion-button col-sm-2 col-xs-12">
														<button class="btn btn-global">Begin Discussion</button>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								@endif
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
		<div class="content-section" id="discussions">
			<h2>Advisors I Have Contacted</h2>

		</div>

		<div class="content-section table-responsive" id="usernamepassword">
			<h2>Username & Password</h2>
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

@include ('contact.contact-modal')

<!-- JS -->
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/favorite.js')  }}"></script>
<script src="{{ asset('js/contact.js')  }}"></script>
<!-- TinyMCE JS -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#advisor-contact-input',
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