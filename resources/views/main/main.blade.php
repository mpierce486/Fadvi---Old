@extends('templates.default')

@section('content')

<div id="main-top">
	<div id="main-banner-overlay"></div>
	<div id="main-banner-wrapper">
		<img src="{{ asset('/images/main_banner.jpg') }}" id="main-banner" />
	</div>
	<div id="main-top-text">
		<h1 id="main-text">Helping You Find the Advice You Need</h1>
	</div>
</div>

<div id="main-middle-wrapper">
	<div id="main-middle" class="container advisor-categories">
		<h2 id="middle-header-text">Choose one of the topics below</h2>
		<form class="advisor-cat-form" role="form" method="post" action="#">
			<div id="topics-wrapper" class="col-lg-10 col-lg-offset-1 col-xs-12">
				@foreach ($topics as $topic)
					<div class="topics-item-wrapper">
					@if (Auth::check())
						<div class="topics-item img-thumbnail">
							<p>{{ $topic }}</p>
						</div>
					@else
						<div class="topics-item img-thumbnail hide-xs" data-toggle="modal" data-target="#register-modal">
							<p>{{ $topic }}</p>
						</div>
						<a href="/register" class="topics-item img-thumbnail show-xs">
							<p>{{ $topic }}</p>
						</a>
					@endif	
					</div>
				@endforeach
			</div>
		</form>
	</div>
</div>

<div id="main-bottom-wrapper">
	<div id="main-bottom-1-wrapper">
		<div id="main-bottom-1" class="container">
			<div class="row">
				<div id="main-bottom-left" class="col-sm-12 col-md-6">
					<div id="left-graphic">
						<i class="fas fa-users"></i>
					</div>
					<div id="left-text">
						We are a network of financial advisors, estate planning attorneys, and certified public accountants that believe in 
						working together to help you plan for your future.
					</div>
				</div>

				<div id="main-bottom-right" class="col-sm-12 col-md-6">
					<div id="left-graphic">
						<i class="fas fa-lightbulb"></i>
					</div>
					<div id="right-text">
						We believe each individual and family should have advice around their financial, estate, and tax needs and our mission is to make that advice more accessible.
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="main-bottom-2-wrapper">
		<div id='main-bottom-2'>
			<div id="main-bottom-2-header">How Does It Work?</div>
			<div class="main-bottom-text-wrapper row">
				<div class="main-bottom-text col-md-8 col-sm-12">
					<div class="main-bottom-text-header">Ask A Question</div>
					<p class="main-bottom-text-copy">Choose from any of the topics above. Answer a few details about your situation and submit your question.</p>
				</div>
				<div class="main-bottom-graphic col-md-4">
					<i class="fas fa-question-circle"></i>
				</div>
			</div>
		</div>
	</div>
	<div id="main-bottom-3-wrapper">
		<div id='main-bottom-3'>
			<div class="main-bottom-text-wrapper row">
				<div class="main-bottom-text col-md-8 col-sm-12">
					<div class="main-bottom-text-header">Receive Reponses From Advisors</div>
					<p class="main-bottom-text-copy">We let advisors know about your question and they will provide a response to you. We will notify you whenever you get a response.</p>
				</div>
				<div class="main-bottom-graphic col-md-4">
					<i class="fas fa-reply"></i>
				</div>
			</div>
		</div>
	</div>
	<div id="main-bottom-4-wrapper">
		<div id='main-bottom-4'>
			<div class="main-bottom-text-wrapper row">
				<div class="main-bottom-text col-md-8 col-sm-12">
					<div class="main-bottom-text-header">Engage With Advisors</div>
					<p class="main-bottom-text-copy">Once you receive some responses, if you like any of those reponses you can create a discussion with an advisor which is similar to a private chat with that advisor where you can get into more details to help with your question.</p>
				</div>
				<div class="main-bottom-graphic col-md-4">
					<i class="fas fa-comments"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Include register modal -->
@include ('templates.partials.register-modal')

<!-- JS -->
<script src="{{ asset('js/main.js') }}"></script>


@stop