@extends('templates.default')

@section('content')

<div class="container">
	<div class="auth-form-wrapper col-xs-12 col-lg-6 col-lg-offset-3">
		<h3 class="auth-form-title">Log In</h3>
		<p>Not registered? <a href="{{ route('auth.register') }}">Click here</a></p>
		<div class="alert alert-danger">
			<span>The email and password you entered did not match our records. You can reset your password <a href="/password/reset">here</a>.</span>
		</div>

		<div class="auth-form-separator"></div>

		<form method="post" action="/login">
			<div class="form-group">
				<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter Email" />
				@if ($errors->has('email'))
					<div class="invalid-feedback">{{ $errors->first('email') }}</div>
				@endif
			</div>
			<div class="form-group">
				<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter Password" />
				@if ($errors->has('password'))
					<div class="invalid-feedback">{{ $errors->first('password') }}</div>
				@endif
			</div>
			<div class="checkbox">
	    		<label>
	      			<input type="checkbox"> Remember Me
	    		</label>
	  		</div>
	  		<button type="submit" class="btn btn-global">Submit</button>
	  		<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</form>
	</div>
</div>
@stop