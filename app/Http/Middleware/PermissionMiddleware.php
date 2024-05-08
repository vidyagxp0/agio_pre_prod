<?php

namespace App\Http\Middleware;

use App\Models\GroupCategory;
use Closure;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->isMethod('GET')) {
        }

        if ($request->isMethod('POST')) {
        }

        return $next($request);
    }
}
