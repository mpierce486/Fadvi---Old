<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>Step 1</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option1" name="step1[]" value="Less than $50,000">
			<label class="custom-control-label" for="step1-option1">Option 1</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option2" name="step1[]" value="$50,000-$100,000">
			<label class="custom-control-label" for="step1-option2">Option 2</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option3" name="step1[]" value="More than $100,000">
			<label class="custom-control-label" for="step1-option3">Option 3</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>Step 2</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option1" name="step2[]" value="Step2-option1">
			<label class="custom-control-label" for="step2-option1">Option 1</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option2" name="step2[]" value="Step2-option2">
			<label class="custom-control-label" for="step2-option2">Option 2</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option3" name="step2[]" value="Step2-option3">
			<label class="custom-control-label" for="step2-option3">Option 3</label>
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
	<h3>Step 3</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="Step3-option1" name="step3[]" value="Step3-option1">
			<label class="custom-control-label" for="Step3-option1">Option 1</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="Step3-option2" name="step3[]" value="Step3-option2">
			<label class="custom-control-label" for="Step3-option2">Option 2</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="Step3-option3" name="step3[]" value="Step3-option3">
			<label class="custom-control-label" for="Step3-option3">Option 3</label>
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