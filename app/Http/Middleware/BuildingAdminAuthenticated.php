<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class BuildingAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated as either 'builder' or 'building_admin'
        $user = Auth::guard('web')->user() ?: Auth::guard('building_admin')->user() ?: Auth::guard('flat_guard')->user() ?: Auth::guard('employee_guard')->user();

        // If the user is not authenticated, redirect to the login page
        if (!$user) {
            return redirect()->route('login'); // Replace 'login' with the appropriate route name
        }

        // Check if the user has access features only if user is not null
        if ($user && method_exists($user, 'getBuildingAccessFeatures')) {
            $features = $user->getBuildingAccessFeatures();

            // Additional checks can be added here based on your requirements
        }

        return $next($request);
    }
}
