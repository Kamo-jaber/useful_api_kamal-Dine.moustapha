<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->user());
        if (!$request->user_modules() || !$request->user_modules()->active) {
            return response()->json(["error" => "Module inactive. Please activate this module to use it."], 403);
        }
        return $next($request);
    }
}
