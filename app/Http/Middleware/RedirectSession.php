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
        }else if($request->is('admin/*') && !Session::has('logged')){
            return redirect('/admin');
        }else{
            return $response;
        }
    }
}
