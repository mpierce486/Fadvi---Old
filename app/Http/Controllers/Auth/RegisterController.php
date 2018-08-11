<?php

namespace Fadvi\Http\Controllers\Auth;

use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\AdvisorJoinRequest;
use Auth;
use Validator;
use Session;
use Image;
use Mail;
use DB;
use Carbon\Carbon;

use Fadvi\Mail\Welcome;
use Fadvi\Mail\AdvisorRequest;
use Fadvi\Mail\AdvisorRegisterEmail;
use Fadvi\Mail\WelcomeAdvisor;

use Fadvi\Notifications\UserRegistered;

use Fadvi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // ***** REGISTER AS NON-ADVISOR USER *****

    public function getRegisterView()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        if ($request->ajax())
        {
           $this->validate($request, [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
            ], [
                'first_name.required' => 'You must input your first name.',
                'last_name.required' => 'You must input your last name.',
                'email.required' => 'You must input your email.',
                'password.required' => 'You must input a password.',
                'password_confirmation.required' => 'You must confirm your password.',
                'password.confirmed' => 'You must confirm your password.',
            ]);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'advisor_registered' => 0,
            ]);

            // Send welcome email to new user
            $user->notify(new UserRegistered($user));

            Auth::login($user, true);

            if (Session::has('event'))
            {
                return response()->json("/question");
            }

            return response()->json("/");
        }

            $this->validate($request, [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
            ], [
                'first_name.required' => 'You must input your first name.',
                'last_name.required' => 'You must input your last name.',
                'email.required' => 'You must input your email.',
                'password.required' => 'You must input a password.',
                'password_confirmation.required' => 'You must confirm your password.',
                'password.confirmed' => 'You must confirm your password.',
            ]);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'advisor_registered' => 0,
            ]);

            // Send welcome email to new user
            $user->notify(new UserRegistered($user));

            if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
                return redirect()->route('forgotlogin');
            }

            Auth::login($user, true);

            if (Session::has('event'))
            {
                return redirect()->route('question');
            }

            return redirect()->route('index');
            
    }

    // Check advisor's email to see if advisor is already in the directory
    public function postAdvisorRegisterCheck(Request $request)
    {
        $this->validate($request, [
            'advisor-email' => 'required|email',
        ], [
            'advisor-email.required' => 'You must input your email.',
        ]);

        // Check if email entered matches an email in the Advisor table
        $advisor = Advisor::where('email', $request->input('advisor-email'))->first();

        // If advisor is not in  directory, redirect to page for advisor to request to join
        if (!$advisor)
        {
            return redirect()->route('auth.register.advisor');
        }

        Session::put('advisorrequest', $advisor);
        return redirect()->route('auth.register.advisor.link');
    }

    // If advisor is in the directory, return view to request access link sent to email
    public function getAdvisorAccessLinkView()
    {
        // Get advisor information saved through the session
        $advisor = Session::get('advisorrequest');

        // If advisor is already registered, include partial in view
        $advReg = User::where('email', $advisor->email)->first();
        
        if ($advReg)
        {
            Session::put('advReg', '');
        }
        
        return view('auth.advisor.advisor-access-request')
            ->with([
                'advisor' => $advisor,
                'advReg' => $advReg,
            ]);
    }

    // Send registration link to advisor's email address in the directory
    public function postAdvisorAccessLink($email)
    {
        // Get advisor that has email entered
        $advisor = Advisor::where('email', $email)->first();

        // If advisor doesn't exist, return back with session error data
        if (!$advisor)
        {
            Session::flash('email-error', "There is an error with your request. Please go back and try again.");
            return redirect()->back(); 
        }

        // Check if advisor has already requested an access link. If so, resend email with existing link.
        $alreadyRequested = DB::table('advisor_key')->where('email', $email)->first();

        if ($alreadyRequested)
        {
            $randomKey = $alreadyRequested->key;

            Mail::to($advisor)->send(new AdvisorRegisterEmail($advisor, $randomKey));

            Session::flash('request-link', "");
            return redirect()->back();
        }

        // Generate random code for email registration link
        $randomKey = md5(microtime());

        // Add information to advisor_key table
        DB::table('advisor_key')->insert([
            'email' => $advisor->email,
            'key' => $randomKey,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Send email with registration link to advisor's email address
        Mail::to($advisor)->send(new AdvisorRegisterEmail($advisor, $randomKey));

        // If successfull, return back with flash message
        Session::flash('request-link', "");
        return redirect()->back(); 
    }

    // Method when advisor clicks registration link in email
    public function getRegisterAdvisor($key)
    {
        $key = DB::table('advisor_key')->where('key', $key)->first();
        
        $advisor = Advisor::where('email', $key->email)->first();

        if (!$advisor)
        {
            return redirect()->route('index');
        }

        return view('auth.advisor.advisor-register')
            ->with([
                'advisor' => $advisor,
                'key' => $key
            ]);
    }

    // Register the advisor as a user on the website
    public function postRegisterAdvisor(Request $request, $key)
    {
        $key = DB::table('advisor_key')->where('key', $key)->first();
        
        $advisor = Advisor::where('email', $key->email)->first();

        if (!$advisor)
        {
            return redirect()->route('index');
        }

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password' 
        ]);

        $user = User::create([
            'first_name' => $advisor->first_name,
            'last_name' => $advisor->last_name,
            'email' => $advisor->email,
            'password' => bcrypt($request->input('password')),
            'advisor_registered' => 1,
            'username' => $advisor->username,
        ]);

        // Check question_notifications table for placeholder records.
        // If records exist, add new user_id to each record.
        DB::table('question_notifications')->where('username', $advisor->username)->update(['user_id' => $user->id]);

        // Send email to advisor once registered
        Mail::to($advisor)->send(new WelcomeAdvisor($advisor));

        Auth::login($user, true);

        return redirect()->route('index');

    }

    // If advisor is not in the directory send to the request to join page
    public function getAdvisorJoinRequestView()
    {
        return view('auth.advisor.advisor-join-request');
    }

    // Post method for advisor requesting to join the directory
    public function postAdvisorJoinRequest(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'advisor_type' => 'required|in:FP,CPA,EPA',
            'title' => 'required|max:150',
            'advisor_pic' => 'required|image|max:4999',
            'firm_name' => 'required',
            'firm_address' => 'required',
            'services' => 'required',
            'about' => 'required|max:250',
        ], [
            'first_name.required' => 'You must input your first name.',
            'last_name.required' => 'You must input your last name.',
            'email.required' => 'You must input your email.',
            'advisor_type.required' => 'You must specify which advisor you are.',
            'title.required' => 'You must specify a title.',
            'advisor_pic.required' => 'You must upload a photo.',
            'firm_name.required' => 'You must enter a firm name.',
            'firm_address.required' => 'You must enter an address.',
            'services.required' => 'You must list your services offered',
            'about.required' => 'You must enter text.',
            'about.max' => 'Maximum 250 characters.',
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

        // Geocode the user's address
            
        $address = urlencode($request->input('firm_address'));

        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=".env('GOOGLE_KEY');

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){

            // get the important data
            $lat = $resp['results'][0]['geometry']['location']['lat'];
            $long = $resp['results'][0]['geometry']['location']['lng'];

        }else{
            return redirect()->back();
        }

        // End geocode

        $designations = "";
        if ($request->has('designations'))
        {
            $designations = $request->input('designations');
            $designations = implode(', ', $designations);
        }

        // Add join request to DB table
        $advisor = AdvisorJoinRequest::create([
            'username' => $fileNumber,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'advisor_type' => $request->input('advisor_type'),
            'title' => $request->input('title'),
            'designations' => $designations,
            'image_path' => $fileName,
            'firm_name' => $request->input('firm_name'),
            'firm_address' => $request->input('firm_address'),
            'services' => $request->input('services'),
            'about' => $request->input('about'),
            'lat' => $lat,
            'long' => $long,
        ]);

        // Send email to admins notifying them there is a request to join the directory
        Mail::to("support@fadvi.com")->send(new AdvisorRequest($advisor));

        // Send email to advisor to confirm we received request to join directory

        Session::flash('request', "");
        return redirect()->back();
    }
}
