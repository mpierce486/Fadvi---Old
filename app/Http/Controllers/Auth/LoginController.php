<?php

namespace Fadvi\Http\Controllers\Auth;

use Auth;
use Session;
use Fadvi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    public function getLoginView()
    {
        return view('auth.login');
    }

    public function getLogout()
    {
        Auth::logout();

        Session::flush();

        return redirect()->route('index');
    }

    public function postLogin(Request $request)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ], [
                'email.required' => 'You must input your email.',
                'email.email' => 'You must input a valid email address.',
                'password.required' => 'You must input your password.',
            ]);

            if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
                return response()->json("/login/error");
            }

            if (Session::has('event'))
            {
                return response()->json("/question");
            }

            return response()->json("/");
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'You must input your email.',
            'email.email' => 'You must input a valid email address.',
            'password.required' => 'You must input your password.',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->route('auth.error');
        }

        if (Session::has('event'))
        {
            return redirect()->route('question');
        }

        return redirect()->route('index');
        
    }

    public function getLoginError()
    {
        return view('auth.loginerror');
    }
}
