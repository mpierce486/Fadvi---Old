@extends('templates.default')

@section('content')

<div class="container">
    <div class="auth-form-wrapper col-xs-12 col-lg-6 col-lg-offset-3">
        <h3 class="auth-form-title">Reset Password</h3>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action="/password/email">
            <div class="form-group">
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter Email" />
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-global">Send Password Reset Link</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
</div>


@stop