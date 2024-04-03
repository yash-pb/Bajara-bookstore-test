<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        // if(Auth::user()) {
        //     if(Auth::user()->user_type == 1) {
        //         // dd(Auth::user(), "dfs");
        //         return redirect()->route('admin');
        //     }
        //     // return redirect()->route('store.index');
        //     return $next($request);
        // }

        // dd(Auth::user());
        // if (!Auth::check()) {
        //     return redirect()->route('store.index');
        // }
            
        if (Auth::check() && Auth::user()->user_type != 1) {
            // dd('Auth');
            return redirect()->route('store.index');
        }
  
        // if (Auth::user()->role == 2) {
        //     // return redirect()->route('store.index');
        //     return $next($request);
        // }

        return $next($request);

    }
}
