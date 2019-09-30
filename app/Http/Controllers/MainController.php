<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\Question;
use Fadvi\Topic;
use Fadvi\User;
use Session;
use DB;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends Controller
{
    public function getIndex()
    {
        // Redirect to Fadvi Learning Center for the time being
        return redirect()->route('blog');

        // Retrieve collection of topic names from database table
        $topics = DB::table('topics')->where('life_event', null)->pluck('topic_name');
        // Retrieve collection of life event names from database table
        $life_events = DB::table('topics')->where('life_event', 1)->pluck('topic_name');
        
        return view('main.main')->with([
            'topics' => $topics,
            'life_events' => $life_events,
        ]);
    }

    public function postTopics(Request $request, $topicText)
    {
        // Retrieve collection of topic names from database table
        $topics = DB::table('topics')->pluck('topic_name');

        // Check if $topicText variable is in the $topics collection
        if ($topics->contains($topicText))
        {
            Session::put('topic', $topicText);

            // Retrieve ID of topic
            $topic = Topic::where('topic_name', $topicText)->first();
            Session::put('topicId', $topic->id);

            return response()->json("Success");
        }

        return response()->json("Error");    
    }
}
