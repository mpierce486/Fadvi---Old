@extends('templates.default')

@section('content')

<div id="admin-blog-wrapper" class="container">
	<header>
		<h1>Add Blog Post</h1>
	</header>
	<form method="post" action="#" id="admin-blog-post-form" enctype="multipart/form-data">
        <div class="form-check" id="advisorBlog">
            <input type="checkbox" class="form-check-input" name="advisor_content" id="advisor-content">
            <label class="form-check-label" for="advisor-content">Is this an advisor's blog post?</label>
        </div>
		<div class="form-group">
            <input type="text" class="form-control input-global" name="blog_title" id="blog-title" placeholder="Enter Blog Title" value="{{ Request::old('blog_title') ?: '' }}"/>
        </div>
		<div class="form-group">
            <input type="text" class="form-control input-global" name="blog_main_img" id="blog-main-img" placeholder="Enter Image URL"/>
        </div>
        <div class="form-group">
            <input type="text" class="form-control input-global" name="advisor_blog_url" id="advisor-blog-url" placeholder="Enter Blog URL"/>
        </div>
        <div class="form-group">
            <textarea class="form-control input-global" name="blog_snippet" id="blog-snippet" placeholder="Enter blog snippet"></textarea>
        </div>
        <div class="form-group">
            <input type="number" class="form-control input-global" name="advisor_id" id="advisor-id" placeholder="Enter Advisor ID"/>
        </div>
        <h5 id="blog-help-text">Begin blog post below...</h5>	
		<div id="blog-input"></div>
	</form>
	<button id="submit-blog-btn" class="btn btn-global">Submit Blog</button>
</div>

<!-- TinyMCE -->
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script src="{{ asset('js/admin.js')  }}"></script>

<script type="text/javascript">
	tinymce.init({
		selector: '#blog-input',
		inline: true,
		plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        forced_root_block : 'div',  
        force_br_newlines : true,
        force_p_newlines : false,
        statusbar: false,
        content_css: '/css/app.css',
	});
</script>
@stop