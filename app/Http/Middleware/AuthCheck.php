<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Check if the user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect('login')->with('fail', 'Anda harus login dulu');
        }
        $userRole = $request->session()->get('user_role');
        if (is_null($userRole)) {
            $userId = $request->session()->get('user_id');
            $user = \App\Models\Customer::find($userId);

            if ($user) {
                $userRole = $user->role;
                $request->session()->put('user_role', $userRole);
            } else {
                return redirect('login')->with('fail', 'User tidak ditemukan');
            }
        }
        if ($role && $userRole !== $role) {
            return redirect('login')->with('fail', 'Anda tidak memiliki akses ke halaman ini');
        }
        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        return $response;
    }
}
