@extends('templates.default')

@section('content')

<style>
    h3 {
        text-align: center;
    }

    #advisor-block {
        text-align: center;
    }

    .advisor-img {
        height: 200px;
        border-radius: 50%;
    }
</style>

<div class="auth-form-wrapper col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
    @if (Session::has('email-error'))
        <div class="alert alert-danger">
            {{ Session::get('email-error') }}
        </div>
    @endif
    
    <h3 class="auth-form-title">You are in our directory!</h3>
    <div id="advisor-block">
        <div class="advisor-img-wrapper">
            <img src="{{ asset('/') }}{{ $advisor->image_path }}" data-id="{{ $advisor->username }}" class="advisor-img" />
        </div>
        <div class="advisor-details-wrapper">
            <h4 class="advisor-name">{{ $advisor->first_name }} {{ $advisor->last_name }}</h4>
            <h5 class="advisor-title">{{ $advisor->title }}</h5>
            <h6 class="advisor-company">{{ $advisor->firm_name }}</h6>
            <h6 class="advisor-address">{{ $advisor->firm_address }}</h6>
        </div>
    </div>
    <div class="auth-form-separator"></div>

    @if (Session::has('request-link'))
        <div class="alert alert-success">
            Thank you for your interest in registering your account. Please check your email for futher instructions.
        </div>
    @endif
    @unless (Session::has('request-link'))
        @if ($advReg)
            <div class="alert alert-warning" role="alert">
                <h4>You are already registered! You can <a href="{{ route('login') }}"><strong>log in</strong></a> or <a href="/password/reset"><strong>reset your password</strong></a>.</h4>
            </div>
        @else
            <h4>Click the button below to request a registration link sent to this email.</h4>
            <form method="post" action="{{ route('auth.register.advisor.link.request', ['email' => $advisor->email]) }}" id="advisor-auth-form">
                <button type="submit" class="btn btn-global">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </form>
        @endif
    @endunless
    

  
</div>

@stop