$(document).ready(function(){

	// 	==============================
	//	SCROLL TO BOTTOM ON PAGE LOAD 
	//	==============================
	
  	$("html, body").animate({ scrollTop: $(document).height() }, 0);

  	//
  	//	Question details collapse functionality
  	//

  	$('#question-details-icon span').click(function() {
		$('#question-details').slideToggle();
  	});

	// 	==============================
	//	LARAVEL ECHO LISTENING EVENT 
	//	==============================

	var dId = $('#discussion-input-form').find('.hidden').attr("data-id");

	// Declare global timer variable
	var timer = "";

	window.Echo.private('discussion.' + dId)
	    .listen('DiscussionUpdate', (e) => {
	        console.log(e);

	        // User posting this comment is the user
	        if (e.discussion.user_id == e.post.user_id)
	        {
	        	var postHtmlUser = [
	        		'<div class="discussion-post-wrapper col-sm-12 col-md-12 col-lg-12">'+
	        		'	<div class="discussion-post-content-user col-xs-12 col-sm-5">'+
	        		'		<h4>'+e.post.post+'</h4>'+
	        		'	</div>'+
	        		'	<div class="discussion-post-name-user">'+
	        		'		<h5>'+e.posterName+'</h5>'+
	        		'		<h6>'+e.postTime+'</h6>'+
	        		'	</div>'+
	        		'</div>'
				].join('');

				$(postHtmlUser).insertBefore('#email-notifications');
	        }

	        // User posting this comment is the advisor
	        if (e.discussion.user_id != e.post.user_id)
	        {
	        	var postHtmlAdvisor = [
	        		'<div class="discussion-post-wrapper col-sm-12 col-md-12 col-lg-12">'+
	        		'	<div class="discussion-post-content-advisor float-right col-xs-12 col-sm-5">'+
	        		'		<h4>'+e.post.post+'</h4>'+
	        		'	</div>'+
	        		'	<div class="discussion-post-name-advisor">'+
	        		'		<h5>'+e.posterName+'</h5>'+
	        		'		<h6>'+e.postTime+'</h6>'+
	        		'	</div>'+
	        		'</div>'
				].join('');

				$(postHtmlAdvisor).insertBefore('#email-notifications');
	        }
    	})

	    // Listening for the Pusher whisper notification while user is typing
    	.listenForWhisper("typing", e => {
    		$('#typing-notification').text(e.name+" is typing...");
    		$('#typing-notification').show();
    		
			if (timer)
			{
				clearTimeout(timer);
			}
			
			timer = setTimeout(() => {
							$('#typing-notification').hide();
						}, 3000);
    	});

    // 	==============================
	//	LARAVEL ECHO CLIENT TO CLIENT WHISPER 
	//	==============================



    //	==============================
	// 	CHECK IF NEWDISCUSSION BOOLEAN 
	//	IS PRESENT AND INITIATE 
	//	SWEETALERT IF IT IS
	//	==============================

	if ($('#newDiscussion').length > 0)
	{
		swal({
		  title: 'Discussion Created!',
		  html: '<br><h6 style="text-align:justify">You have started a discussion with this advisor! The advisor has been notified and will respond soon.</h6><h6 style="text-align:justify">Please remember, a discussion is a confidential way for you and the advisor to share information regarding a particular topic. Please keep in mind that no personally-identifiable information should be given or requested through a discussion. If you both feel it is appropriate, arrange communication outside of Fadvi to receive more personalized advice.</h6>',
		  type: 'success',
		  confirmButtonText: 'Dismiss'
		})
	}

	// POST IN DISCUSSION

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
				console.log(errors.errors.post);

				if (errors) {
					var postError = errors.errors.post;
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
					var successMsg = '<h5 class="text-success">'+data+'</h5>';
    				$(successMsg).insertAfter('#email-notifications > .form-check').delay(3000).fadeOut(function() {
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
					var successMsg = '<h5 class="text-danger">'+data+'</h5>';
    				$(successMsg).insertAfter('#email-notifications > .form-check').delay(3000).fadeOut(function() {
    					$(this).remove();
    				});
				}
			});
		}

	});

});