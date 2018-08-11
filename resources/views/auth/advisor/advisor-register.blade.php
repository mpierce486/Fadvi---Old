@extends('templates.default')

@section('content')

<div class="auth-form-wrapper col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
  <h3>{{ $advisor->first_name }},</h3>
  <h4 class="auth-form-title">Complete your registration by entering a password below.</h4>
  <form role="form" method="post" action="{{ route('advisor.register.key.post', ['key' => $key->key]) }}">
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="Enter Password" />
        @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
        @if ($errors->has('password_confirmation'))
            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    <input type="hidden" name="_token" value="{{ Session::token() }}"/>
  </form>
</div>

<script src="{{ asset('js/register.js')  }}"></script>

@stop