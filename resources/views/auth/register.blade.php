@extends('templates.default')

@section('content')
<div class="container">
  <div class="auth-form-wrapper col-xs-12 col-lg-6 col-lg-offset-3">
      <h3 class="auth-form-title">Register</h3>
      <p>Already registered? <a href="{{ route('login') }}">Log in</a></p>

      <div class="auth-form-separator"></div>

      <!-- USER REGISTER FORM -->
      
      <form method="post" action="/register" id="user-register-form">
          <div class="row">
              <div class="form-group col-sm-6">
                  <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first-name" placeholder="First Name" />
                  @if ($errors->has('first_name'))
                      <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                  @endif
              </div>
              <div class="form-group col-sm-6">
                  <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last-name" placeholder="Last Name" />
                  @if ($errors->has('last_name'))
                      <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                  @endif
              </div>
          </div>
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
          <div class="form-group">
              <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirm Password" />
              @if ($errors->has('password_confirmation'))
                  <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
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

      <!-- ADVISOR CHECK EMAIL FORM -->

      <!-- <form method="post" action="/register/advisor/check" id="advisor-register-form">
        <h3>For Advisors Looking To Give Advice</h3>
          <h4>Let's first check if you are in our directory</h4>
          <div class="form-group{{ $errors->has('advisor-email') ? ' has-error' : '' }}">
              <input type="email" class="form-control" name="advisor-email" placeholder="Enter Email" />
              @if ($errors->has('advisor-email'))
                  <span class="help-block">{{ $errors->first('advisor-email') }}</span>
              @endif
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
          <input type="hidden" name="_token" value="{{ Session::token() }}"/>
      </form> -->
  </div>
</div>

<script src="{{ asset('js/register.js')  }}"></script>

@stop