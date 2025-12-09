<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Hanya role "user" yang boleh ke route ber-middleware user
        if (auth()->user()->role !== 'user') {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
