<div style="height:85px;position:relative;top:0px;left:0px;max-width:600px;margin:auto;background-color:#9acccd;color:#fff;">
  <a href="{{ route('index') }}" style="float:left;padding-top:30px;padding-left: 15px;font-size:24px;line-height:22px;color:#fff;font-family:raleway,sans-serif;text-decoration:none;"><strong>Fadvi</strong></a>
</div>
<div style="font-family:arial;color:#000;position:relative;max-width:600px;margin:auto;padding:15px;">
  <h2 style="padding-left:10px;padding-right:10px;">{{ $advisor->first_name }}, Welcome To Fadvi!</h2>
  <h4 style="font-weight:initial;border-top:1px solid #e3e3e3;padding-top:15px;padding-left:10px;padding-right:10px;">Fadvi was created with the mission to help individuals find advice for their finances, taxes, and estate planning. As an advisor, you play a critical role in helping your clients achieve their goals.</h4>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">Now that you are registered, you will be able to update your directory information and keep track of your discussions with possible clients.</h4>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">Thanks again for registering and please let us know if there is anything we can improve on the platform for you!</h4>
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





