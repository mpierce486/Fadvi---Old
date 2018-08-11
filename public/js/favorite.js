$(document).ready(function() {

	// Initiate Bootstrap popovers
	$(function () {
		$('[data-toggle="popover"]').popover()
	})

	// Add advisor to favorites
	$(document).on('click', '.advisor-favorite', function() {

		// Set loading gif as button text
		$(this).find('.static').hide();
		$(this).find('.loading').show();

		var username = $(this).closest('.local-results-item').find('img').attr("data-id");
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/favorites/add/"+username,
			data: {username:username},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				alert("There was an error! Page reloading.");
				location.reload();
			},
			success: function(data) {
				console.log(data);

				if (data === "Advisor does not exist." || data === "You have already saved this advisor.")
				{
					var saveBtn = $('img[data-id="'+username+'"').closest('.local-results-item').find('.advisor-favorite');
					$(saveBtn).
						attr({
							'data-toggle' : 'popover',
							'data-content' : data,
							'data-container' : 'body',
						}).popover('show');
					// Set timeout on popover	
					setTimeout(function () {
			            $('.popover').fadeOut('slow');
			        }, 1000);
					
					$(this).find('.loading').hide();
			        $(this).find('.static').show();
				}

				if (data === "Advisor saved!")
				{
					var saveBtn = $('img[data-id="'+username+'"').closest('.local-results-item').find('.advisor-favorite');
					$(saveBtn).find('.loading').hide();
					$(saveBtn).find('.static-conf').show();
					setTimeout(function () {
			            $(saveBtn).find('.static-conf').hide().parent().find('.static-opp').show();
			            //Change button class to advisor-favorite
						$(saveBtn).addClass('remove-advisor-favorite').removeClass('advisor-favorite');
						$(saveBtn).find('.static').text("Unfavorite");
						$(saveBtn).find('.static-conf').text("Removed!");
						$(saveBtn).find('.static-opp').text("Save");

						$(saveBtn).find('.static-opp').hide().parent().find('.static').show();
			        }, 1000);
				}
			}
		});
	});

	// Remove advisor from favorites
	$(document).on('click', '.remove-advisor-favorite', function() {

		// Set loading gif as button text
		$(this).find('.static').hide();
		$(this).find('.loading').show();

		var username = $(this).closest('.local-results-item').find('img').attr("data-id");
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/favorites/remove/"+username,
			data: {username:username},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				alert("There was an error! Page reloading.");
				location.reload();
			},
			success: function(data) {
				console.log(data);
				if (data === "Advisor does not exist." || data === "Advisor not in favorites.")
				{
					var removeBtn = $('img[data-id="'+username+'"').closest('.local-results-item').find('.remove-advisor-favorite');
					$(removeBtn).
						attr({
							'data-toggle' : 'popover',
							'data-content' : data,
							'data-container' : 'body',
						}).popover('show');
					// Set timeout on popover	
					setTimeout(function () {
			            $('.popover').fadeOut('slow');
			        }, 1000);

			        $(this).find('.loading').hide();
			        $(this).find('.static').show();
				}
					
				if (data === "Advisor removed!")
				{
					var removeBtn = $('img[data-id="'+username+'"').closest('.local-results-item').find('.remove-advisor-favorite');
					$(removeBtn).find('.loading').hide();
					$(removeBtn).find('.static-conf').show();
					setTimeout(function () {
			            $(removeBtn).find('.static-conf').hide().parent().find('.static-opp').show();
			            //Change button class to advisor-favorite
						$(removeBtn).addClass('advisor-favorite').removeClass('remove-advisor-favorite');
						$(removeBtn).find('.static').text("Save");
						$(removeBtn).find('.static-conf').text("Saved!");
						$(removeBtn).find('.static-opp').text("Unfavorite");

						$(removeBtn).find('.static-opp').hide().parent().find('.static').show();
			        }, 1000);
					
				}
			}
		});
	});

});