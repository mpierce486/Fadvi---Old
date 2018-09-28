@extends('templates.default')

@section('content')

<div class="container support-wrapper">
	<h2>Contact Us</h2>

	@if (Session::has('success'))
		<div class="alert alert-success col-sm-6 col-sm-offset-3" role="alert">
			{{ Session::get('success') }}
		</div>
	@endif	

	@if (Auth::check())
	<form role="form" method="post" class="form-horizontal support-form col-xs-12 col-lg-6 col-lg-offset-3">
		<div class="form-group{{ $errors->has('support_content') ? ' has-error' : '' }}">
			<span class="help-block">Please contact us with any questions or comments.</span>
			<textarea class="form-control support-text input-global" rows="5" name="support_content"></textarea>
			@if ($errors->has('support_content'))
				<span class="help-block">{{ $errors->first('support_content') }}</span>
			@endif
		</div>
		<div class="form-group pull-right support-form-btns">
			<button type="submit" class="btn btn-global">Submit</button>
		</div>		
		<input type="hidden" name="_token" value="{{Session::token()}}"/>			
	</form>
	@else
	<form role="form" method="post" class="form-horizontal support-form col-xs-12 col-lg-6 col-lg-offset-3">
		<h4>Please contact us with any questions or comments.</h4>
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<input type="email" placeholder="Enter email" class="form-control input-global" name="email"></input>
			@if ($errors->has('email'))
				<span class="help-block">{{ $errors->first('email') }}</span>
			@endif
		</div>
		<div class="form-group{{ $errors->has('support_content') ? ' has-error' : '' }}">
			<textarea class="form-control support-text input-global" rows="5" name="support_content"></textarea>
			@if ($errors->has('support_content'))
				<span class="help-block">{{ $errors->first('support_content') }}</span>
			@endif
		</div>
		<div class="form-group pull-right support-form-btns">
			<button type="submit" class="btn btn-global">Submit</button>
		</div>		
		<input type="hidden" name="_token" value="{{Session::token()}}"/>			
	</form>
	@endif
	
</div>

@stop