<?php

namespace Fadvi\Http\Controllers\Auth;

use Fadvi\User;
use Fadvi\Advisor;
use Fadvi\AdvisorJoinRequest;
use Auth;
use Validator;
use Session;
use Image;
use DB;
use Carbon\Carbon;

use Fadvi\Notifications\UserRegistered;
use Fadvi\Notifications\WelcomeAdvisor;

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
                'age_range' => 'required|in:13-17,18-24,25-34,35-44,45-54,55-64,65-74,75+',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
            ], [
                'first_name.required' => 'You must input your first name.',
                'last_name.required' => 'You must input your last name.',
                'age_range.required' => 'You must select an age range.',
                'email.required' => 'You must input your email.',
                'password.required' => 'You must input a password.',
                'password_confirmation.required' => 'You must confirm your password.',
                'password.confirmed' => 'You must confirm your password.',
            ]);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'age_range' => $request->input('age_range'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'advisor_registered' => 0,
            ]);

            // Send welcome email to new user
            $user->notify(new UserRegistered($user));

            Auth::login($user, true);

            if (Session::has('topic'))
            {
                return response()->json("/question");
            }

            return response()->json("/");
        }

            $this->validate($request, [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'age_range' => 'required|in:13-17,18-24,25-34,35-44,45-54,55-64,65-74,75+',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password'
            ], [
                'first_name.required' => 'You must input your first name.',
                'last_name.required' => 'You must input your last name.',
                'age_range.required' => 'You must select an age range.',
                'email.required' => 'You must input your email.',
                'password.required' => 'You must input a password.',
                'password_confirmation.required' => 'You must confirm your password.',
                'password.confirmed' => 'You must confirm your password.',
            ]);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'age_range' => $request->input('age_range'),
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

            if (Session::has('topic'))
            {
                return redirect()->route('question');
            }

            return redirect()->route('index');
            
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

        // If advisor is already registered, then redirect to main page
        $user = User::where('username', $advisor->username)->first();

        if ($user)
        {
            return redirect()->route('login');
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
            'age_range' => "",
        ]);

        // Check question_notifications table for placeholder records.
        // If records exist, add new user_id to each record.
        // This will allow advisor to see available question on the advisor dashboard.
        DB::table('question_notifications')->where('username', $advisor->username)->update(['user_id' => $user->id]);

        // Send email to advisor once registered
        $advisor->notify(new WelcomeAdvisor($advisor));

        Auth::login($user, true);

        return redirect()->route('index');

    }
}
