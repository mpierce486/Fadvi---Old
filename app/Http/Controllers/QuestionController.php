<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\Topic;
use Fadvi\Discussion;
use Fadvi\Question;
use Fadvi\Response;
use Fadvi\Detail;
use DB;
use Mail;
use Session;
use Carbon\Carbon;

use Illuminate\Validation\Rule;

use Fadvi\Notifications\QuestionNotificationAdvisorRegistered;
use Fadvi\Notifications\QuestionNotificationAdvisorNotRegistered;
use Fadvi\Notifications\ResponseReceived;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestionView()
    {
        // Retrieve the name of the topic the user has selected
        $topic = Topic::where('topic_name', Session::get('topic'))->first();
        

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
                            'detail_id' => 0,
                        ]);

            DB::table('question_topic')->insert([
                'question_id' => $question->id,
                'topic_id' => $topicId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $step_1 = Session::get('step-details-1');
            $step_2 = Session::get('step-details-2');

            $step_3 = "";
            if(Session::get('step-details-3'))
            {
                $step_3 = Session::get('step-details-3');
            }

            $step_4 = "";
            if(Session::get('step-details-4'))
            {
                $step_4 = Session::get('step-details-4');
            }

            $step_5 = "";
            if(Session::get('step-details-5'))
            {
                $step_5 = Session::get('step-details-5');
            }

            // Create Detail record for the question
            $detail = Detail::create([
                'question_id' => $question->id,
                'step_1' => $step_1,
                'step_2' => $step_2,
                'step_3' => $step_3,
                'step_4' => $step_4,
                'step_5' => $step_5,
            ]);

            // Update Question record with the Detail ID
            DB::table('questions')->where('id', $question->id)->update(['detail_id' => $detail->id]);

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

    /**
     *  Step by step question details workflow
     */

    public function postQuestionDetailsStep1(Request $request)
    {
        // Make sure Session variable is clear first
        Session::forget('step-details-1');

        // Get the session topic
        $topic = Topic::where('topic_name', Session::get('topic'))->first();

        // Get topic step 1 options for validation
        $step1_options = $topic->step_1_options;
        $step1_options = explode(", ", $step1_options);

        if ($request->ajax())
        {
            $step1 = $request->input('step1');
            
            $this->validate($request, [
                'step1' => 'required',
                'step1.*' => Rule::in($step1_options),
            ], [
                'step1.required' => 'You must choose one.',
                'step1.*.in' => 'Invalid response.',
            ]);

            $step1 = implode(", ", $step1);

            // Add step 1 data to session variable
            Session::put('step-details-1', $step1);

            return response()->json(Session::get('step-details-1'));
        }
    }

    public function postQuestionDetailsStep2(Request $request)
    {
        // Make sure Session variable is clear first
        Session::forget('step-details-2');

        // Get the session topic
        $topic = Topic::where('topic_name', Session::get('topic'))->first();

        // Get topic step 1 options for validation
        $step2_options = $topic->step_2_options;
        $step2_options = explode(", ", $step2_options);

        if ($request->ajax())
        {
            $step2 = $request->input('step2');

            $this->validate($request, [
                'step2' => 'required',
                'step2.*' => Rule::in($step2_options),
            ], [
                'step2.required' => 'You must choose one.',
                'step2.*.in' => 'Invalid response.',
            ]);

            $step2 = implode(", ", $step2);

            // Add step 2 data to session variable
            Session::put('step-details-2', $step2);

            return response()->json(Session::get('step-details-2'));
        }
    }

    public function postQuestionDetailsStep3(Request $request)
    {
        // Make sure Session variable is clear first
        Session::forget('step-details-3');

        // Get the session topic
        $topic = Topic::where('topic_name', Session::get('topic'))->first();

        // Get topic step 1 options for validation
        $step3_options = $topic->step_3_options;
        $step3_options = explode(", ", $step3_options);

        if ($request->ajax())
        {
            $step3 = $request->input('step3');

            $this->validate($request, [
                'step3' => 'required',
                'step3.*' => Rule::in($step3_options),
            ], [
                'step3.required' => 'You must choose one.',
                'step3.*.in' => 'Invalid response.',
            ]);

            $step3 = implode(", ", $step3);

            // Add step 2 data to session variable
            Session::put('step-details-3', $step3);

           return response()->json(Session::get('step-details-3'));
        }
    }

    public function postQuestionDetailsStep4(Request $request)
    {
        // Make sure Session variable is clear first
        Session::forget('step-details-4');

        // Get the session topic
        $topic = Topic::where('topic_name', Session::get('topic'))->first();

        // Get topic step 1 options for validation
        $step4_options = $topic->step_4_options;
        $step4_options = explode(", ", $step4_options);

        if ($request->ajax())
        {
            $step4 = $request->input('step4');

            $this->validate($request, [
                'step4' => 'required',
                'step4.*' => Rule::in($step4_options),
            ], [
                'step4.required' => 'You must choose one.',
                'step4.*.in' => 'Invalid response.',
            ]);

            $step4 = implode(", ", $step4);

            // Add step 2 data to session variable
            Session::put('step-details-4', $step4);

           return response()->json(Session::get('step-details-4'));
        }
    }

    public function postQuestionDetailsStep5(Request $request)
    {
        // Make sure Session variable is clear first
        Session::forget('step-details-5');

        // Get the session topic
        $topic = Topic::where('topic_name', Session::get('topic'))->first();

        // Get topic step 1 options for validation
        $step5_options = $topic->step_5_options;
        $step5_options = explode(", ", $step5_options);

        if ($request->ajax())
        {
            $step5 = $request->input('step5');

            $this->validate($request, [
                'step5' => 'required',
                'step5.*' => Rule::in($step5_options),
            ], [
                'step5.required' => 'You must choose one.',
                'step5.*.in' => 'Invalid response.',
            ]);

            $step5 = implode(", ", $step5);

            // Add step 2 data to session variable
            Session::put('step-details-5', $step5);

           return response()->json(Session::get('step-details-5'));
        }
    }
}
