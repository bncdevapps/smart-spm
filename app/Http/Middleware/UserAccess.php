<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$otorisasi): Response
    {
        if (Auth::check() && in_array(Auth::user()->otorisasi, $otorisasi)) {
            return $next($request);
        }
        abort(403, 'Unauthorized');

        // if (auth()->user()->otorisasi == $otorisasi) {
        //     return $next($request);
        // }

        // return response()->json(['You do not have permission to access for this page.']);
    }
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
}
