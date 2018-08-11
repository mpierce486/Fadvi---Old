$(document).ready(function() {

	// Click event for main navigation tabs and corresponding content section
	$('.nav-link').on('click', function() {
		$('.nav-link').removeClass('active');
		$(this).addClass('active');

		var title = $(this).parent('.nav-item').attr('data-title');

		$('.main-content > .content-section').hide();
		$('.main-content').find('#'+title+'').show();
	});

	//
	// BEGIN QUESTION RESPONSE FUNCTIONALITY
	//

	$('.response-input-form').on('submit', function(e) {
		e.preventDefault();

		var questionId = $(this).parent().find('span.hidden').attr('data-id');

		var response = tinymce.get('response-form-input-'+questionId).getContent();

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/question/response/"+questionId,
			data: {response:response},
			error: function(data){
				// Retrieve errors and append any error messages.
				var errors = $.parseJSON(data.responseText);
				
				var responseError = errors.errors.response;
				var rError = '<h5 class="text-danger">'+responseError+'</h5>';
				$(rError).insertAfter('#response-form-input-'+questionId).delay(3000).fadeOut(function() {
    				$(this).remove();
    			});
			},
			success: function(data) {
				
				$('#response-input-form-'+questionId).parent().find('.question-details-overlay').css('display', 'flex');
				setTimeout(function() {
					location.reload();
				}, 3000);
			}
		});
	});

	//
	// END QUESTION RESPONSE FUNCTIONALITY
	//

	//
	// EDIT PROFILE AJAX FUNCTIONS
	//

	// BEGIN EDIT EMAIL SECTION

	// Toggle edit email form.
	$('#edit-email-toggle').on('click', function() {
		$('#content-edit-email').toggle();
	});

	// Desable form submission on pressing 'Enter'.
	$('#edit-email-form').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
			e.preventDefault();
			return false;
		}
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#email-form-submit').on('click', function() {

		var email = $('#edit-email-form > input').val();

		$.ajax({
			type: "POST",
			url: "/profile/edit/email",
			data: {email:email},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors;
				if (errors.email)
				{
					console.log("email");
					var errorsAppend = '<h5 class="text-danger">'+errors[0]+'</h5>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('#edit-email-form').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
			},
			success: function(data) {
				var successAppend = '<h5 class="text-success">Email changed!</h5>';
				$(successAppend).insertAfter('#edit-email-form').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
			}
		});
	});

	// END EDIT EMAIL SECTION

	// BEGIN EDIT PASSWORD SECTION

	// Toggle edit PASSWORD form.
	$('#edit-password-toggle').on('click', function() {
		$('#content-edit-password').toggle();
	});

	// Disable form submission on pressing 'Enter'.
	$('#edit-password-form').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
			e.preventDefault();
			return false;
		}
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#password-form-submit').on('click', function() {

		var password = $('#edit-password-form > #password-input').val();
		var cpassword = $('#edit-password-form > #confirm-password-input').val();

		$.ajax({
			type: "POST",
			url: "/profile/edit/password",
			data: {password:password, password_confirmation:cpassword},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors;
				if (errors.password)
				{
					var errorsAppend = '<h5 class="text-danger">'+errors.password[0]+'</h5>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('#edit-password-form').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
				if (errors.password_confirmation)
				{
					var errorsAppend = '<h5 class="text-danger">'+errors.password_confirmation[0]+'</h5>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('#edit-password-form').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
			},
			success: function(data) {
				var successAppend = '<h5 class="text-success">Password changed!</h5>';
				$(successAppend).insertAfter('#edit-password-form').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
			}
		});
	});

	// END EDIT PASSWORD SECTION	

		
});