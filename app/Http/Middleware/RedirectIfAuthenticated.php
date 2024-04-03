<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null, string ...$guards): Response
    {
        // dd($request, $next, $guards, Auth::user());
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->user_type == 1) {
                    return redirect()->route('admin.livewire.dashboard');
                }
                return redirect()->route('store.index');
            }
        }

        // if(Auth::user()) {
        //     if(Auth::user()->user_type == $role) {
        //         return $next($request);
        //     } else {
        //         if(Auth::user()->user_type == 1) {
        //             return redirect()->route('admin.livewire.dashboard');
        //         }
        //         return redirect()->route('store.index');
        //     }
        // }

        return $next($request);
    }
}
