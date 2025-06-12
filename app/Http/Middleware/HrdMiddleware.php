<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrdMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'hrd') {
            return $next($request);
        }
        return redirect('/login')->with('error', 'Akses ditolak. Hanya HRD yang bisa mengakses.');
    }
}
