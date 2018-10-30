<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>How can we help you with your tax planning?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option1" name="step1[]" value="Reduce taxable income">
			<label class="custom-control-label" for="step1-option1">Reduce taxable income</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option2" name="step1[]" value="Increase tax deductions">
			<label class="custom-control-label" for="step1-option2">Increase tax deductions</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option3" name="step1[]" value="Help with tax credits">
			<label class="custom-control-label" for="step1-option3">Help with tax credits</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option4" name="step1[]" value="Do I need to pay estimated taxes?">
			<label class="custom-control-label" for="step1-option4">Do I need to pay estimated taxes?</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option5" name="step1[]" value="None">
			<label class="custom-control-label" for="step1-option5">None of the above</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>Select the types of income you have.</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option1" name="step2[]" value="W2">
			<label class="custom-control-label" for="step2-option1">W-2 Income (I am an employee)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option2" name="step2[]" value="Self-employed">
			<label class="custom-control-label" for="step2-option2">Self-employed income</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option3" name="step2[]" value="Investments">
			<label class="custom-control-label" for="step2-option3">Income from investments (dividends, interest, etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step2-option4" name="step2[]" value="Other unearned income">
			<label class="custom-control-label" for="step2-option4">Other unearned income (Social Security, pension, etc.)</label>
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
	<h3>Select the types of deductions you have.</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option1" name="step3[]" value="Real estate">
			<label class="custom-control-label" for="step3-option1">Real estate (Mortgage interest)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option2" name="step3[]" value="Student loans">
			<label class="custom-control-label" for="step3-option2">Student Loans</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option3" name="step3[]" value="Business expenses">
			<label class="custom-control-label" for="step3-option3">Business expenses</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option4" name="step3[]" value="Medical expenses">
			<label class="custom-control-label" for="step3-option4">Medical expenses</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option5" name="step3[]" value="Investment losses">
			<label class="custom-control-label" for="step3-option5">Investment losses</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option6" name="step3[]" value="None">
			<label class="custom-control-label" for="step3-option6">None of the above</label>
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
	<h3>Do you currently work with other advisors regarding this topic?</h3>
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