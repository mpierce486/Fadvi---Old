$(document).ready(function(){

	$('.navbar-toggler').click(function() {
		if ($(".navbar").hasClass('scrolled'))
		{
			$('.navbar-collapse').css("background-color", "#f8f8f8");
			$('.navbar-collapse').toggle();
		} else {
			$('.navbar-collapse').css("background-color", "#618f8e");
			$('.navbar-collapse').toggle();
		}
		
	});

	// Navigation CSS change when scrolling down page
	$(function () {
	  $(document).scroll(function () {
	    var $nav = $(".navbar");
	    var $navBrand = $(".navbar-brand");
	    var $navRight = $(".nav-link");
	    var $navToggle = $(".navbar-toggler-icon");
	    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	    $navBrand.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	    $navRight.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	    $navToggle.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	  });
	});

	// Click topic for topic tiles //
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.topics-item').click(function() {
		var topicText = $(this).find('p').text();
		console.log(topicText);

		$.ajax({
    		type: "POST",
    		url: "/main/topic/"+topicText,
    		data: {topicText:topicText},
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			var errors = errors;
    			console.log(errors);
    		},
    		success: function(data) {
    			console.log(data);
    			if (data == "Error")
    			{
    				console.log("Error. Reloading page.");
    				location.reload();
    			}
    			if (data.result == "Success")
    			{
    				console.log("Success. Redirecting page.");
    				window.location.href = data.redirect;
    			}
    		}
		});
	});

	

	/*MODAL TO REGISTER/LOGIN ONCE USER CLICKS ON TOPIC TILES*/

	/*USER CLICKS REGISTER OR LOGIN TITLE IN MODAL*/

	$('#register-modal-login-btn').click(function() {
		$('#register-modal-form input').val('');
		$('#register-modal-form').find('.text-danger').remove();
		$('.modal-body-register').hide();
		$('.modal-body-login').fadeIn();
	});

	$('#register-modal-register-btn').click(function() {
		$('#login-modal-form input').val('');
		$('#login-modal-form').find('.text-danger').remove();
		$('.modal-body-login').hide();
		$('.modal-body-register').fadeIn();
	});

	/*REGISTER FORM IN MODAL WINDOW*/

	$('#register-modal-form').submit(function(e) {
		e.preventDefault();

		var fname = $('#first-name').val();
		var lname = $('#last-name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var cpassword = $('#confirm-password').val();

		// Remove existing error text
		$(this).find('.text-danger').remove();

		$.ajax({
			type: "POST",
			url: "/register",
			data: {first_name:fname, last_name:lname, email:email, password:password, password_confirmation:cpassword},
			error: function(data) {
				var errors = $.parseJSON(data.responseText);
				if (errors.first_name) {
					var ferror = errors.first_name[0];
    				var ferror = '<h5 class="text-danger">'+ferror+'</h5>';
    				$(ferror).insertAfter('#first-name');
				}
				if (errors.last_name) {
					var lerror = errors.last_name[0];
    				var lerror = '<h5 class="text-danger">'+lerror+'</h5>';
    				$(lerror).insertAfter('#last-name');
				}
				if (errors.email) {
					var eerror = errors.email[0];
    				var eerror = '<h5 class="text-danger">'+eerror+'</h5>';
    				$(eerror).insertAfter('#email');
				}
				if (errors.password) {
					var perror = errors.password[0];
    				var perror = '<h5 class="text-danger">'+perror+'</h5>';
    				$(perror).insertAfter('#password');
				}
				if (errors.password_confirmation) {
					var cperror = errors.password_confirmation[0];
    				var cperror = '<h5 class="text-danger">'+cperror+'</h5>';
    				$(cperror).insertAfter('#confirm-password');
				}
			},
			success: function(data) {
				window.location.replace(data);
			}
		});
	});

	/*LOGIN FORM IN MODAL WINDOW*/

	$('#login-modal-form').submit(function(e) {
		e.preventDefault();

		var email = $('.modal-body-login #email').val();
		var password = $('.modal-body-login #password').val();

		$.ajax({
			type: "POST",
			url: "/login",
			data: {email:email, password:password},
			error: function(data) {
				var errors = $.parseJSON(data.responseText);
				console.log(errors);
				if (errors.email[0].length > 0) {
					var eerror = errors.email[0];
    				var eerror = '<h5 class="text-danger">'+eerror+'</h5>';
    				$(eerror).insertAfter('.modal-body-login #email');
				}
				if (errors.password[0].length > 0) {
					var perror = errors.password[0];
    				var perror = '<h5 class="text-danger">'+perror+'</h5>';
    				$(perror).insertAfter('.modal-body-login #password');
				}
			},
			success: function(data) {
				window.location.replace(data);
			}
		});
	});

});