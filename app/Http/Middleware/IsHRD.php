<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsHRD
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'hrd') {
            return response()->json(['message' => 'Access Denied'], 403);
        }
        return $next($request);
    }
}
