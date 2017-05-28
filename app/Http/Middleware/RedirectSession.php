<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class RedirectSession
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
        $response = $next($request);
        if(Session::has('logged')){
            return $response;
        }else if($request->is('student/*') && !Session::has('logged')){
            return redirect('/');
        }else if($request->is('employer/*') && !Session::has('logged')){
            return redirect('/');
        }else{
            return $response;
        }
    }
}
