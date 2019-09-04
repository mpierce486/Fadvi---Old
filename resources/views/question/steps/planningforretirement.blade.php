<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>Have you started setting money aside for your retirement?</h3>
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
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>What type of accounts have you put money into? (Select all that apply)</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option1" name="step2[]" value="Employer Plan">
			<label class="custom-control-label" for="step2-option1">Employer Plan (401(K), 403(b), etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option2" name="step2[]" value="Retirement Accounts">
			<label class="custom-control-label" for="step2-option2">Retirement Accounts (IRA, Roth IRA, etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option3" name="step2[]" value="Taxable Accounts">
			<label class="custom-control-label" for="step2-option3">Taxable Accounts</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option4" name="step2[]" value="Other">
			<label class="custom-control-label" for="step2-option4">Other</label>
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
	<h3>How many years until your ideal retirement?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option1" name="step3[]" value="Less than 5 years">
			<label class="custom-control-label" for="Step3-option1">Less than 5 years</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option2" name="step3[]" value="5 to 10 years">
			<label class="custom-control-label" for="Step3-option2">5 to 10 years</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option3" name="step3[]" value="10 to 20 years">
			<label class="custom-control-label" for="Step3-option3">10 to 20 years</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step3-option4" name="step3[]" value="More than 20 years">
			<label class="custom-control-label" for="Step3-option4">More than 20 years</label>
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