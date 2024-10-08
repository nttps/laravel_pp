<?php

namespace NttpDev\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthBackEndController extends Controller
{
    use AuthenticatesUsers;

        /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    
    public function login(){
        if (Auth::user()) {
            return redirect()->route('admin.dashboard');
        }

        return view('backend.login');
    }



    public function postlogin(Request $request){

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /*
    * Preempts $redirectTo member variable (from RedirectsUsers trait)
    */
    public function redirectTo()
    {
        return redirect()->route('admin.dashboard');
    }
}
