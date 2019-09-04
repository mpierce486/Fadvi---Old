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

	// Switching between Topics and Life Event tiles
	$('#life-events-toggle, #topics-toggle').click(function() {
		if ($('#topics-wrapper').is(':visible'))
		{
			$('#topics-wrapper').fadeOut(200);
			$('#life-events-toggle').fadeOut(200);
			window.setTimeout(function () {
				$('#life-events-wrapper').css('display', 'flex').hide().fadeIn();
				$('#topics-toggle').fadeIn();
			}, 200);
		} else {
			$('#life-events-wrapper').fadeOut(200);
			$('#topics-toggle').fadeOut(200);
			window.setTimeout(function () {
				$('#topics-wrapper').css('display', 'flex').hide().fadeIn();
				$('#life-events-toggle').fadeIn();
			}, 200);
		}
	});

	// Toggling the Main Middle Wrapper Collapse event when clicking on a topic
	$('.topics-item').on('click', function() {
		// Replace main middle left text with name of topic/life event
		var topic = $(this).find('p').text();
		$('#middle-left-sub-header > strong > span').text(topic);
		
		$('#middleCollapse').collapse('show');
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
    				alert("Error. Reloading page.");
    				location.reload();
    			}
    			if (data.result == "Success")
    			{
    				console.log("Success");
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
		var ageRange = $('#age-range').find(":selected").attr('value');
		var email = $('#email').val();
		var password = $('#password').val();
		var cpassword = $('#confirm-password').val();

		

		$.ajax({
			type: "POST",
			url: "/register",
			data: {first_name:fname, last_name:lname, age_range:ageRange, email:email, password:password, password_confirmation:cpassword},
			error: function(data) {
				// Remove existing is-invalid class from all elements
				$('#register-modal-form input, #register-modal-form select').removeClass('is-invalid');
				
				// Remove existing error text
				$('#register-modal-form').find('.text-danger').remove();

				var errors = $.parseJSON(data.responseText);
				if (errors.errors.first_name) {
					var ferror = errors.errors.first_name[0];
    				var ferror = '<p class="text-danger">'+ferror+'</p>';
    				$('#first-name').addClass('is-invalid');
    				$(ferror).insertAfter('#first-name');
				}
				if (errors.errors.last_name) {
					var lerror = errors.errors.last_name[0];
    				var lerror = '<p class="text-danger">'+lerror+'</p>';
    				$('#last-name').addClass('is-invalid');
    				$(lerror).insertAfter('#last-name');
				}
				if (errors.errors.age_range) {
					var lerror = errors.errors.age_range[0];
    				var lerror = '<p class="text-danger">'+lerror+'</p>';
    				$('#age-range').addClass('is-invalid');
    				$(lerror).insertAfter('#age-range');
				}
				if (errors.errors.email) {
					var eerror = errors.errors.email[0];
    				var eerror = '<p class="text-danger">'+eerror+'</p>';
    				$('#email').addClass('is-invalid');
    				$(eerror).insertAfter('#email');
				}
				if (errors.errors.password) {
					var perror = errors.errors.password[0];
    				var perror = '<p class="text-danger">'+perror+'</p>';
    				$('#password').addClass('is-invalid');
    				$(perror).insertAfter('#password');
				}
				if (errors.errors.password_confirmation) {
					var cperror = errors.errors.password_confirmation[0];
    				var cperror = '<p class="text-danger">'+cperror+'</p>';
    				$('#confirm-password').addClass('is-invalid');
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