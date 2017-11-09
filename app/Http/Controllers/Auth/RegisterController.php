<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Captcha;
use Log;

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
     * Where to redirect users after registration.
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
      if (Captcha::check($data['captcha'])) {
        return Validator::make($data, [
          'username' => 'required|min:6|max:20|unique:users',
          'display_name' => 'required|min:2|max:20|unique:users',
          'password' => 'required|min:6|max:20|confirmed',
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
      $webuser = Role::where('name','webuser')->first();
      $data['password'] = bcrypt($data['password']);
      $user =  User::create($data);
      $user->attachRole($webuser);
      return $user;
    }
}
