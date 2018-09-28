<?php

namespace Fadvi\Http\Controllers;

use Fadvi\User;
use Carbon\Carbon;
use DB;
use Auth;
use Notification;

use Fadvi\Notifications\SupportRequestPublic;
use Fadvi\Notifications\SupportRequest;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function getSupport()
    {
    	return view('support.support');
    }

    public function postSupport(Request $request)
    {
    	// If user is authenticated

    	if (Auth::check())
		{
			$this->validate($request, [
				'support_content' => 'required',
			], [
				'support_content.required' => 'Please include a message.',
			]);

			DB::table('support')->insert([
				'registered' => 1,
				'email' => Auth::user()->email,
				'summary' => $request->input('support_content'),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);

			$summary = $request->input('support_content');
			$user = User::where('id', Auth::user()->id)->first();

			// Send email to admins notifying them
	        Notification::route('mail', 'support@fadvi.com')->notify(new SupportRequest($user, $summary));

	        return redirect()->route('support')->with('success', 'Your support request has been sent!');
		}

		// If user is NOT authenticated

		$this->validate($request, [
			'email' => 'required|email',
			'support_content' => 'required',
		], [
			'email.required' => 'Please enter your email.',
			'support_content.required' => 'Please include a message.',
		]);

		DB::table('support')->insert([
			'registered' => 0,
			'email' => $request->input('email'),
			'summary' => $request->input('support_content'),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);

		$email = $request->input('email');
		$summary = $request->input('support_content');

		// Send email to admins notifying them
        Notification::route('mail', 'support@fadvi.com')->notify(new SupportRequestPublic($email, $summary));

        return redirect()->route('support')->with('success', 'Your support request has been sent!');
	    	
    }
}
