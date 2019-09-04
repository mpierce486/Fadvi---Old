<!-- FORM 1 -->

<form role="form" id="step-1" class="question-form">
	<h3>Do you currently work with or have you worked with a financial planner before?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step1-option1" name="step1[]" value="Yes">
			<label class="custom-control-label" for="Step1-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step1-option2" name="step1[]" value="No">
			<label class="custom-control-label" for="Step1-option2">No</label>
		</div>
	</div>
	<div class="row">
		<div class="form-group text-center col">
			<button type="button" class="btn btn-default btn-back">Back</button>
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
	</div>
</form>

<form role="form" method="post" id="step-final" class="question-form">
	<h5>Advisors will be able to respond to your question if you give specific detail to support your question.</h5>
	<div class="form-group">
		<textarea class="input-global form-control" name="question-input" id="question-input" rows="5"></textarea>
	</div>
	<div class="row">
		<div class="form-group text-center col">
			<button type="button" class="btn btn-default btn-back">Back</button>
			<button type="button" class="btn btn-primary" id="question-submit">Submit</button>
		</div>
	</div>
</form>
<p class="text-center font-weight-light">By clicking "Submit", I understand and acknowledge that posting a question on Fadvi will not form an advisor-client relationship. That will happen later when both parties agree to it.</p>