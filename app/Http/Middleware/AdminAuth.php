<?php

namespace App\Http\Middleware;

use Closure;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::guard('admin')->check()) {
            toastr()->error('Login failed.');
            return redirect('admin/login');
        }

        return $next($request);
    }
}
