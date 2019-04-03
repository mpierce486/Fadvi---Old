$(document).ready(function() {

	// On page load, set class for active nav tabs
	$('#admin-nav > li[data-title="users"]').addClass('active');
	$('#users').show();

	// Click event for main navigation tabs and corresponding content section
	$('#admin-nav > li').on('click', function() {
		$('#admin-nav > li').removeClass('active');
		$(this).addClass('active');

		var title = $(this).attr('data-title');

		$('.admin-container > .admin-section').hide();
		$('.admin-container').find('#'+title+'').show();
	});

	/*DELETE USER*/

	$('.user-delete').click(function() {

		swal({
		  title: "Are you sure?",
		  text: "Once deleted, you will not be able to recover this record!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((deleteUser) => {
		  if (deleteUser) {

		  	var userId = $(this).parent().siblings('.user-id').text();
				console.log(userId);
				$.ajaxSetup({
					headers: {
						'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				$.ajax({
					type: "POST",
					url: "/admin/delete-user/user/"+userId,
					data: {userId:userId},
					error: function(data){
						/*Retrieve errors and append any error messages.*/
						var errors = $.parseJSON(data.responseText);
						var errors = errors;
						alert(errors);
					},
					success: function(data) {
						if (data == "User deleted successfully.")
						{
							swal(data, {
						      icon: "success", 
						    });

						    $('.user-id:contains("'+userId+'")').parent().remove();
						} else if (data == "No such user exists.")
						{
							swal(data);
						}
					}
				});
		  } 
		});
	});

	/*DELETE ADVISOR*/

	$('.advisor-delete').click(function() {

		swal({
		  title: "Are you sure?",
		  text: "Once deleted, you will not be able to recover this record!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((deleteUser) => {
		  if (deleteUser) {

		  	var advisorId = $(this).parent().siblings('.advisor-id').text();
			
			console.log(advisorId);
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				type: "POST",
				url: "/admin/delete-user/advisor/"+advisorId,
				data: {advisorId:advisorId},
				error: function(data){
					/*Retrieve errors and append any error messages.*/
					var errors = $.parseJSON(data.responseText);
					var errors = errors;
					alert(errors);
				},
				success: function(data) {
					if (data == "Advisor deleted successfully.")
					{
						swal(data, {
					      icon: "success", 
					    });

					    $('.advisor-id:contains("'+advisorId+'")').parent().remove();
					} else if (data == "No such advisor exists.")
					{
						swal(data);
					}
				}
			});
		  } 
		});
	});

	/*APPROVE JOIN REQUEST*/

	$('#advisorRequest-approve').click(function() {

		swal({
		  title: "Are you sure?",
		  text: "You are about to approve a join request.",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((approveAdvisor) => {
		  if (approveAdvisor) {

		  	var advisorId = $(this).parent().siblings('.advisor-id').text();
			
			console.log(advisorId);
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				type: "POST",
				url: "/admin/approve/advisor/"+advisorId,
				data: {advisorId:advisorId},
				error: function(data){
					/*Retrieve errors and append any error messages.*/
					var errors = $.parseJSON(data.responseText);
					var errors = errors;
					alert(errors);
				},
				success: function(data) {
					if (data == "Advisor deleted successfully.")
					{
						swal(data, {
					      icon: "success", 
					    });

					    $('.advisor-id:contains("'+advisorId+'")').parent().remove();
					} else if (data == "No such advisor exists.")
					{
						swal(data);
					}
				}
			});
		  } 
		});
	});

	/*SCRIPT TO SUBMIT BLOG ON ADMIN PAGE*/

	$('#advisorBlog > input, label').click(function() {
		if ($('#advisor-content').is(":checked"))
		{
			$('#blog-help-text').hide();
			$('#blog-input').hide();
			$('#advisor-blog-url').show();
			$('#advisor-id').show();
		} else {
			$('#blog-help-text').show();
			$('#blog-input').show();
			$('#advisor-blog-url').hide();
			$('#advisor-id').hide();
		}
	});

	$('#submit-blog-btn').click(function(){

		var advisorBlog = 0;
		var advisorBlogUrl = '';

		if ($('#advisor-content').is(":checked"))
		{
			var advisorBlog = 1;
			var advisorBlogUrl = $('#advisor-blog-url').val();
			var advisorId = $('#advisor-id').val();
		}

		var blogTitle = $('#blog-title').val();
		var blogMainImg = $('#blog-main-img').val();
		var blogSnippet = $('#blog-snippet').val();
		var blogContent = tinymce.get('blog-input').getContent();

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/admin/dashboard/blog/",
			data: {advisorBlog:advisorBlog, blogTitle:blogTitle, blogMainImg:blogMainImg, advisorBlogUrl:advisorBlogUrl, blogSnippet:blogSnippet, blogContent:blogContent, advisorId:advisorId},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors;
				console.log(errors);
			},
			success: function(data) {
				if (data == "Blog successfully posted!")
				{
					swal(data, {
				      icon: "success", 
				    })
					.then((reload) => {
					  if (reload) {
					  	location.reload();
					  } 
					});
				}
			}
		});

	});

		

});