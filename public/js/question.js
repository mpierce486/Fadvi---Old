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
                
                if (typeof errors.errors['step1.0'] !== "undefined")
                {
                    var postError = errors.errors['step1.0'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-1 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step1.1'] !== "undefined")
                {
                    var postError = errors.errors['step1.1'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-1 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step1.2'] !== "undefined")
                {
                    var postError = errors.errors['step1.2'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-1 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
                else if (errors.errors.step1[0])
                {
                    var postError = errors.errors.step1[0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-1 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                $('#step-1').hide();
                $('#step-2').fadeIn(200);
            }
        });
    });

    // Step 2

    $('#step-2').submit(function(e) {
        e.preventDefault();

        var step2 = [];
        
        $("input[name='step2[]']:checked").each(function() {
            
            step2.push($(this).val());
        });

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
                
                if (typeof errors.errors['step2.0'] !== "undefined")
                {
                    var postError = errors.errors['step2.0'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-2 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step2.1'] !== "undefined")
                {
                    var postError = errors.errors['step2.1'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-2 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step2.2'] !== "undefined")
                {
                    var postError = errors.errors['step2.2'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-2 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
                else if (errors.errors.step2[0])
                {
                    var postError = errors.errors.step2[0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-2 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                $('#step-2').hide();
                $('#step-3').fadeIn(200);
            }
        });
    });

    // Step 3

    $('#step-3').submit(function(e) {
        e.preventDefault();

        var step3 = [];
        
        $("input[name='step3[]']:checked").each(function() {
            
            step3.push($(this).val());
        });

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
                
                if (typeof errors.errors['step3.0'] !== "undefined")
                {
                    var postError = errors.errors['step3.0'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-3 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step3.1'] !== "undefined")
                {
                    var postError = errors.errors['step3.1'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-3 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                } else if (typeof errors.errors['step3.2'] !== "undefined")
                {
                    var postError = errors.errors['step3.2'][0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-3 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
                else if (errors.errors.step3[0])
                {
                    var postError = errors.errors.step3[0];
                    var pError = '<h5 class="text-danger">'+postError+'</h5>';
                    $(pError).insertAfter('#step-3 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                        $(this).remove();
                    });
                }
            },
            success: function(data) {
                $('#step-3').hide();
                $('#step-final').fadeIn(200);
            }
        });
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