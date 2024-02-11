<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isDkmOrBendahara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $request->user()->role === "bendahara" || $request->user()->role === "ketua_dkm"
            ? $next($request)
            : abort(redirect()->back()->with('err', "Gak boleh"));
    }
}
