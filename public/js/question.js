$(document).ready(function() {

	// Submit event for posting a question

	$('#question-submit').click(function() {
        
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var question = $('#question-input').val();

		$.ajax({
    		type: "POST",
    		url: "/question/submit",
    		data: {question:question},
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			
    		},
    		success: function(data) {
                console.log(data);
                if (data.result === "Success")
                {
                	$('#question-submit-success').show();
                    setTimeout(function() {
                        window.location.href = data.redirect;
                    }, 3000);
                }
    		}
		});

	});

});