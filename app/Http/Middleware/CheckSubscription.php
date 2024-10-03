<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $packageType): Response
    {
       if (Auth::check()){
           $user = Auth::User();

           $subscription = $user->subscriptions()
               ->where('status', 'Active')
               ->whereDate('end_date', '>=', Carbon::now())
               ->first();
           if (!$subscription){
               return redirect()->route('packages.index')
                   ->with('error', 'Your subscription has expired or is inactive. Please subscribe to continue.');
           }
       } else {
           return redirect()->route('login')->with('error', 'Please log in to continue.');
       }
        return $next($request);
    }
}
