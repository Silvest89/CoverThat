<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginAuthenthication
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

        if (Auth::check()) {

            $user = Auth::user();
            if($user->admin) {

                return redirect()->intended(route('admin_dashboard'));
            }
            else {

                return redirect()->intended(route('user_dashboard'));
            }
        }

        return $next($request);
    }
}
