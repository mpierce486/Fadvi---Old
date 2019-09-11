$(document).ready(function() {

	var $grid = $('.grid').isotope({
	  // options
	  itemSelector: '.grid-item',
	});

	// Add "active" class to filters & populate subtext
	$('#filters > a').on('click', function(e) {
		e.preventDefault();
		// Check if current element already has "active" class
		if ($(this).hasClass("active"))
		{
			// Remove "active" class
			$(this).removeClass("active");
			// Hide filters subtext
			$('#filters-subtext').hide();
			$grid.isotope({ filter: '*' });

			return;
		}
		// Remove any filters with the "active" class
		$('#filters > a').removeClass("active");
		// Add "active" class to selected filter
		$(this).addClass("active");
		// Get data-id of selected filter
		var id = $(this).attr("data-id");
		$grid.isotope({ filter: '.'+id+'' });

		// Populate filters subtext based on which filter was selected
		var filter = $(this).text();
		$('#filters-subtext-dynamic').text(filter);
		// Show filter subtext
		$('#filters-subtext').show();
	});

	// Alternate way of removing filters. Click the "X" next to the filters subtext
	$('#filters-subtext i').on('click', function() {
		$('#filters-subtext').hide();
		$('#filters > a').removeClass("active");
		$grid.isotope({ filter: '*' });
	});

	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item',
	});

	



});