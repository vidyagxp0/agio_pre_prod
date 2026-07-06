<?php

namespace App\Http\Middleware;

use App\Models\TotalLogin;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActivity
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     // if (TotalLogin::ifUserExist(Auth::id())) {
    //     //     $currentTime = Carbon::now();
    //     //     TotalLogin::setLastActivity($currentTime);
    //     // } else {
    //     //     toastr()->warning('Your session has expired due to inactivity.');
    //     //     return redirect('login');
    //     // }
        
    //     // if (Auth::check()) {
    //         // $lastActivity = session('last_activity');
    //         // if ($lastActivity && (time() - $lastActivity > config('session.lifetime'))) {
    //             // Auth::logout();
    //             // toastr()->warning('You have been logged out due to inactivity.');
    //             // return redirect('/login')->with('status', 'You have been logged out due to inactivity.');
    //         // }
    //     // }
    //     // 
    //     // session(['last_activity' => time()]);

        
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $timeout = 60; // 2 minutes

            $lastActivity = session('last_activity');

            if ($lastActivity && (time() - $lastActivity) > $timeout) {

                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')
                    ->with('status', 'Session expired due to inactivity.');
            }

            // check ke baad update karo
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
