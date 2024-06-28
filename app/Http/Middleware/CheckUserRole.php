<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
   /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard.index');
        } elseif ($user->role == 'user') {
            return redirect()->route('user.dashboard');
        } else {
            return redirect('home'); // Redirect to home or any other page
        }

        return $next($request);
    }
}
