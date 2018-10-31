@extends('templates.default')

@section('content')


<div id="admin-outer">
    <div class="admin-form-wrapper col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <h3 class="auth-form-title">Add An Advisor To the Directory</h3>
        <p class="text-muted">* All fields are required</p>
        <div class="auth-form-separator">
            <span class="separator-text">Enter Personal Information</span>
        </div>
        <form method="post" action="#" id="advisor-auth-form" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first-name" placeholder="First Name" value="{{ Request::old('first_name') ?: '' }}"/>
                    @if ($errors->has('first_name'))
                        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last-name" placeholder="Last Name" value="{{ Request::old('last_name') ?: '' }}"/>
                    @if ($errors->has('last_name'))
                        <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter Email" value="{{ Request::old('email') ?: '' }}"/>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="auth-form-separator">
                <span class="separator-text">Enter Professional Information</span>
            </div>
            <div class="form-group">
                <label for="advisor-type">I am a(n):</label>
                <select class="form-control{{ $errors->has('advisor_type') ? ' is-invalid' : '' }}" name="advisor_type" id="advisor-type">
                    <option value=""></option>
                    <option value="FP">Financial Planner</option>
                    <option value="CPA">Certified Public Accountant</option>
                    <option value="EPA">Estate Planning Attorney</option>
                </select>
                @if ($errors->has('advisor_type'))
                    <div class="invalid-feedback">{{ $errors->first('advisor_type') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Enter Professional Title" value="{{ Request::old('title') ?: '' }}"/>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="designations">Choose any designations:</label>
                <select multiple class="form-control{{ $errors->has('designations') ? ' is-invalid' : '' }}" name="designations[]" id="designations" size="7">
                    <optgroup label="Financial Planning">
                        <option value="CFA">Chartered Financial Analyst (CFA)</option>
                        <option value="CFP&reg;">Certified Financial Planner&reg; (CFP&reg;)</option>
                        <option value="AIF">Accredited Investment Fiduciary (AIF)</option>
                        <option value="CFPA&trade;">Certified Financial Process Associate&trade; (CFPA&trade;)</option>
                        <option value="ChFC&reg;">Chartered Financial Consultant&reg; (ChFC&reg;)</option>
                    </optgroup>
                    <optgroup label="Tax Planning">
                        <option value="CPA">Certified Public Accountant (CPA)</option>
                    </optgroup>
                    <optgroup label="Estate Planning">
                        <option value="CEP&reg;">Certified Estate Planner&trade; (CEP&reg;)</option>
                        <option value="EPLS">Estate Planning Law Specialist (EPLS)</option>
                    </optgroup>
                    <optgroup label="Insurance">
                        <option value="CLU">Chartered Life Underwriter (CLU)</option>
                    </optgroup>
                </select>
                @if ($errors->has('designations'))
                    <div class="invalid-feedback">{{ $errors->first('designations') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="advisor-pic">Upload Profile Photo:</label>
                <input type="file" class="{{ $errors->has('advisor_pic') ? ' is-invalid' : '' }}" name="advisor_pic" id="advisor-pic" />
                @if ($errors->has('advisor_pic'))
                    <div class="invalid-feedback">{{ $errors->first('advisor_pic') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control{{ $errors->has('firm_name') ? ' is-invalid' : '' }}" name="firm_name" placeholder="Enter Firm Name" value="{{ Request::old('firm_name') ?: '' }}"/>
                @if ($errors->has('firm_name'))
                    <div class="invalid-feedback">{{ $errors->first('firm_name') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" id="firm_city" name="firm_city" placeholder="City" value="{{ Request::old('firm_city') ?: '' }}" />
                    @if ($errors->has('firm_city'))
                        <div class="invalid-feedback">{{ $errors->first('firm_city') }}</div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <select class="form-control{{ $errors->has('firm_state') ? ' is-invalid' : '' }}" id="firm_state" name="firm_state">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    @if ($errors->has('firm_state'))
                        <div class="invalid-feedback">{{ $errors->first('firm_state') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control input-global" id="advisor-bio" name="biography"></textarea> 
            </div>
            <div class="form-group">
                <label for="topics">Choose any topics:</label>
                <select multiple class="form-control{{ $errors->has('topics') ? ' is-invalid' : '' }}" name="topics[]" id="topics" size="10">
                    @foreach ($topics as $topic)
                        <option value="{{ $topic }}">{{ $topic }}</option>
                    @endforeach
                </select>
                @if ($errors->has('topics'))
                    <div class="invalid-feedback">{{ $errors->first('topics') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-global">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
</div>

<!-- GOOGLE PLACES -->
<script src="{{ asset('js/admin.js')  }}"></script>
<!-- TinyMCE JS -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script src="{{ asset('js/tinymce/plugin.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#advisor-bio',
        placeholder: 'Enter advisor biography',
        menubar: false,
        plugins: ['advlist, lists, placeholder'],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        forced_root_block : "", 
        force_br_newlines : true,
        force_p_newlines : false,
        statusbar: false,
        content_css: '/css/app.css',
    });
</script>

@stop