$(document).ready(function(){
	var $grid = $('#advisors-wrapper').isotope({
		itemSelector: '.advisor-detail',
		layoutMode: 'fitRows'
	});

	$('#nav-buttons > button').on('click', function() {
		// If button clicked already is active, remove class and show all advisors
		if ($(this).hasClass('nav-buttons-active'))
		{
			$(this).removeClass('nav-buttons-active').blur();
			$grid.isotope({ filter: '*' });
			return;
		}
		// Remove active class on any buttons
		$('#nav-buttons > button').removeClass('nav-buttons-active');
		// Add active class to this button
		$(this).addClass('nav-buttons-active');
		var btnText = $(this).attr("data-type");
		
		$grid.isotope({ filter: '.'+btnText+''});
	});

	// Show all advisors is user clicks on document
	$('#nav-buttons > button').on('blur', function() {
		// Remove active class on any buttons
		$('#nav-buttons > button').removeClass('nav-buttons-active');
		$grid.isotope({ filter: '*' });
	});
});