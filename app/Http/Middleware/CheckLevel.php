<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (!auth()->check()) {
            abort(403, 'Not authenticated');
        }

        if (!in_array(auth()->user()->tahap_pengguna, $levels)) {
            abort(403, 'Unauthorized level');
        }

        return $next($request);
    }
}
