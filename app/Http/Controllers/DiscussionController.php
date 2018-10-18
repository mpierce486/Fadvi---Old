<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Topic;
use Fadvi\Discussion;
use Fadvi\Post;
use Fadvi\Question;
use DB;
use Mail;
use Session;
use Carbon\Carbon;

use Fadvi\Notifications\DiscussionCreated;
use Fadvi\Notifications\DiscussionPostNotificationUser;
use Fadvi\Notifications\DiscussionPostNotificationAdvisor;

use Fadvi\Events\DiscussionUpdate;

use Illuminate\Http\Request;

use Fadvi\Http\Requests;

class DiscussionController extends Controller
{
    public function createDiscussion($questionId, $advisorId)
    {
        // Retrieve question record
        $question = Question::where('id', $questionId)->first();

        // Retrieve advisor
        $advisor = Advisor::where('id', $advisorId)->first();
        
        // Create the discussion record
        $discussion = Discussion::create([
            'user_id' => Auth::user()->id,
            'advisor_id' => $advisor->id,
            'question_id' => $question->id,
        ]);

        $topic = Topic::where('id', $question->topic_id)->first();

        // Find record in question_responses and update boolean discussion_created
        // This will be used in the user's profile view to hide questions where a discussion has been created with advisor
        DB::table('question_responses')->where('question_id', $question->id)->where('advisor_id', $advisor->id)->update(['discussion_created' => '1']);

        // Turn on discussion notifications for the user in order for the user to receive
        // email notifications when the advisor posts in the discussion
        DB::table('discussion_notifications')->insert([
            'discussion_id' => $discussion->id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Enable discuss notification boolean
        $disNotif = true;

        // Add initial question to Posts table
        Post::create([
            'post' => $question->question,
            'user_id' => Auth::user()->id,
            'discussion_id' => $discussion->id,
        ]);

        // Create email notification to go out to advisor
        $advisor->notify(new DiscussionCreated($advisor, $discussion, $topic));
        
        // Create session flash variable for creating a discussion
        Session::flash('newDiscussion', '1');

        return redirect()->route('discussion', ['id' => $discussion->id ]);

        
    }
    
    public function getDiscussion($id)
    {
        $discussion = Discussion::where('id', $id)->first();

        $question = Question::where('id', $discussion->question_id)->first();
                
    	$user = User::where('id', $discussion->user_id)->first();

    	$advisor = Advisor::where('id', $discussion->advisor_id)->first();
        
    	// Validate user and advisor accessing this discussion
    	if (Auth::user()->id !== $user->id && Auth::user()->username !== $advisor->username)
        {
            return redirect()->route('index');
        }

        // Get collection of all posts for this discussion
        $posts = Post::where('discussion_id', $discussion->id)->get();

        // Check if discussion notifications are turned on
        $disNotif = DB::table('discussion_notifications')->where([
                        'discussion_id' => $discussion->id,
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
            'question' => $question,
            'disNotif' => $disNotif,
    	]);
    }

    // Post in a discussion
    public function postDiscussion(Request $request, $id)
    {
        if ($request->ajax())
        {
            $discussion = Discussion::where('id', $id)->first();
        
            $user = User::where('id', $discussion->user_id)->first();

            $advisor = Advisor::where('id', $discussion->advisor_id)->first();

            $question = Question::where('id', $discussion->question_id)->first();

            $topic = Topic::where('id', $question->topic_id)->first();

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

            $post = Post::create([
                'post' => $request->input('post'),
                'user_id' => Auth::user()->id,
                'discussion_id' => $discussion->id,
            ]);

            $posterName = Auth::user()->first_name;
            $postTime = Carbon::now()->diffForHumans();

            event(new DiscussionUpdate($discussion, $post, $posterName, $postTime));

            // Send email notification to user to let them know of the post
            // First, check if Auth user is an advisor or not
            if (Auth::user()->username == $advisor->username)
            {
                // Check if discussion notifications are turned on for the user
                $disNotif = DB::table('discussion_notifications')->where([
                                'discussion_id' => $discussion->id,
                                'user_id' => $user->id,
                            ])->first();

                if ($disNotif)
                {
                    // Send email notification to the user
                    $user->notify(new DiscussionPostNotificationUser($user, $advisor, $discussion, $topic));
                }

                return;
                
            }

            // Grab the user record that belongs to the advisor
            $userAdvisor = User::where('username', $advisor->username)->first();

            // Check if discussion notifications are turned on
            $disNotif = DB::table('discussion_notifications')->where([
                            'discussion_id' => $discussion->id,
                            'user_id' => $userAdvisor->id,
                        ])->first();

            if ($disNotif)
            {
                // Send email notification to the advisor
                $advisor->notify(new DiscussionPostNotificationAdvisor($user, $advisor, $discussion, $topic));
            }
            
            

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
