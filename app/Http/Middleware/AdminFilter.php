<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
class AdminFilter
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isAdmin != 1)
		{
			return redirect('home');
		}
        return $next($request);
    }
}
