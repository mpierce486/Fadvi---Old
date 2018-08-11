$(document).ready(function() {

	// Check boxes in category form for each advisor type search result

	if ($('#results-FA').length > 0)
	{
		$('.cat_check_box[value="Financial Advisor"]').prop('checked', true);
	}

	if ($('#results-EPA').length > 0)
	{
		$('.cat_check_box[value="Estate Planning Attorney"]').prop('checked', true);
	}

	if ($('#results-CPA').length > 0)
	{
		$('.cat_check_box[value="Certified Public Accountant"]').prop('checked', true);
	}

	// If multiple advisor types in results
	// only make first one visible and 
	// hide the others.

	$('.local-advisor-results').find('.results-advisor-type').first().show();

	// When clicking other advisor types in 
	// the nav menu, toggle to that type
	// and hide the others.

	$('.local-advisor-results>.nav-tabs>li').on('click', function() {
		var title = $(this).attr("title");
		
		$('.local-advisor-results').find('ul').find('li').removeClass('active');
		$(this).addClass('active');
		$('.local-advisor-results').find('.results-advisor-type').hide();
		$('.local-advisor-results').find("#"+title).show();
	});

	//
	//	BEGIN FILTER SECTION
	//
		// Add hover styling effect
		$('.li-filter').hover(function() {
			$(this).addClass('li-filter-hover');
		}, function() {
			$(this).removeClass('li-filter-hover');
		});

		// Add active class to li-filters when clicked
		$('.li-filter').click(function() {
			if ($(this).hasClass('li-filter-hover'))
			{
				$(this).removeClass('li-filter-hover');
			}

			if ($(this).hasClass('li-filter-active'))
			{
				$(this).removeClass('li-filter-active');
				// Code to check the input checkbox associated with the filter
				var filterText = $(this).text();
				$('.result-filters > form').find('input[value="'+filterText+'"]').attr('checked', false);
			} else {
				$(this).addClass('li-filter-active');
				// Code to check the input checkbox associated with the filter
				var filterText = $(this).text();
				$('.result-filters > form').find('input[value="'+filterText+'"]').attr('checked', true);
			}
		});


	//
	//	END FILTER SECTION
	//


	//
	//  Scripts for Google Maps markers and click events
	//

	var markers = [];

	$('.local-results-item:visible').each(function(n) {
		markers.push({
			0: $(this).find('.results-coord-lat').html(),
			1: $(this).find('.results-coord-long').html()
		});
	});

	function initializeMaps() {
	    var latlng = new google.maps.LatLng(Number(markers[0][0]), Number(markers[0][1]));
	    var myOptions = {
	        zoom: 10,
	        center: latlng,
	        mapTypeId: google.maps.MapTypeId.ROADMAP,
	        mapTypeControl: false,
	    };
	    var map = new google.maps.Map(document.getElementById("map"),myOptions);
	    var infowindow = new google.maps.InfoWindow(), marker, i;
	    for (i = 0; i < markers.length; i++) {  
	        marker = new google.maps.Marker({
	            position: new google.maps.LatLng(Number(markers[i][0]), Number(markers[i][1])),
	            map: map
	        });
	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
	            	// Get coordinates of clicked marker
	            	var marker_lat = markers[i][0];
	            	var marker_lng = markers[i][1];
	            	// Find the parent 'local-results-item' and set as variable
	            	clicked_marker = $('.results-coord:contains("'+marker_lat+'"):contains("'+marker_lng+'")').parent();
	            	// Assign attributes to variables for info window.
	            	var marker_img = clicked_marker.find('img').prop('src');
	            	var marker_name = clicked_marker.find('.results-item-name>strong').html();
	            	var marker_title = clicked_marker.find('.results-item-title').html();
	            	var marker_company = clicked_marker.find('.results-item-company').html();
	            	var marker_address = clicked_marker.find('.results-item-address').html();

	            	var contentString = '<div class="infowindow">'+
										  '<div class="info-img">'+
										    '<img src="'+marker_img+'" class="img-responsive"/>'+
										  '</div>'+
										  '<div class="info-personal">'+
										    '<h3 class="info-personal-name">'+marker_name+'</h3>'+
										    '<h5 class="info-personal-title">'+marker_title+'</h5>'+
										    '<h6 class="info-personal-company">'+marker_company+'</h6>'+
										    '<h6 class="info-personal-address">'+marker_address+'</h6>'+
										  '</div>'+
										'</div>';

	                infowindow.setContent(contentString);
	                infowindow.open(map, marker);
	            }
	        })(marker, i));
	        // Sets the markers as the array instead of just lats / longs.
	        markers[i][2] = marker;
	    }

	    $('.local-advisor-results').find('ul').find('li').on('click', function() {

			// Deletes all markers in the array by removing references to them.
			(function deleteMarkers() {
				for (var i = 0; i < markers.length; i++) {
					markers[i][2].setMap(null);
				}
				markers.length = 0;
			}());

			// For each visible advisor result, pushes its lats/longs to an array to be used for the markers on the map.
			$('.local-results-item:visible').each(function(n) {
				markers.push({
					0: $(this).find('.results-coord-lat').html(),
					1: $(this).find('.results-coord-long').html()
				});
			});

			for (i = 0; i < markers.length; i++) {  
		        marker = new google.maps.Marker({
		            position: new google.maps.LatLng(Number(markers[i][0]), Number(markers[i][1])),
		            map: map
		        });
		        google.maps.event.addListener(marker, 'click', (function(marker, i) {
		            return function() {
		            	// Get coordinates of clicked marker
		            	var marker_lat = markers[i][0];
		            	var marker_lng = markers[i][1];

		            	// Find the parent 'local-results-item' and set as variable
		            	clicked_marker = $('.results-coord:contains("'+marker_lat+'"):contains("'+marker_lng+'")').parent();
		            	// Assign attributes to variables for info window.
		            	var marker_img = clicked_marker.find('img').prop('src');
		            	var marker_name = clicked_marker.find('.results-item-name>strong').html();
		            	var marker_title = clicked_marker.find('.results-item-title').html();
		            	var marker_company = clicked_marker.find('.results-item-company').html();
		            	var marker_address = clicked_marker.find('.results-item-address').html();
		            	// Create HTML for info window
		            	var contentString = '<div class="infowindow">'+
											  '<div class="info-img">'+
											    '<img src="'+marker_img+'" class="img-responsive"/>'+
											  '</div>'+
											  '<div class="info-personal">'+
											    '<h3 class="info-personal-name">'+marker_name+'</h3>'+
											    '<h5 class="info-personal-title">'+marker_title+'</h5>'+
											    '<h6 class="info-personal-company">'+marker_company+'</h6>'+
											    '<h6 class="info-personal-address">'+marker_address+'</h6>'+
											  '</div>'+
											'</div>';
		                infowindow.setContent(contentString);
		                infowindow.open(map, marker);
		            }
		        })(marker, i));
		        // Sets the markers as the array instead of just lats / longs.
		        markers[i][2] = marker;
		        
		    }
		});
	}

	window.onload = initializeMaps;
		
	//
	//  End scripts for Google Maps markers and click events
	//


	//
	// Advisor categories form submission
	//

	// Prevent the form from submitting when Enter key is pressed.
	$('.advisor-cat-form').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
			e.preventDefault();
			return false;
		}
	});

	$('.advisor-cat-form').submit(function(e) {
		e.preventDefault();
		
		var address = $('#address-search-input').val();
		var categories = [];

		$('.cat_check_box:checked').each(function() {
			categories.push($(this).val());
		});

		$('.advisor-cat-form').find('.form-error-text').remove();

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
    		type: "POST",
    		url: "/main/post-category",
    		data: {categories:categories, address:address},
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			var errors = errors;
    			console.log(errors);
    			if (errors.categories)
    			{
    				var errorsAppend = '<h4 class="text-danger">'+errors.categories[0]+'</h4>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('#address-search-input').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
    			}
    			if (errors.address)
    			{
    				var errorsAppend = '<h4 class="text-danger">'+errors.address[0]+'</h4>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('#address-search-input').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
    			}		
    		},
    		success: function(data) {
    			console.log(data);
    			if (data == "There was an error. Please try again.")
    			{
    				var errorsAppend = '<h4 class="text-danger">'+data+'</h4>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('.advisor-cat-form>ul').delay(3000).fadeOut(function() {
	    				$(this).remove();
	    			});
    			} else {
    				window.location.replace("/results");
    			}
    		}
		});
	});

	//
	// End advisor categories form submission
	//




});