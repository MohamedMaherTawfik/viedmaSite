<?php

namespace App\Http\Middleware;

use App\Http\Controllers\api\auth\apiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    use apiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role != 'super_admin') {
            return $this->unauthorized('Unauthorized action.');
        }
        return $next($request);
    }
}