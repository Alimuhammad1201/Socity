<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckFeatureAccess
{
    public function handle($request, Closure $next, $feature)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $features = $user->getAccessFeatures();

        if (!in_array($feature, $features)) {
            abort(403, 'Unauthorized Access');
        }
        return $next($request);
    }
//    public function handle($request, Closure $next, $feature = null)
//    {
//        if (Auth::guard('building_admin')->check()) {
//
//            $buildingadmin = Auth::guard('building_admin')->user();
//            $features = $buildingadmin->getBuildingAccessFeatures();
////            $features = explode(',', $user->feature);
//
//            if (!in_array($feature, $features)) {
//                abort(403, 'Unauthorized Access');
//            }
//            return $next($request);
//        }
//        if (Auth::check()) {
//            $user = Auth::user();
//            $features = $user->getAccessFeatures();
//
//            if (!in_array($feature, $features)) {
//                abort(403, 'Unauthorized Access');
//            }
//            return $next($request);
//        }
//        if ($request->is('building_admin/*')) {
//            return redirect()->route('building_admin.login');
//        } else {
//            return redirect()->route('login');
//        }
//    }

}
