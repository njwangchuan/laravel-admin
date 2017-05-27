<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Log;

class Api
{
  /**
  * Handle an incoming request.
  *
  * @param \Illuminate\Http\Request $request
  * @param \Closure                 $next
  *
  * @return mixed
  */
  public function handle($request, Closure $next, $guard = null)
  {
    if (Auth::user()->hasRole('api')) {
      return $next($request);
    } else {
      return response()->json([
        'error' => 'Forbidden',
        'message' => 'Auth user dose not have role:{api}',
      ], 403);
    }
  }
}
