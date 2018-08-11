@extends('templates.default')

@section('content')

<div class="global-wrapper container">

	<h1 id="question-heading">What is your question regarding <span>{{Session::get('topic') }}</span>?</h1>
	<div class="alert alert-success col-xs-12 col-sm-6 col-sm-offset-3" id="question-submit-success" role="alert">
		Your question has been successfully submitted. Check its status at your profile. </br></br> <strong>Redirecting...</strong>
	</div>
	<div id="question-wrapper" class="col-xs-12 col-sm-6 col-sm-offset-3">
		<h5>Advisors will be able to respond to your question if you give specific detail to support your question.</h5>
		<form role="form" method="post">
			<div class="form-group">
				<textarea class="input-global form-control" name="question-input" id="question-input" rows="5"></textarea>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-default" id="question-submit">Submit</button>
			</div>
		</form>
		<h6>By clicking "Submit", I understand and acknowledge that posting a question on Fadvi will not form an advisor-client relationship. That will happen later when both parties agree to it.</h6>
	</div>
</div>

<!-- JS -->
<script src="{{ asset('js/question.js') }}"></script>

@stop