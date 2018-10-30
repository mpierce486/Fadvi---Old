<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>What is your reason for inquiring about estate planning?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option1" name="step1[]" value="Do I need estate planning?">
			<label class="custom-control-label" for="step1-option1">Do I need estate planning?</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option2" name="step1[]" value="Asset transfer to future generations">
			<label class="custom-control-label" for="step1-option2">Asset transfer to future generations</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option3" name="step1[]" value="Minimize taxes">
			<label class="custom-control-label" for="step1-option3">Minimize taxes</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option4" name="step1[]" value="Protect assets">
			<label class="custom-control-label" for="step1-option4">Protect my assets from others</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option5" name="step1[]" value="None">
			<label class="custom-control-label" for="step1-option5">I don't know</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>Do you have any of the following already in place?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option1" name="step2[]" value="Trust">
			<label class="custom-control-label" for="step2-option1">Trust</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option2" name="step2[]" value="Will">
			<label class="custom-control-label" for="step2-option2">Will</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option3" name="step2[]" value="Power of attorney">
			<label class="custom-control-label" for="step2-option3">Power of Attorney</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option5" name="step2[]" value="None">
			<label class="custom-control-label" for="step2-option5">None of the above</label>
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
	<h3>Do you currently work with other advisors regarding this topic?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option1" name="step3[]" value="Yes">
			<label class="custom-control-label" for="Step3-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option2" name="step3[]" value="No">
			<label class="custom-control-label" for="Step3-option2">No</label>
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