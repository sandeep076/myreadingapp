<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            //for logged in teachers
            case 'teacher':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('teacher.dashboard');
                }
                break;
            
            default:
                //for logged in parents
                if(Auth::guard($guard)->check()){
                    return redirect('/home');
                }
                break;
        }
        //otherwise, go to the next request, aka the next middleware
        return $next($request);
    }
}
