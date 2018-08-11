<div style="height:85px;position:relative;top:0px;left:0px;max-width:600px;margin:auto;background-color:#9acccd;color:#fff;">
  <a href="{{ route('index') }}" style="float:left;padding-top:30px;padding-left: 15px;font-size:24px;line-height:22px;color:#fff;font-family:raleway,sans-serif;text-decoration:none;"><strong>Fadvi</strong></a>
</div>
<div style="font-family:arial;color:#000;position:relative;max-width:600px;margin:auto;padding:15px;">
  <h2 style="padding-left:10px;padding-right:10px;">{{ $user->first_name }},</h2>
  <h4 style="font-weight:initial;border-top:1px solid #e3e3e3;padding-top:15px;">There is a new post in your discussion with...</h4>
  <div id="discussion-top-advisor" style="text-align:center;margin:auto;">
    <img src="{{ asset('/') }}{{ $advisor->image_path }}" style="margin:auto;height:200px;" data-id="{{ $advisor->username }}" class="img-responsive img-circle" />
    <h3 id="discussion-advisor-name">{{ $advisor->first_name }} {{ $advisor->last_name }}</h3>
    <h4 id="discussion-advisor-title">{{ $advisor->title }}</h4>
    <h5 id="discussion-advisor-firm">{{ $advisor->firm_name }}</h5>
  </div>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">The new post is:</h4>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">{{ $post }}</h4>
  <h4 style="font-weight:initial;padding-left:10px;padding-right:10px;">To access this discussion, <a href="{{ route('discussion', ['id' => $discussionId]) }}">Click here</a></h4>
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



