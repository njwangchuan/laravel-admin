<?php

namespace App\Http\Middleware;

use Request;
use Route;
use Closure;
use Illuminate\Support\Facades\Auth;
use Log;

class AuthOnce
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
    return Auth::onceBasic() ?: $next($request);
  }
}
