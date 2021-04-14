<?php

namespace App\Http\Middleware;

use Closure;
use Sesssion;
use Redirect;
class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('log_dte_id')){
            return redirect()->route('me_profile');
        }
        else{
        return $next($request);
        }
    }
}
