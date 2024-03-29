<?php

namespace Fadvi\Http\Controllers;

use Auth;
use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\AdvisorJoinRequest;
use Fadvi\Topic;
use Fadvi\Question;
use Fadvi\Blog;
use Image;
use Session;
use DB;
use Mail;
use Notification;
use Twitter;
use Carbon\Carbon;

use Fadvi\Notifications\AdvisorAdded;
use Fadvi\Notifications\EmailCreated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Fadvi\Http\Requests;

class AdminController extends Controller
{
    public function getDashboard()
    {
    	if (Auth::user()->hasRole('admin'))
    	{
    		// Retrieve a collection of all users and advisors
    		$users = User::all();
            $advisors = Advisor::all();
            $joinRequests = AdvisorJoinRequest::all();
    		
    		return view('admin.dashboard')
                ->with([
                    'users' => $users, 
                    'advisors' => $advisors,
                    'joinRequests' => $joinRequests,
                ]);
    	}

    	return redirect()->route('index');
    }

    public function postDeleteUser(Request $request, $type, $id)
    {
    	if ($request->ajax())
    	{
    		if ($type === "advisor")
            {
                $advisor = Advisor::where('id', $id)->first();
                
                if (!$advisor)
                {
                    return response()->json("No such advisor exists.");
                }

                $advisor->delete();                

                return response()->json("Advisor deleted successfully.");
            }

            if ($type === "user")
            {
                $user = User::where('id', $id)->first();
                
                if (!$user)
                {
                    return response()->json("No such user exists.");
                }

                $user->delete();

                return response()->json("User deleted successfully.");
            }
    	}
    }

    public function getAddAdvisor()
    {
        // Retrieve collection of topic names from database table
        $topics = DB::table('topics')->pluck('topic_name');

        return view('admin.add')->with([
            'topics' => $topics,
        ]);
    }

    public function postAddAdvisor(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:advisors',
            'advisor_type' => 'required|in:FP,CPA,EPA',
            'title' => 'required|max:150',
            'advisor_pic' => 'required',
            'firm_name' => 'required',
            'firm_website' => 'required|url',
            'firm_city' => 'required',
            'firm_state' => 'required',
            'biography' => 'required',
            'topics' => 'required'
        ], [
            'first_name.required' => 'You must input your first name.',
            'last_name.required' => 'You must input your last name.',
            'email.required' => 'You must input your email.',
            'advisor_type.required' => 'You must specify which advisor you are.',
            'title.required' => 'You must specify a title.',
            'advisor_pic.required' => 'You must enter the image path.',
            'firm_name.required' => 'You must enter a firm name.',
            'firm_website.required' => 'You must enter the website.',
            'firm_website.url' => 'The website must be a valid URL.',
            'firm_city.required' => 'You must enter the city.',
            'firm_state.required' => 'You must enter the state.',
        ]);

        $extension = Input::file('advisor_pic')->getClientOriginalExtension();
        // Making $fileNumber separate to be used for unique username
        $fileNumber = (int)round(microtime(true)*1000);
        $fileName = $fileNumber.'.'.$extension;
        
        $image = Image::make($request->file('advisor_pic'))
            ->orientate()
            ->fit(300, 300, function ($constraint) { 
                $constraint->aspectRatio();
            })->save($fileName);

        $image = $image->stream();

        $designations = "";
        if ($request->has('designations'))
        {
            $designations = $request->input('designations');
            $designations = implode(', ', $designations);
        }        
            
        $advisor = Advisor::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'advisor_type' => $request->input('advisor_type'),
            'title' => $request->input('title'),
            'designations' => $designations,
            'image_path' => $fileName,
            'username' => $fileNumber,
            'firm_name' => $request->input('firm_name'),
            'firm_website' => $request->input('firm_website'),
            'firm_city' => ucfirst($request->input('firm_city')),
            'firm_state' => $request->input('firm_state'),
            'biography' => $request->input('biography'),
        ]);

        // Create Advisor-Topic association
        $topics = $request->input('topics');
        
        foreach ($topics as $key => $value)
        {
            $topic = Topic::where('topic_name', $value)->first();

            $advisor->addTopic($topic);

            // Query all available questions to see which questions match with this new advisor
            // and set placeholder record in question_notifications table for when advisor registers
            $questions = Question::whereHas('topic', function ($query) use ($value) {
                $query->where('topic_name', $value);
            })->get();

            foreach ($questions as $question)
            {
                DB::table('question_notifications')->insert([
                    'question_id' => $question->id,
                    'user_id' => 0,
                    'username' => $advisor->username,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // Check if advisor has previously registered as a user
        $user = User::where('email', $advisor->email)->first();

        if (!$user)
        {
            // Generate random code for email registration link
            $randomKey = md5(microtime());

            // Add information to advisor_key table
            DB::table('advisor_key')->insert([
                'email' => $advisor->email,
                'key' => $randomKey,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Send email to advisor notifying them of being added to the directory
            $advisor->notify(new AdvisorAdded($advisor, $randomKey));

            Session::flash('success', "Advisor successfully created!");
            return redirect()->back();
        }

        DB::table('users')->where('email', $advisor->email)->update([
            'advisor_registered' => '1',
            'username' => $advisor->username,
        ]);

        Session::flash('success', "Advisor successfully created!");
        return redirect()->back();
        
    }

    public function getEmail()
    {
        return view('admin.email');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ], [
            'email.required' => 'You must input your email.',
            'subject.required' => 'You must enter a subject.',
            'body.required' => 'You must enter a message',
        ]);

        $email = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');

        Notification::route('mail', $email)->notify(new EmailCreated($email, $subject, $body));

        Session::flash('success', "Email successfully sent!");
        return redirect()->back();
    }

    public function getBlog()
    {
        // Retrieve collection of topic names from database table
        $topics = DB::table('topics')->where('life_event', null)->get();
        // Retrieve collection of life event names from database table
        $life_events = DB::table('topics')->where('life_event', 1)->get();

        return view('admin.blog.index')->with([
            'topics' => $topics,
            'life_events' => $life_events,
        ]);
    }

    public function postBlog(Request $request)
    {
        $this->validate($request, [
            'advisor_name' => 'required',
            'firm_name' => 'required',
            'blog_title' => 'required',
            'blog_main_img' => 'required|url',
            'blog_snippet' => 'required',
            'advisor_blog_url' => 'required',
            'topics' => 'required',
        ]);

        $blog = Blog::create([
            'advisor_name' => $request->input('advisor_name'),
            'firm_name' => $request->input('firm_name'),
            'blog_title' => $request->input('blog_title'),
            'blog_main_img' => $request->input('blog_main_img'),
            'blog_snippet' => $request->input('blog_snippet'),
            'blog_content' => '',
            'url_slug' => '',
            'advisor_blog' => 1,
            'blog_url' => $request->input('advisor_blog_url'),
        ]);

        // Create Blog-Topic association
        $topics = $request->input('topics');
        
        foreach ($topics as $key => $value)
        {
            $topic = Topic::where('id', $value)->first();

            $blog->addTopic($topic);
        }

    

        return redirect()->back();
    
    }
}
