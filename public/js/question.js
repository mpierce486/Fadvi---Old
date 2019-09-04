$(document).ready(function() {

    //
    //  Hover and click event for checkboxes and radios
    //

    $('.custom-checkbox').click(function() {
        if ($(this).find('input[type=checkbox]').is(':checked'))
        {
            $(this).find('input[type=checkbox]').prop("checked", false);
        } else {
            $(this).find('input[type=checkbox]').prop("checked", true);
        }
    });

    $('.custom-radio').click(function() {
        if ($(this).find('input[type=radio]').is(':checked'))
        {
            $(this).find('input[type=radio]').prop("checked", false);
        } else {
            $(this).find('input[type=radio]').prop("checked", true);
        }
    });

    // Solve issue where clicking on a radio label doesn't select the radio button
    $('.custom-radio > label').click(function(e) {
        e.preventDefault();
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

        if ($(this).closest('form').attr('id') == "step-4")
        {
            $(this).closest('form').hide();
            $('#step-3').fadeIn(200);
        }

        if ($(this).closest('form').attr('id') == "step-5")
        {
            $(this).closest('form').hide();
            $('#step-4').fadeIn(200);
        }

        if ($(this).closest('form').attr('id') == "step-final")
        {
            $(this).closest('form').hide();
            if ($('#step-5').length)
            {
                $('#step-5').fadeIn(200);
            } else if ($('#step-4').length)
            {
                $('#step-4').fadeIn(200);
            } else if ($('#step-3').length)
            {
                $('#step-3').fadeIn(200);
            } else {
                $('#step-2').fadeIn(200);
            }
            
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
                if ($('#step-2').length)
                {
                    $('#step-2').fadeIn(200);
                } else {
                    $('#step-final').fadeIn(200);
                }
            }
        });
    });

    if ($('#step-2').length)
    {
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
                    if ($('#step-3').length)
                    {
                        $('#step-3').fadeIn(200);
                    } else {
                        $('#step-final').fadeIn(200);
                    }
                }
            });
        });
    }

    if ($('#step-3').length)
    {
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
                    if ($('#step-4').length)
                    {
                        $('#step-4').fadeIn(200);
                    } else {
                        $('#step-final').fadeIn(200);
                    }
                }
            });
        });
    }

    if ($('#step-4').length)
    {
        // Step 4

        $('#step-4').submit(function(e) {
            e.preventDefault();

            var step4 = [];
            
            $("input[name='step4[]']:checked").each(function() {
                
                step4.push($(this).val());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/question/details/4",
                data: {step4:step4},
                error: function(data){
                    // Retrieve errors and append any error messages.
                    var errors = $.parseJSON(data.responseText);
                    
                    if (typeof errors.errors['step4.0'] !== "undefined")
                    {
                        var postError = errors.errors['step4.0'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-4 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    } else if (typeof errors.errors['step4.1'] !== "undefined")
                    {
                        var postError = errors.errors['step4.1'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-4 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    } else if (typeof errors.errors['step4.2'] !== "undefined")
                    {
                        var postError = errors.errors['step4.2'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-4 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    }
                    else if (errors.errors.step4[0])
                    {
                        var postError = errors.errors.step4[0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-4 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    }
                },
                success: function(data) {
                    $('#step-4').hide();
                    if ($('#step-5').length)
                    {
                        $('#step-5').fadeIn(200);
                    } else {
                        $('#step-final').fadeIn(200);
                    }
                }
            });
        });
    }

    if ($('#step-5').length)
    {
        // Step 5

        $('#step-5').submit(function(e) {
            e.preventDefault();

            var step5 = [];
            
            $("input[name='step5[]']:checked").each(function() {
                
                step5.push($(this).val());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/question/details/5",
                data: {step5:step5},
                error: function(data){
                    // Retrieve errors and append any error messages.
                    var errors = $.parseJSON(data.responseText);
                    
                    if (typeof errors.errors['step5.0'] !== "undefined")
                    {
                        var postError = errors.errors['step5.0'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-5 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    } else if (typeof errors.errors['step5.1'] !== "undefined")
                    {
                        var postError = errors.errors['step5.1'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-5 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    } else if (typeof errors.errors['step5.2'] !== "undefined")
                    {
                        var postError = errors.errors['step5.2'][0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-5 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    }
                    else if (errors.errors.step5[0])
                    {
                        var postError = errors.errors.step5[0];
                        var pError = '<h5 class="text-danger">'+postError+'</h5>';
                        $(pError).insertAfter('#step-5 > #custom-checkbox-form-group').delay(3000).fadeOut(function() {
                            $(this).remove();
                        });
                    }
                },
                success: function(data) {
                    $('#step-5').hide();
                    $('#step-final').fadeIn(200);
                }
            });
        });
    }


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
    			console.log(errors.errors.question[0]);
                var postError = errors.errors.question[0];
                var pError = '<h5 class="text-danger">'+postError+'</h5>';
                $(pError).insertAfter('#step-final > .form-group').delay(3000).fadeOut(function() {
                    $(this).remove();
                });
    			
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