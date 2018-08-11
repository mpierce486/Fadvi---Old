<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Topic;
use Fadvi\Discussion;
use Fadvi\Contact;
use DB;
use Mail;
use Carbon\Carbon;

use Fadvi\Mail\DiscussionNotificationUser;
use Fadvi\Mail\DiscussionNotificationAdvisor;


use Illuminate\Http\Request;

use Fadvi\Http\Requests;

class DiscussionController extends Controller
{
    public function getDiscussion($id)
    {
        $contact = Contact::where('discussion_id', $id)->first();
        
    	$user = User::where('id', $contact->user_id)->first();

    	$advisor = Advisor::where('id', $contact->advisor_id)->first();
        
    	// Validate user and advisor accessing this discussion
    	if (Auth::user()->id !== $user->id && Auth::user()->username !== $advisor->username)
        {
            return redirect()->route('index');
        }

        // Get collection of all posts for this discussion
        $posts = Discussion::where('discussion_id', $id)->get();

        // Check if discussion notifications are turned on
        $disNotif = DB::table('discussion_notifications')->where([
                        'discussion_id' => $id,
                        'user_id' => Auth::user()->id,
                    ])->first();

        if ($disNotif)
        {
            $disNotif = true;
        }
    	
    	return view('discussions.discussion')->with([
    		'user' => $user,
    		'advisor' => $advisor,
            'posts' => $posts,
            'disNotif' => $disNotif,
    	]);
    }

    public function postDiscussion(Request $request, $id)
    {
        if ($request->ajax())
        {
            $contact = Contact::where('discussion_id', $id)->first();
        
            $user = User::where('id', $contact->user_id)->first();

            $advisor = Advisor::where('id', $contact->advisor_id)->first();
            
            // Validate user and advisor accessing this discussion
            if (Auth::user()->id !== $user->id && Auth::user()->username !== $advisor->username)
            {
                return redirect()->route('index');
            }

            $this->validate($request, [
                'post' => 'required|max:2000',
            ], [
                'post.required' => 'Your post cannot be blank.',
                'post.max' => 'Your post must be less than 2,000 characters.',
            ]);

            Discussion::create([
                'discussion_id' => $id,
                'user_id' => Auth::user()->id,
                'post' => $request->input('post'),
            ]);

            // Send email notification to user to let them know of the post
            // First, check if Auth user is an advisor or not

            $post = $request->input('post');

            if (Auth::user()->username == $advisor->username)
            {
                // Check if discussion notifications are turned on
                $disNotif = DB::table('discussion_notifications')->where([
                                'discussion_id' => $id,
                                'user_id' => $user->id,
                            ])->first();

                if ($disNotif)
                {
                    // Send email notification to the user
                    return Mail::to($user)->send(new DiscussionNotificationUser($advisor, $user, $id, $post));
                }

                return;
                
            }

            Mail::to($advisor)->send(new DiscussionNotificationAdvisor($user, $advisor, $id, $post));

        }
    }

    /**
    *   Toggle to turn on/off email notifications for discussion
    **/

    public function postDiscussionNotification(Request $request, $id)
    {
        if ($request->ajax())
        {
            if ($request->input('toggle') == 1)
            {
                DB::table('discussion_notifications')->insert([
                    'discussion_id' => $id,
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                return response()->json("You will now receive email notifications for this discussion.");
            }

            if ($request->input('toggle') == 0)
            {
                DB::table('discussion_notifications')->where([
                    'discussion_id' => $id,
                    'user_id' => Auth::user()->id,
                ])->delete();

                return response()->json("You will no longer receive email notifications for this discussion.");
            }
        }
    }

}
