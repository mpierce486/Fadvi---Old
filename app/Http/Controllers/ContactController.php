<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Topic;
use Fadvi\Contact;
use Fadvi\Discussion;
use DB;
use Carbon\Carbon;
use Fadvi\Mail\ContactReceivedAdvisorRegistered;
use Fadvi\Mail\ContactReceivedAdvisorNotRegistered;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


use Fadvi\Http\Requests;

class ContactController extends Controller
{
    public function postContact(Request $request, $advisor) 
    {
        if ($request->ajax())
        {
        	$advisor = Advisor::where('username', $advisor)->first();
        	// Retrieve collection of topic names from database table
        	$topics = DB::table('topics')->pluck('topic_name');

	        if (!$advisor)
	        {
	            return request()->json("Advisor does not exist!");
	        }

        	$this->validate($request, [
	            'summary' => 'required|max:2000',
	            'topics' => 'required',
	        ], [
	            'summary.required' => 'You must include a summary.',
	            'summary.max' => 'Your summary must be less than 2000 characters.',
	            'topics.required' => 'You must select a reason for contact.',
	            'topics.in' => 'There is an error with your request.'
	        ]);

            // Serialize the topics array as a string to insert into database
            $topics = $request->input('topics');
            $topics = implode(', ', $topics);

                // Check if user has previously contacted the advisor. If so, don't create new
                // contact, rather use previous record and add to it.

                $prevContact = Contact::where('user_id', Auth::user()->id)->where('advisor_id', $advisor->id)->first();

                if ($prevContact)
                    {
                        $discussionId = $prevContact->discussion_id;

                        Discussion::create([
                            'discussion_id' => $discussionId,
                            'user_id' => Auth::user()->id,
                            'post' => $request->input('summary'),
                        ]);

                        // Check if advisor is registered for account on Fadvi
                        $registeredAdvisor = User::where('username', $advisor->username)->first();
                        if (!$registeredAdvisor)
                        {
                            // Generate random code for email registration link
                            $randomKey = md5(microtime());
                            
                            // If advisor already has a key in the database...use that key
                            $isKey = DB::table('advisor_key')->where('email', $advisor->email)->first();

                            if ($isKey)
                            {
                                $randomKey = $isKey->key;
                            }

                            if (!$isKey)
                            {
                                // Add information to advisor_key table
                                DB::table('advisor_key')->insert([
                                    'email' => $advisor->email,
                                    'key' => $randomKey,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                                
                            // Send advisor NOT registered email
                            $sender = User::where('id', Auth::user()->id)->first();
                            Mail::to($advisor)->send(new ContactReceivedAdvisorNotRegistered($sender, $advisor, $randomKey, $topics, $request->input('summary')));

                            return response()->json([
                                'confirm' => "Message successfully sent to advisor. Check for updates in your profile.",
                                'id' => $discussionId,
                            ]);
                        }

                        // Send email notification to advisor that IS registered
                        $sender = User::where('id', Auth::user()->id)->first();
                        Mail::to($advisor)->send(new ContactReceivedAdvisorRegistered($sender, $advisor, $discussionId, $topics, $request->input('summary')));

                        return response()->json([
                            'confirm' => "Message successfully sent to advisor. Check for updates in your profile.",
                            'id' => $discussionId,
                        ]);
                    }

            /**
            *   Resume previous method for advisor that has NOT been previously contacted
            **/    

            // Create discussion ID
            $discussionId = (int)round(microtime(true)*1000);

            // Create the discussion record that is linked to this initial contact record
            $discussion = Discussion::create([
                    'discussion_id' => $discussionId,
                    'user_id' => Auth::user()->id,
                    'post' => $request->input('summary'),
                ]);

            // Create the initial contact record
        	$contact = Auth::user()->contacts()->create([
        		'user_id' => Auth::user()->id,
        		'advisor_id' => $advisor->id,
        		'topics' => $topics,
        		'summary' => $request->input('summary'),
                'discussion_id' => $discussionId,
        	]);

            // Turn on discussion notifications for the user
            DB::table('discussion_notifications')->insert([
                'discussion_id' => $discussionId,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Check if advisor is registered for account on Fadvi
            $registeredAdvisor = User::where('username', $advisor->username)->first();
            if (!$registeredAdvisor)
            {
                // Generate random code for email registration link
                $randomKey = md5(microtime());
                
                // If advisor already has a key in the database...use that key
                $isKey = DB::table('advisor_key')->where('email', $advisor->email)->first();

                if ($isKey)
                {
                    $randomKey = $isKey->key;
                }

                if (!$isKey)
                {
                    // Add information to advisor_key table
                    DB::table('advisor_key')->insert([
                        'email' => $advisor->email,
                        'key' => $randomKey,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                    
                // Send advisor NOT registered email
                $sender = User::where('id', Auth::user()->id)->first();
                Mail::to($advisor)->send(new ContactReceivedAdvisorNotRegistered($sender, $advisor, $randomKey, $topics, $request->input('summary')));

                return response()->json([
                    'confirm' => "Message successfully sent to advisor. Check for updates in your profile.",
                    'id' => $discussionId,
                ]);
            }

        	// Send email notification to advisor that IS registered
        	$sender = User::where('id', Auth::user()->id)->first();
        	Mail::to($advisor)->send(new ContactReceivedAdvisorRegistered($sender, $advisor, $discussionId, $topics, $request->input('summary')));

        	return response()->json([
                'confirm' => "Message successfully sent to advisor. Check for updates in your profile.",
                'id' => $discussionId,
            ]);
        }
    }
}
