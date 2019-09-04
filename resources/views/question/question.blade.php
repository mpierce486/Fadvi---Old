@extends('templates.default')

@section('content')

<div class="global-wrapper container">

	<h1 id="question-heading">What is your question regarding <span>{{ Session::get('topic') }}</span>?</h1>
	<div class="alert alert-success col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" id="question-submit-success" role="alert">
		Your question has been successfully submitted. Check its status at your profile. </br></br> <strong>Redirecting...</strong>
	</div>
	
	<div id="question-wrapper" class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
		@if (Session::get('topic') === "Budgeting")
			@include('question.steps.budgeting')
		@endif
		@if (Session::get('topic') === "Paying Off Debt")
			@include('question.steps.payingoffdebt')
		@endif
		@if (Session::get('topic') === "Investing")
			@include('question.steps.investing')
		@endif
		@if (Session::get('topic') === "Employer Retirement Plans")
			@include('question.steps.employerretirementplans')
		@endif
		@if (Session::get('topic') === "Other Financial Planning")
			@include('question.steps.otherfinancialplanning')
		@endif


		@if (Session::get('topic') === "Buying a House")
			@include('question.steps.buyingahouse')
		@endif
		@if (Session::get('topic') === "Planning for College")
			@include('question.steps.planningforcollege')
		@endif
		@if (Session::get('topic') === "Marriage")
			@include('question.steps.marriage')
		@endif
		@if (Session::get('topic') === "Having Children")
			@include('question.steps.havingchildren')
		@endif
		@if (Session::get('topic') === "Planning for Retirement")
			@include('question.steps.planningforretirement')
		@endif
	</div>
</div>

<!-- JS -->
<script src="{{ asset('js/question.js') }}"></script>

@stop