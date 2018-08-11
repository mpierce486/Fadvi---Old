$(document).ready(function(){

	// POST COMMENT IN DISCUSSION

	$('#discussion-input-form').on('submit', function(e) {
		e.preventDefault();

		var discussionId = $(this).find('span.hidden').attr('data-id');

		var post = tinymce.get('discussion-form-input').getContent();

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/discussion/"+discussionId,
			data: {post:post},
			error: function(data){
				// Retrieve errors and append any error messages.
				var errors = $.parseJSON(data.responseText);
				console.log(errors);

				if (errors.post) {
					var postError = errors.post[0];
    				var pError = '<h5 class="text-danger">'+postError+'</h5>';
    				$(pError).insertAfter('.mce-tinymce').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
				}
			},
			success: function(data) {
				location.reload();
			}
		});
	});

	// EMAIL NOTIFICATION TOGGLE
	$('#email-notification-check').change(function() {

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var discussionId = $('#discussion-input-form').find('span.hidden').attr('data-id');

		if (this.checked)
		{
			$.ajax({
				type: "POST",
				url: "/discussion/notification/"+discussionId,
				data: {toggle:1},
				error: function(data){
					// Retrieve errors and append any error messages.
					var errors = $.parseJSON(data.responseText);
					console.log(errors);
					if (errors) {
						location.reload();
					}
				},
				success: function(data) {
					var successMsg = '<h5 class="text-success col-xs-12 col-sm-8 col-sm-offset-2">'+data+'</h5>';
    				$(successMsg).insertAfter('#email-notifications').delay(3000).fadeOut(function() {
    					$(this).remove();
    				});
				}
			});
		} else {
			$.ajax({
				type: "POST",
				url: "/discussion/notification/"+discussionId,
				data: {toggle:0},
				error: function(data){
					// Retrieve errors and append any error messages.
					var errors = $.parseJSON(data.responseText);
					console.log(errors);
					if (errors) {
						location.reload();
					}
				},
				success: function(data) {
					var successMsg = '<h5 class="text-danger col-xs-12 col-sm-8 col-sm-offset-2">'+data+'</h5>';
    				$(successMsg).insertAfter('#email-notifications').delay(3000).fadeOut(function() {
    					$(this).remove();
    				});
				}
			});
		}

	});

});