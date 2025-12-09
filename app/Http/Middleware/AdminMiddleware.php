<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'admin') {
            // Bisa pakai abort(403) juga, tapi ini lebih user-friendly
            return redirect('/home')->with('error', 'Akses ditolak! Hanya admin yang bisa masuk.');
        }

        return $next($request);
    }
}
