$(document).ready(function() {

	$('#user-btn').click(function() {
		$('#advisor-register-form').hide();
		$('#user-register-form').show();
	});

	$('#advisor-btn').click(function() {
		$('#user-register-form').hide();
		$('#advisor-register-form').show();
	});

	// If there is an input error in the form make the form visible immediately
	if ($('#user-register-form').find('.help-block').length > 0)
	{
		$('#user-register-form').show();
	}

	if ($('#advisor-register-form').find('.help-block').length > 0)
	{
		$('#advisor-register-form').show();
	}

});