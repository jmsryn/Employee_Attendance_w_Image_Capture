<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->user_type == 'Superadmin'){
                return redirect('/superadmindashboard');
            } elseif(Auth::user()->user_type == 'Admin'){
                return redirect('/admindashboard');
            } elseif(Auth::user()->user_type == 'Employee') {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
