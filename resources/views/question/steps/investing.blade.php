<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>Select the types of investments you have questions about. (Select all that apply)</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option1" name="step1[]" value="Equities (Stocks)">
			<label class="custom-control-label" for="step1-option1">Equities (Stocks)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option2" name="step1[]" value="Fixed Income (Bonds)">
			<label class="custom-control-label" for="step1-option2">Fixed Income (Bonds)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option3" name="step1[]" value="Real Estate">
			<label class="custom-control-label" for="step1-option3">Real Estate</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option4" name="step1[]" value="Commodities">
			<label class="custom-control-label" for="step1-option4">Commodities (oil, gold. etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option5" name="step1[]" value="Other">
			<label class="custom-control-label" for="step1-option5">Other</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>What do your current investments amount to?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option1" name="step2[]" value="Less than $10,000">
			<label class="custom-control-label" for="step2-option1">Less than $10,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option2" name="step2[]" value="$10,000 to $50,000">
			<label class="custom-control-label" for="step2-option2">$10,000 to $50,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option3" name="step2[]" value="$50,000 to $100,000">
			<label class="custom-control-label" for="step2-option3">$50,000 to $100,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option4" name="step2[]" value="Over $100,000">
			<label class="custom-control-label" for="step2-option4">Over $100,000</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option5" name="step2[]" value="None">
			<label class="custom-control-label" for="step2-option5">I do not currently have any investments</label>
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
	<h3>What types of accounts are your investments in? (Select all that apply)</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option1" name="step3[]" value="Employer Plan (401(K), 403(b), etc.)">
			<label class="custom-control-label" for="step3-option1">Employer Plan (401(K), 403(b), etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option2" name="step3[]" value="Retirement Accounts (IRA, Roth IRA, etc.)">
			<label class="custom-control-label" for="step3-option2">Retirement Accounts (IRA, Roth IRA, etc.)</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option3" name="step3[]" value="Taxable Accounts">
			<label class="custom-control-label" for="step3-option3">Taxable Accounts</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step3-option4" name="step3[]" value="Other">
			<label class="custom-control-label" for="step3-option5">Other</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-4" class="question-form">
	<h3>Do you currently work with or have you worked with a financial planner before?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step4-option1" name="step4[]" value="Yes">
			<label class="custom-control-label" for="Step3-option1">Yes</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="Step4-option2" name="step4[]" value="No">
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