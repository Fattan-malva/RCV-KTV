<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestCheck
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
        // Check if the user is logged in
        if ($request->session()->has('user_id')) {
            // Get user role
            $userRole = $request->session()->get('user_role');

            // Redirect based on role
            if ($userRole == 'admin' || $userRole == 'superadmin') {
                return redirect()->route('admin.dashboard')->with('fail', 'Anda sudah login sebagai admin/superadmin');
            } elseif ($userRole == 'user') {
                return redirect()->route('user.index')->with('fail', 'Anda sudah login sebagai user');
            }
        }

        // Set headers to prevent browser cache for login page
        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        // Return the response with the modified headers
        return $response;
    }
}
