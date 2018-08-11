$(document).ready(function() {

	
	

	// Contact modal trigger functionality
	$('.advisor-contact').on('click', function() {

		// Set advisor information to variables. Will be used to update the contact modal details.
		var advisorImgSrc = $(this).closest('.local-results-item').find('img').attr('src');
		var advisorId = $(this).closest('.local-results-item').find('img').attr('data-id');
		var advisorName = $(this).closest('.local-results-item').find('.results-item-name > strong').text();
		var advisorTitle = $(this).closest('.local-results-item').find('.results-item-title').text();
		var advisorCompany = $(this).closest('.local-results-item').find('.results-item-company').text();
		var advisorAddress = $(this).closest('.local-results-item').find('.results-item-address').text();
		
		// Set HTML for advisor information to be appended to modal header
		var advisor = [	
						'<h3 class="modal-title">Contact '+advisorName+'</h3>'+
						'<div class="results-item-img"><img src="'+advisorImgSrc+'" data-id="'+advisorId+'" class="modal-contact-img" /></div>'+
						'<div class="results-item-personal">'+
						'<h5 class="results-item-title">'+advisorTitle+'</h5>'+
						'<h6 class="results-item-company">'+advisorCompany+'</h6>'+
						'<h6 class="results-item-address">'+advisorAddress+'</h6>'+
						'</div>'
					].join();

		$('#contact-modal').find('.modal-header').append(advisor);

		// Show modal body
		$('.modal-body').show();

		// Populate the multi select box in the contact modal
		advisorEvents = [];
		$(this).closest('.local-results-item').find('#advisor-topics > p').each(function() {
			advisorEvents.push($(this).text());
		});
		// Loop through advisorEvents array and add to multi select box
		$.each(advisorEvents, function(index, val) {
			$('#contact-topics').append('<option value="'+val+'">'+val+'</option>');
		});

		// Show the form and submission buttons in modal
		$('#contact-form').show();
		$('#footer-submit').show();
		// Hide the confirmation view and close button
		$('#contact-confirm-view').hide();
		$('#footer-confirm').hide(); 

	});

	// Clear advisor information once contact modal is hidden
	$('#contact-modal').on('hidden.bs.modal', function() {
		$('#contact-modal').find('.modal-header').empty();
		// Clear options from multi select box in contact modal
		$('#contact-topics option').each(function(index, option) {
			$(option).remove();
		});
		// Clear body content in TinyMCE editor
		tinymce.get('advisor-contact-input').setContent('');
		
	});
		
	// CONTACT FORM SUBMISSION //

	$('#contact-submit').on('click', function() {
		// Set variables to be submitted
		var advisor = $(this).closest('.modal-dialog').find('img').attr('data-id');
		var summary = tinymce.get('advisor-contact-input').getContent();
		
		// Push topics in multi select box to array
		var topics = [];
		$('#contact-topics option:selected').each(function() {
			topics.push($(this).text());
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/contact/"+advisor,
			data: {advisor:advisor, summary:summary, topics:topics},
			error: function(data){
				// Retrieve errors and append any error messages.
				var errors = $.parseJSON(data.responseText);
				console.log(errors);

				if (errors.summary) {
					var sumerror = errors.summary[0];
    				var serror = '<h5 class="text-danger">'+sumerror+'</h5>';
    				$(serror).insertAfter('#advisor-contact-input').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
				if (errors.topics) {
					var topicerror = errors.topics[0];
    				var toperror = '<h5 class="text-danger">'+topicerror+'</h5>';
    				$(toperror).insertAfter('#contact-topics').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
			},
			success: function(data) {
				if (data.confirm)
				{
					// Find the discussion page link in the confirmation and add the URL
					$('#contact-confirm-view').find('#contact-confirm-link').attr('href', "/discussion/"+data.id);

					// Hide form and footer submission buttons
					$('#contact-form').hide();
					$('#footer-submit').hide();
					// Show confirmation view and close button
					$('#contact-confirm-view').show();
					$('#footer-confirm').show();
				}
			}
		});

	});

		

});