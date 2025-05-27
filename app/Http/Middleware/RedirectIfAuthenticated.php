<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on user role
                $user = Auth::user();

                if ($user->role == 'user') {
                    return redirect()->route('dashboard');
                }
                if ($user->role == 'agent') {
                    return redirect()->route('agent.dashboard');
                }
                if ($user->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                }
            }
        }

        return $next($request);
    }
}
