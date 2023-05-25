<?php

namespace App\Http\Middleware;
use Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){

            //admin role = 2

            if(Auth::user()->role_id == '2'){
                
                return $next($request);

            }else{
                return redirect('/')->with('message', 'access denied');

            }

        }else{
            return redirect('/login')->with('message', 'Login first');
        }

        return $next($request);
    }
}
