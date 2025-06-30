<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure this is correctly imported (your User model)
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; // Import for validation errors

class AuthController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validate the incoming data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to authenticate the user
        // The second argument $request->boolean('remember') handles the "remember me" functionality
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Regenerate the session ID for security

            // If it's an AJAX request (e.g., from JavaScript fetch), return JSON
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Login successful', 'user' => Auth::user()]);
            }

            // Redirect to the intended URL or the dashboard after successful login
            return redirect()->intended('/inicio/dashboard')->with('success', 'You have logged in!');
        }

        // 3. If authentication fails, throw a validation exception
        // This will redirect back to the form with an error message
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')], // Laravel's default authentication failed message
        ]);
    }

    /**
     * Show the application's registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks for 'password_confirmation' field
        ]);

        // 2. Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
        ]);

        // 3. Log the user in immediately after registration (optional, but common)
        Auth::login($user);

        // 4. Return appropriate response (JSON for API, redirect for web)
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
        }

        return redirect('/inicio/dashboard')->with('success', 'Registration successful and you are logged in!');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the current session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        // Return JSON for API requests, redirect for web requests
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged out successfully']);
        }

        return redirect('/')->with('success', 'You have been logged out!'); // Redirect to your home page or login page
    }
}