<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;

class AuthUserController extends Controller
{
    public function showLoginForm(): Response
    {
        return response(view('auth.login'));

    }
    public function login(Request $request): RedirectResponse
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {

            $customer = Customer::where('username', $username)->first();

            if (!$customer || !Hash::check($password, $customer->password)) {
                throw new \Exception('Username and Password do not match.');
            }

            // Store user ID, role, and name in the session
            $request->session()->put('user_id', $customer->id);
            $request->session()->put('user_username', $customer->username);
            $request->session()->put('user_role', $customer->role);
            $request->session()->put('user_name', $customer->name);

            if ($customer->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Success login.');
            } else {
                return redirect()->route('user.index')->with('success', 'Success login.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', '' . $e->getMessage());
        }
    }
    /**
     * Handle user registration.
     */
    public function storeregister(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:customer',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:50',
            'name' => 'required|string|max:50|regex:/^[\p{L}\s]+$/u',
            'login_type' => 'required|string|max:50',
        ]);
        $customer = Customer::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'name' => $request->input('name'),
            'login_type' => $request->input('login_type'),
        ]);
        return redirect()->route('login')->with('success', 'Register successfully.');
    }
    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Forget both user_id and user_role from the session
        $request->session()->forget('user_id');
        $request->session()->forget('user_role');

        // Clear the session completely if needed
        $request->session()->flush();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }


    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->stateless()->user();
        $registeredUser = User::where('google_id', $socialUser->id)->first();
    
        if (!$registeredUser) {
            // Create or update the User record
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123x'),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);
    
            // Create the Customer record
            $customer = Customer::create([
                'username' => $socialUser->email, // Using email as username
                'password' => Hash::make('123x'), // Setting a default password for new users
                'role' => 'user', // Default role for new users
                'name' => $socialUser->name, // Setting the name from Google
                'login_type' => 'Google Account', // Marking as a Google login
            ]);
    
            // Login the user
            Auth::login($user);
    
            // Store user info including email in session
            session([
                'user_id' => $user->id,
                'user_username' => $user->email,
                'user_role' => 'user', // Assuming the role is 'user'
                'user_name' => $user->name,
                'user_email' => $user->email, // Storing email in the session
            ]);
    
            return redirect()->route('user.index');
        }
    
        // If the user is already registered, log them in
        Auth::login($registeredUser);
    
        // Store user info in session
        session([
            'user_id' => $registeredUser->id,
            'user_username' => $registeredUser->email,
            'user_role' => 'user', // Assuming the role is 'user'
            'user_name' => $registeredUser->name,
            'user_email' => $registeredUser->email, // Storing email in the session
        ]);
    
        return redirect()->route('user.index');
    }
    
    
}
