@extends('templates.default')

@section('content')

<div id="admin-email-wrapper" class="container col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
	<h3>Send Email</h3>
	@if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
	<form method="post" action="#">
		<div class="form-group">
			<input type="email" class="form-control input-global{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter email" value="{{ Request::old('first_name') ?: '' }}"/>
			@if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
		</div>
		<div class="form-group">
			<input type="text" class="form-control input-global{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" placeholder="Enter subject" value="{{ Request::old('subject') ?: '' }}"/>
			@if ($errors->has('subject'))
                <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
            @endif
		</div>
		<div class="form-group">
			<textarea type="text" id="admin-email-body" rows="8" name="body" class="form-control input-global{{ $errors->has('body') ? ' is-invalid' : '' }}"></textarea>
			@if ($errors->has('body'))
                <div class="invalid-feedback">{{ $errors->first('body') }}</div>
            @endif
		</div>
		<button type="submit" class="btn btn-global">Send Email</button>
		<input type="hidden" name="_token" value="{{ Session::token() }}"/>
	</form>
</div>

<!-- TinyMCE JS -->
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#admin-email-body',
        menubar: false,
        plugins: ['advlist, lists, placeholder'],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        forced_root_block : 'div', 
        force_br_newlines : false,
        force_p_newlines : false,
        statusbar: false,
        content_css: '/css/app.css',
    });
</script>

@stop