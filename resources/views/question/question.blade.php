@extends('templates.default')

@section('content')

<div class="global-wrapper container">

	<h1 id="question-heading">What is your question regarding <span>{{ Session::get('topic') }}</span>?</h1>
	<div class="alert alert-success col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" id="question-submit-success" role="alert">
		Your question has been successfully submitted. Check its status at your profile. </br></br> <strong>Redirecting...</strong>
	</div>
	
	<div id="question-wrapper" class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
		@if (Session::get('topic') === "Debt Reduction")
			@include('question.steps.debtreduction')
		@endif
		@if (Session::get('topic') === "Retirement Planning")
			@include('question.steps.retirementplanning')
		@endif
		@if (Session::get('topic') === "College Savings")
			@include('question.steps.collegesavings')
		@endif
		@if (Session::get('topic') === "Investments")
			@include('question.steps.investments')
		@endif
		@if (Session::get('topic') === "Life Insurance & Annuities")
			@include('question.steps.lifeinsuranceannuities')
		@endif


		@if (Session::get('topic') === "Trusts")
			@include('question.steps.trusts')
		@endif
		@if (Session::get('topic') === "Wills")
			@include('question.steps.wills')
		@endif
		@if (Session::get('topic') === "Powers of Attorney")
			@include('question.steps.powersofattorney')
		@endif
		@if (Session::get('topic') === "Estate Planning")
			@include('question.steps.estateplanning')
		@endif


		@if (Session::get('topic') === "Personal Taxes")
			@include('question.steps.personaltaxes')
		@endif
		@if (Session::get('topic') === "Business Taxes")
			@include('question.steps.businesstaxes')
		@endif
		@if (Session::get('topic') === "Tax Planning")
			@include('question.steps.taxplanning')
		@endif
	</div>
</div>

<!-- JS -->
<script src="{{ asset('js/question.js') }}"></script>

@stop