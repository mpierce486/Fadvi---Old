@extends('templates.default')

@section('content')

<div id="auth-outer">
    <div class="auth-form-wrapper col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
        @if (Session::has('request'))
            <div class="alert alert-success">
                Thank you for your interest in being part of our directory! We will contact you soon.
            </div>
        @endif
        <h3 class="auth-form-title">It looks like you're not in our directory. Do you want to be added?</h3>
        <h4>We thoroughly vet all our advisors on the Fadvi platform. Please fill out the form below and we will contact you soon.</h4>
        <div class="auth-form-separator">
            <span class="separator-text">Enter Personal Information</span>
        </div>
        <form method="post" action="/join/advisor" enctype="multipart/form-data" id="advisor-auth-form">
            <div class="row">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} col-sm-6">
                    <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First Name" value="{{ Request::old('first_name') ?: '' }}"/>
                    @if ($errors->has('first_name'))
                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} col-sm-6">
                    <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Last Name" value="{{ Request::old('last_name') ?: '' }}"/>
                    @if ($errors->has('last_name'))
                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ Request::old('email') ?: '' }}"/>
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="auth-form-separator">
                <span class="separator-text">Enter Professional Information</span>
            </div>
            <div class="form-group{{ $errors->has('advisor_type') ? ' has-error' : '' }}">
                <label for="advisor-type">I am a(n):</label>
                <select class="form-control" name="advisor_type" id="advisor-type">
                    <option value=""></option>
                    <option value="FP">Financial Planner</option>
                    <option value="CPA">Certified Public Accountant</option>
                    <option value="EPA">Estate Planning Attorney</option>
                </select>
                @if ($errors->has('advisor_type'))
                    <span class="help-block">{{ $errors->first('advisor_type') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="title" placeholder="Enter Professional Title" value="{{ Request::old('title') ?: '' }}"/>
                @if ($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('designations') ? ' has-error' : '' }}">
                <label for="designations">Choose any designations:</label>
                <select multiple class="form-control" name="designations[]" id="designations" size="10">
                    <optgroup label="Financial Planning">
                        <option value="CFA">Chartered Financial Analyst (CFA)</option>
                        <option value="CFP">Certified Financial Planner (CFP&reg;)</option>
                        <option value="AIF">Accredited Investment Fiduciary (AIF)</option>
                        <option value="CFPA">Certified Financial Process Associate (CFPA&trade;)</option>
                        <option value="ChFC">Chartered Financial Consultant (ChFC&reg;)</option>
                    </optgroup>
                    <optgroup label="Tax Planning">
                        <option value="CPA">Certified Public Accountant (CPA)</option>
                    </optgroup>
                    <optgroup label="Estate Planning">
                        <option value="CEP">Certified Estate Planner&trade; (CEP&reg;)</option>
                        <option value="EPLS">Estate Planning Law Specialist (EPLS)</option>
                    </optgroup>
                    <optgroup label="Insurance">
                        <option value="CLU">Chartered Life Underwriter (CLU)</option>
                    </optgroup>
                </select>
                @if ($errors->has('designations'))
                    <span class="help-block">{{ $errors->first('designations') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('advisor_pic') ? ' has-error' : '' }}">
                <label for="advisor-pic">Upload Profile Photo:</label>
                <input type="file" name="advisor_pic" id="advisor-pic" />
                @if ($errors->has('advisor_pic'))
                    <span class="help-block">{{ $errors->first('advisor_pic') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('firm_name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="firm_name" placeholder="Enter Firm Name" value="{{ Request::old('firm_name') ?: '' }}"/>
                @if ($errors->has('firm_name'))
                    <span class="help-block">{{ $errors->first('firm_name') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('firm_address') ? ' has-error' : '' }}">
                <input type="text" class="form-control" id="firm_address" name="firm_address" placeholder="Street Address" value="{{ Request::old('firm_address') ?: '' }}"/>
                <small class="form-text text-muted">Enter full street address</small>
                @if ($errors->has('firm_address'))
                    <span class="help-block">{{ $errors->first('firm_address') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('services') ? ' has-error' : '' }}">
                <textarea type="text" rows="3" class="form-control" name="services" id="services-input" placeholder="Enter services separated by comma">{{ Request::old('services') ?: '' }}</textarea>
                @if ($errors->has('services'))
                    <span class="help-block">{{ $errors->first('services') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                <textarea type="text" rows="3" class="form-control" name="about" id="about-input" placeholder="Describe yourself (250 character max)">{{ Request::old('about') ?: '' }}</textarea>
                @if ($errors->has('about'))
                    <span class="help-block">{{ $errors->first('about') }}</span>
                @endif
                <div id="charNum"></div>
            </div>
            <button type="submit" class="btn btn-global">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
</div>

<!-- GOOGLE PLACES -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=places"></script>
<script>
    var input = document.getElementById('firm_address');
    var autocomplete = new google.maps.places.Autocomplete(input);

    // Disable form submit on 'Enter' keypress
    $('#advisor-auth-form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });

    // Textarea character count
    $('#about-input').keyup(function () {
      var max = 250;
      var len = $(this).val().length;
      if (len >= max) {
        $('#charNum').text('You have exceeded 250 characters!').css("color", "#a94442");
      } else {
        var char = max - len;
        $('#charNum').text(char + ' characters left');
      }
    });

</script>

@stop