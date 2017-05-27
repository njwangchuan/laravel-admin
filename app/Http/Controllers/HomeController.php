<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Auth;
use Log;

class HomeController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
  }

  public function index(Request $request)
  {
    $action = $request->input('action');
    if ($action) {
      return view('home', compact('action'));
    } else {
      return view('home');
    }
  }

  public function copyright()
  {
    return view('copyright');
  }

  public function autoLogin(Request $request)
  {
    if ($request->has('phone')){
      $user = User::where('phone',$request->input('phone'))->first();
      if ($user){
        Auth::login($user, true);
        if ($user->hasRole('owner') || $user->hasRole('admin')){
          return redirect('admin/dashboard');
        } else {
          return redirect('home');
        }
      }
    }
    return redirect('register');
  }
}
