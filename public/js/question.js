$(document).ready(function() {

    //
    //  Hover and click event for checkboxes
    //

    $('.custom-checkbox').click(function() {
        if ($(this).find('input[type=checkbox]').is(':checked'))
        {
            $(this).find('input[type=checkbox]').prop("checked", false);
        } else {
            $(this).find('input[type=checkbox]').prop("checked", true);
        }

        
        
    });

    //
    //  Functionality for switching steps in multi-step form
    //

    // Back button

    $('.btn-back').on('click', function() {
        if ($(this).closest('form').attr('id') == "step-2")
        {
            $(this).closest('form').hide();
            $('#step-1').fadeIn(200);
        }

        if ($(this).closest('form').attr('id') == "step-3")
        {
            $(this).closest('form').hide();
            $('#step-2').fadeIn(200);
        }

        if ($(this).closest('form').attr('id') == "step-final")
        {
            $(this).closest('form').hide();
            $('#step-3').fadeIn(200);
        }

    });

    // Step 1

    $('#step-1').submit(function(e) {
        e.preventDefault();

        var step1 = [];
        
        $("input[name='step1[]']:checked").each(function() {
            
            step1.push($(this).val());
        });

        console.log(step1);

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/question/details/1",
            data: {step1:step1},
            error: function(data){
                // Retrieve errors and append any error messages.
                var errors = $.parseJSON(data.responseText);
                console.log(errors);

                if (errors) {
                    var postError = errors;
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('.mce-tinymce').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                console.log(data);
            }
        });

        $(this).hide();
        $('#step-2').fadeIn(200);
    });

    // Step 2

    $('#step-2').submit(function(e) {
        e.preventDefault();

        var step2 = [];
        
        $("input[name='step2[]']:checked").each(function() {
            
            step2.push($(this).val());
        });

        console.log(step2);

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/question/details/2",
            data: {step2:step2},
            error: function(data){
                // Retrieve errors and append any error messages.
                var errors = $.parseJSON(data.responseText);
                console.log(errors);

                if (errors) {
                    var postError = errors;
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('.mce-tinymce').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                console.log(data);
            }
        });

        $(this).hide();
        $('#step-3').fadeIn(200);
    });

    // Step 3

    $('#step-3').submit(function(e) {
        e.preventDefault();

        var step3 = [];
        
        $("input[name='step3[]']:checked").each(function() {
            
            step3.push($(this).val());
        });

        console.log(step3);

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/question/details/3",
            data: {step3:step3},
            error: function(data){
                // Retrieve errors and append any error messages.
                var errors = $.parseJSON(data.responseText);
                console.log(errors);

                if (errors) {
                    var postError = errors;
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('.mce-tinymce').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                console.log(data);
            }
        });

        $(this).hide();
        $('#step-final').fadeIn(200);
    });



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