<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

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
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'username';
    }

    /**
    * Validate the user login request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return void
    */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
        'captcha' => 'required|captcha'
      ]);
    }

    public function redirectPath()
    {
        // Logic that determines where to send the user
        if (\Auth::user()->hasRole('owner') || \Auth::user()->hasRole('admin')) {
            return 'admin/dashboard';
        } else {
            return '/';
        }
    }
}
