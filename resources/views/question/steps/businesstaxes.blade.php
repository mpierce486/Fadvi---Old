<!-- FORM 1 -->
<form role="form" id="step-1" class="question-form">
	<h3>What can we help you with regarding business taxes?</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option1" name="step1[]" value="Filing a return">
			<label class="custom-control-label" for="step1-option1">Filing a return</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option2" name="step1[]" value="Amending a return">
			<label class="custom-control-label" for="step1-option2">Amending a return</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option3" name="step1[]" value="I am being audited">
			<label class="custom-control-label" for="step1-option3">I am being audited</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option4" name="step1[]" value="Discuss business structure">
			<label class="custom-control-label" for="step1-option4">Discuss business structure</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="step1-option5" name="step1[]" value="None of the above">
			<label class="custom-control-label" for="step1-option5">None of the above</label>
		</div>
	</div>
	<div class="form-group text-center col">
		<button type="submit" class="btn btn-primary">Next</button>
	</div>
</form>

<form role="form" id="step-2" class="question-form">
	<h3>Select your business structure.</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option1" name="step2[]" value="Sole proprietor">
			<label class="custom-control-label" for="step2-option1">Sole proprietor</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option2" name="step2[]" value="Partnership">
			<label class="custom-control-label" for="step2-option2">Partnership</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option3" name="step2[]" value="LLC">
			<label class="custom-control-label" for="step2-option3">Limited liability company (LLC)</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option4" name="step2[]" value="Corporation">
			<label class="custom-control-label" for="step2-option4">Corporation (C, S, or B Corp)</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option5" name="step2[]" value="Nonprofit">
			<label class="custom-control-label" for="step2-option5">Nonprofit</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step2-option6" name="step2[]" value="None">
			<label class="custom-control-label" for="step2-option6">None of the above</label>
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
	<h3>How many persons are in your organization.</h3>
	<div class="form-group" id="custom-checkbox-form-group">
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option1" name="step3[]" value="1 to 10">
			<label class="custom-control-label" for="step3-option1">1 to 10</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option2" name="step3[]" value="10 to 50">
			<label class="custom-control-label" for="step3-option2">10 to 50</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option3" name="step3[]" value="50 to 100">
			<label class="custom-control-label" for="step3-option3">50 to 100</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option4" name="step3[]" value="More than 100">
			<label class="custom-control-label" for="step3-option4">More than 100</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="step3-option5" name="step3[]" value="None">
			<label class="custom-control-label" for="step3-option5">None of the above</label>
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