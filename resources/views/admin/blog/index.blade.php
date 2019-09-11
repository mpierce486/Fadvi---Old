@extends('templates.default')

@section('content')

<div id="admin-blog-wrapper" class="container">
	<header>
		<h1>Add Blog Post</h1>
	</header>
	<form method="post" id="admin-blog-post-form" enctype="multipart/form-data">
        <!-- <div class="form-check" id="advisorBlog">
            <input type="checkbox" class="form-check-input" name="advisor_content" id="advisor-content">
            <label class="form-check-label" for="advisor-content">Is this an advisor's blog post?</label>
        </div> -->
        <div class="form-group" style="text-align:left;">
            <label>Include credentials after name.</label>
            <input type="text" class="form-control input-global{{ $errors->has('advisor_name') ? ' is-invalid' : '' }}" name="advisor_name" placeholder="Enter Advisor First and Last Name" value="{{ Request::old('advisor_name') ?: '' }}"/>
            <div class="invalid-feedback">
                Please provide the advisor's name.
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control input-global{{ $errors->has('firm_name') ? ' is-invalid' : '' }}" name="firm_name" placeholder="Enter Firm Name" value="{{ Request::old('firm_name') ?: '' }}"/>
            <div class="invalid-feedback">
                Please provide a firm name.
            </div>
        </div>
		<div class="form-group">
            <input type="text" class="form-control input-global{{ $errors->has('blog_title') ? ' is-invalid' : '' }}" name="blog_title" id="blog-title" placeholder="Enter Blog Title" value="{{ Request::old('blog_title') ?: '' }}"/>
            <div class="invalid-feedback">
                Please provide a blog title.
            </div>
        </div>
		<div class="form-group">
            <input type="text" class="form-control input-global{{ $errors->has('blog_main_img') ? ' is-invalid' : '' }}" name="blog_main_img" id="blog-main-img" placeholder="Enter Image URL"/>
            <div class="invalid-feedback">
                Please provide a blog image.
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control input-global{{ $errors->has('advisor_blog_url') ? ' is-invalid' : '' }}" name="advisor_blog_url" id="advisor-blog-url" placeholder="Enter Blog URL"/>
            <div class="invalid-feedback">
                Please provide a blog URL.
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control input-global{{ $errors->has('blog_snippet') ? ' is-invalid' : '' }}" name="blog_snippet" id="blog-snippet" placeholder="Enter blog snippet"></textarea>
            <div class="invalid-feedback">
                Please provide a blog snippet.
            </div>
        </div>
        <select multiple class="form-control{{ $errors->has('topics') ? ' is-invalid' : '' }}" name="topics[]" id="topics" size="10">
            <optgroup label="Topics">
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->topic_name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="Life Events">
                @foreach ($life_events as $life_event)
                    <option value="{{ $life_event->id }}">{{ $life_event->topic_name }}</option>
                @endforeach
            </optgroup>
        </select>
        <div class="invalid-feedback">
            Please choose a topic.
        </div>

        <!-- REMOVING ADVISOR ID SINCE WE ARE NOT ASSOCIATING BLOGS WITH ADVISORS AT THE PRESENT TIME -->

        <!-- <div class="form-group">
            <input type="number" class="form-control input-global" name="advisor_id" id="advisor-id" placeholder="Enter Advisor ID"/>
        </div> -->

        <!-- <h5 id="blog-help-text">Begin blog post below...</h5>	
		<div id="blog-input"></div> -->
        <button id="submit-blog-btn" class="btn btn-global">Submit Blog</button>
        <input type="hidden" name="_token" value="{{Session::token()}}"/>
	</form>
	
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