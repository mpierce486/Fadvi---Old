<div style="height:85px;position:relative;top:0px;left:0px;max-width:600px;margin:auto;background-color:#9acccd;color:#fff;">
  <a href="{{ route('index') }}" style="float:left;padding-top:30px;padding-left: 15px;font-size:24px;line-height:22px;color:#fff;font-family:raleway,sans-serif;text-decoration:none;"><strong>Fadvi</strong></a>
</div>
<div style="font-family:arial;color:#000;position:relative;max-width:600px;margin:auto;padding:15px;">
  <h2 style="padding-left:10px;padding-right:10px;">{{ $advisor->first_name }},</h2>
  <h4 style="font-weight:initial;border-top:1px solid #e3e3e3;padding-top:15px;padding-left:10px;padding-right:10px;">Your request to join the Fadvi directory as an advisor has been approved! Below you will see how your information looks in search results. If any information is incorrect please <a href="{{ route('support') }}">Contact Us</a>.</h4>
  <div class="local-results-item" style="border:1px solid #e7e7e7;">
    <div class="results-item-img">
      <img src="{{ asset('/') }}{{ $advisor->image_path }}" data-id="{{ $advisor->username }}" class="img-responsive" style="width:7em; float:left; margin-right: 5px;"/>
    </div>
    <div class="results-item-personal" style="float:left;">
      <h3 class="results-item-name" style="margin-bottom:5px;margin-top:0px;"><strong>{{ $advisor->first_name }} {{ $advisor->last_name }}{{ $advisor->designations ? ", ".$advisor->designations : "" }}</strong></h3>
      <h5 class="results-item-title" style="margin:0 0 3px 0;">{{ $advisor->title }}</h5>
      <h6 class="results-item-company" style="margin:0 0 3px 0;">{{ $advisor->firm_name }}</h6>
      <h6 class="results-item-address" style="margin-top:5px;">{{ $advisor->firm_address }}</h6>
    </div>
    <div class="results-item-details" style="margin-left:60%;max-width: 40%;">
      <div class="results-item-about">
        <h5 style="margin:0;"><strong>About Me</strong></h5>
        <p style="font-size:13px;">{{ $advisor->about }}</p>
      </div>
      <div class="results-item-specialties">
        <h5 style="margin:0;"><strong>Specialties</strong></h5>
        <p style="font-size:13px;">{{ $advisor->services }}</p>
      </div>
      <div class="results-item-fees">
        <h5 style="margin:0;"><strong>Fees</strong></h5>
        <p style="font-size:13px;">{{ $advisor->fees }}</p>
      </div>
    </div>
  </div>
  <h4 style="font-weight:initial;border-top:1px solid #e3e3e3;padding-top:15px;padding-left:10px;padding-right:10px;">In addition, you can gain more control over your information, including being able to chat with prospects by <a href="{{ route('advisor.register.key.get', ['key' => $randomKey]) }}">registering your account</a>.</h4>
  <h4 style="font-weight:initial;border-top:1px solid #e3e3e3;padding-top:15px;padding-left:10px;padding-right:10px;">Fadvi was created with the mission to help individuals find advice for their finances, taxes, and estate planning. As an advisor, you play a critical role in helping your clients achieve their goals.</h4>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">Thanks again for joining the Fadvi directory and please let us know if there is anything we can improve on the platform for you!</h4>
  <h4 style="font-weight:initial;margin-bottom:10px;padding-left:10px;padding-right:10px;">Sincerely,</h4>
  <h4 style="font-weight:initial;margin-top:10px;padding-left:10px;padding-right:10px;">The Fadvi Team</h4>
  <div style="border-top:1px solid #e3e3e3;max-width:600px;text-align:center;padding-top:15px;padding-bottom:15px;font-size:14px;background-color:#9acccd;">
    <ul style="list-style-type:none;margin:0px;padding:0px;">
      <li style="display:inline;padding-right:10px;border-right:1px solid #505050;"><a href="{{ route('index') }}" target="_blank" style="text-decoration:none;color:#505050;">Fadvi</a></li>
      <li style="display:inline;padding-left:8px;padding-right:10px;border-right:1px solid #505050;"><a href="{{ route('terms') }}" target="_blank" style="text-decoration:none;color:#505050;">Terms of Service</a></li>
      <li style="display:inline;padding-left:8px;"><a href="{{ route('privacy') }}" target="_blank" style="text-decoration:none;color:#505050;">Privacy Policy</a></li>
    </ul>
    <h5 style="color:#505050;">&copy; {{ date('Y') }} - Fadvi, LLC</h5>
  </div>
</div>