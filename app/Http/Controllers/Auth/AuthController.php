<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Captcha;
use Log;

class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
  * Where to redirect users after login / registration.
  *
  * @var string
  */
  protected $redirectTo = '/';

  protected $username = 'username';

  /**
  * Create a new authentication controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
      $this->loginUsername() => 'required', 'password' => 'required','captcha' => 'required|captcha'
    ]);
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function validator(array $data)
  {
    if (Captcha::check($data['captcha'])) {
      return Validator::make($data, [
        'username' => 'required|min:6|max:20|unique:users',
        'display_name' => 'required|min:2|max:20|unique:users',
        'email' => 'unique:users|email',
        'phone' => 'unique:users|phone:CN,mobile'
      ]);
    } else {
      return Validator::make($data, [
        'captcha' => 'required|captcha',
      ]);
    }
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return User
  */
  protected function create(array $data)
  {
    Log::info(111);
    $webuser = Role::where('name','webuser')->first();
    $user =  User::create($data);
    $user->attachRole($webuser);
    return $user;
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
