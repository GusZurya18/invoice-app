<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && strtolower(Auth::user()->role ?? '') === 'superadmin') {
            return $next($request);
        }

        // kalau bukan super admin, redirect ke home atau abort
        abort(403, 'Unauthorized.');
    }
}
