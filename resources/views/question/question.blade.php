@extends('templates.default')

@section('content')

<div class="global-wrapper container">

	<h1 id="question-heading">What is your question regarding <span>{{ Session::get('topic') }}</span>?</h1>
	<div class="alert alert-success col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" id="question-submit-success" role="alert">
		Your question has been successfully submitted. Check its status at your profile. </br></br> <strong>Redirecting...</strong>
	</div>
	
	<div id="question-wrapper" class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
		@if (Session::get('topic') === "Retirement Planning")
			@include('question.steps.retirementplanning')
		@endif
	</div>
</div>

<!-- JS -->
<script src="{{ asset('js/question.js') }}"></script>

@stop