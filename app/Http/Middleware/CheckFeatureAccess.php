<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckFeatureAccess
{

//    public function handle(Request $request, Closure $next, $feature)
//    {
//        if (auth()->check() && auth()->user()->hasFeatureAccess($feature)) {
//            return $next($request);
//        }
//
//        return redirect()->route('dashboard')->with('error', 'Access denied.');
//    }
    public function handle($request, Closure $next ,$feature)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $user = Auth::user(); // Get the authenticated user
        $features = $user->getAccessFeatures(); // Fetch the user's accessible features

        // Check if the requested feature is in the user's available features
        if (!in_array($feature, $features)) {
            abort(403, 'Unauthorized Access'); // Deny access if the feature is not available
        }

        return $next($request); // Allow access if the feature is available
    }

}
