<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckHomePermission
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('home')) {
            return $next($request);
        }

        return redirect('/');
    }
}
