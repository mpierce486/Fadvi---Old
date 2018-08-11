<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Topic;
use Fadvi\Discussion;
use Fadvi\Question;
use Fadvi\Response;
use DB;
use Mail;
use Session;
use Carbon\Carbon;

use Fadvi\Notifications\QuestionNotificationAdvisorRegistered;
use Fadvi\Notifications\QuestionNotificationAdvisorNotRegistered;
use Fadvi\Notifications\ResponseReceived;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestionView()
    {
    	return view('question.question');
    }

    public function postQuestion(Request $request)
    {
    	if ($request->ajax())
    	{
    		$this->validate($request, [
                'question' => 'required|max:2000',
            ], [
                'question.required' => 'Your question cannot be blank.',
                'question.max' => 'Your question must be less than 2,000 characters.',
            ]);

            // Retrieve the topic ID
            $topicId = Session::get('topicId');
            $topic = Topic::where('id', $topicId)->first();

            // Create the question record
            $question = Question::create([
                            'user_id' => Auth::user()->id,
                            'question' => $request->input('question'),
                            'topic_id' => $topicId,
                            'views' => 0,
                            'responses' => 0,
                        ]);

            DB::table('question_topic')->insert([
                'question_id' => $question->id,
                'topic_id' => $topicId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Create advisor notification of new question
            // for those advisors that are associated
            // with the topic in the question.

            $advisors = Advisor::whereHas('topics', function ($query) use ($topic) {
                $query->where('topic_name', $topic->topic_name);
            })->get();

            foreach($advisors as $advisor)
            {
                // Get the user record that matches the advisor record
                $userAdvisor = User::where('username', $advisor->username)->first();

                // If user doesn't exist (i.e. advisor is not yet registered as a user),
                // then send email to advisor regarding question and include link to register.
                if (!$userAdvisor)
                {
                    // Set placeholder record in question_notifications table for when the advisor registers
                    DB::table('question_notifications')->insert([
                        'question_id' => $question->id,
                        'user_id' => 0,
                        'username' => $advisor->username,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    // Get key to allow advisor to register
                    $advisorKey = DB::table('advisor_key')->where('email', $advisor->email)->first();
                    
                    // Send email to advisor
                    $advisor->notify(new QuestionNotificationAdvisorNotRegistered($advisor, $question, $topic, $advisorKey));
                    
                }

                if ($userAdvisor)
                {
                    DB::table('question_notifications')->insert([
                        'question_id' => $question->id,
                        'user_id' => $userAdvisor->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]); 

                    // Create email notification to send to advisor.
                    $userAdvisor->notify(new QuestionNotificationAdvisorRegistered($userAdvisor, $question, $topic));
                }
            }
            
            return response()
                ->json([
                    'result' => "Success",
                    'redirect' => "/profile/".Auth::user()->first_name.Auth::user()->last_name,
                ]);
    	}
    }

    // Respond to question
    public function postQuestionResponse(Request $request, $questionId)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'response' => 'required|max:2000',
            ], [
                'response.required' => 'Your response cannot be blank.',
                'response.max' => 'Your response must be less than 2,000 characters.',
            ]);

            $question = Question::where('id', $questionId)->first();
            
            foreach($question->topic as $topic)
            {
                $topic = $topic->topic_name;
            }
            
            $response = Response::create([
                            'response' => $request->input('response'),
                        ]);

            $advisor = Advisor::where('username', Auth::user()->username)->first();

            DB::table('question_responses')->insert([
                'question_id' => $questionId,
                'user_id' => Auth::user()->id,
                'response_id' => $response->id,
                'advisor_id' => $advisor->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Send email notification to user that submitted original question
            $user = User::where('id', $question->user->id)->first();

            $user->notify(new ResponseReceived($user, $response, $question, $topic));

            // Remove question from question_notifications table for this advisor
            DB::table('question_notifications')->where([
                'question_id' => $questionId,
                'user_id' => Auth::user()->id,
            ])->delete();
        }
    }
}
