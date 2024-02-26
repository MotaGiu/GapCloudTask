<?php

namespace App\Domains\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminCheck.
 *
 * Middleware to ensure that only users with admin privileges can access certain routes.
 */
class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if there's an authenticated user and if the user is an admin
        if (Auth::check() && Auth::user()->isType('admin')) {
            return $next($request);
        }

        // Optionally, include a flash message or log statement here to indicate unauthorized access attempt
        
        // Redirect non-admin users to a specific route
        return redirect()->route('frontend.index')->withFlashDanger(__('You do not have access to do that.'));
    }
}
