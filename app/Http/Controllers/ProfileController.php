<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Response;
use Fadvi\Discussion;
use DB;
use Carbon\Carbon;
use Fadvi\Mail\ResetPasswordConfirm;
use Fadvi\Mail\ChangeEmailConfirm;
use Fadvi\Mail\AdvisorInfoChange;

use Fadvi\Notifications\ChangeEmail;
use Fadvi\Notifications\ChangePassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Fadvi\Http\Requests;

class ProfileController extends Controller
{
    public function getProfile($name) 
    {
        $user = User::where('email', Auth::user()->email)->first();

        // If user does not exist, redirect to home page
        if (!$user)
        {
            return redirect()->route('index');
        }

        // Route user to advisor's view if advisor_registered == 1
        if (Auth::user()->advisor_registered == 1)
        {
            $advisor = Advisor::where('email', Auth::user()->email)->first();

            // Get all available questions for the advisor to answer
            $advisorQuestions = Auth::user()->advisorQuestions();

            // Get all responses that advisor has provided
            $advisorResponses = Auth::user()->advisorResponses();

            // Get all discussions with users
            $discussions = Discussion::where('advisor_id', $advisor->id)->get();
                 
            return view('profile.advisor-profile')
                ->with([
                    'user' => $user,
                    'advisor' => $advisor,
                    'advisorQuestions' => $advisorQuestions,
                    'advisorResponses' => $advisorResponses,
                    'discussions' => $discussions,
                ]);
        }

        // Get user's questions asked
        $questions = Auth::user()->userQuestions();

        // Get user's discussions with advisors
        $discussions = Auth::user()->discussions()->get();
       
    	return view('profile.profile')
    		->with([
    			'user' => $user,
                'questions' => $questions,
                'discussions' => $discussions,
    		]);
    }

    public function postEditEmail(Request $request)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'email' => 'required|unique:users|email|max:255',
            ]);

            Auth::user()->update([
                'email' => $request->input('email'),
            ]);

            // Send email notification to user
            $user = User::where('id', Auth::user()->id)->first();
            $user->notify(new ChangeEmail($user));
        }
    }

    public function postEditPassword(Request $request)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
            ],[
                'password.required' => 'You must input a password.',
                'password_confirmation.required' => 'You must confirm your password.',
            ]);

            Auth::user()->update([
                'password' => bcrypt($request->input('password')),
            ]);

            // Send email notification to user
            $user = User::where('id', Auth::user()->id)->first();
            $user->notify(new ChangePassword($user));
        }
    }

    /**
     *  Method for advisor to request a change of information in directory
     */

    public function postAdvisorInfoChange(Request $request)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'summary' => 'required|max:500',
            ],[
                'summary.required' => 'Please describe what you want changed.',
            ]);
        }

        $summary = $request->input('summary');

        $advisor = Advisor::where('username', Auth::user()->username)->first();

        // Insert request in database table
        DB::table('advisor_info_change')->insert([
            'username' => $advisor->username,
            'summary' => $summary,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Send email to admins notifying them there is a request to change info
        Mail::to("support@fadvi.com")->send(new AdvisorInfoChange($advisor, $summary));
    }


}
