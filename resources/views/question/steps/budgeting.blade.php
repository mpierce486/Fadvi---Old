<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>Have you created a budget for yourself?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step1-option1" name="step1[]" value="Yes">
			<label class="custom-control-label" for="step1-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step1-option2" name="step1[]" value="No">
			<label class="custom-control-label" for="step1-option2">No</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>Do you struggle with the paycheck-to-paycheck cycle?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option1" name="step2[]" value="Yes">
			<label class="custom-control-label" for="step2-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option2" name="step2[]" value="No">
			<label class="custom-control-label" for="step2-option2">No</label>
		</div>
	</div>
	<div class="row">
		<div class="form-group text-center col">
			<button type="button" class="btn btn-default btn-back">Back</button>
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
	</div>
</form>

<form role="form" id="step-3" class="question-form">
	<h3>What is your monthly take-home pay?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option1" name="step3[]" value="Less than $2,000">
			<label class="custom-control-label" for="step3-option1">Less than $2,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option2" name="step3[]" value="$2,000 to $4,000">
			<label class="custom-control-label" for="step3-option2">$2,000 to $4,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option3" name="step3[]" value="$4,000 to $6,000">
			<label class="custom-control-label" for="step3-option3">$4,000 to $6,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option4" name="step3[]" value="More than $6,000">
			<label class="custom-control-label" for="step3-option4">More than $6,000</label>
		</div>
	</div>
	<div class="row">
		<div class="form-group text-center col">
			<button type="button" class="btn btn-default btn-back">Back</button>
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
	</div>
</form>

<form role="form" id="step-4" class="question-form">
	<h3>Do you currently work with or have you worked with a financial planner before?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step4-option1" name="step4[]" value="Yes">
			<label class="custom-control-label" for="Step4-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step4-option2" name="step4[]" value="No">
			<label class="custom-control-label" for="Step4-option2">No</label>
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