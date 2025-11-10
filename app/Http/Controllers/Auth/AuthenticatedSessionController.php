<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        // Authenticate the user
        $request->authenticate();

        // Get the authenticated user
        $user = $request->user();

        // Handle banned or pending status
        if ($user->status === 'pending') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('status', 'Your account is still pending approval by admin.');
        }

        if ($user->status === 'banned') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('status', 'Your account has been banned. Please contact support.');
        }

        // Check for email verification (for approved employer)
        if (
            $user->status === 'approved' &&
            !$user->hasVerifiedEmail() &&
            $user->hasRole('employer')
        ) {
            return redirect()->route('verification.notice');
        }

        // Regenerate the session after successful login
        $request->session()->regenerate();

        // Redirect based on role
        if ($user->hasRole('admin')) {
            return redirect()->intended(route('dashboard'));
        }

        if ($user->hasRole('employer')) {
            return redirect()->intended(route('employerDashboard'));
        }
        if ($user->hasRole('supervisor')) {
            return redirect()->intended(route('supervisor.dashboard'));
        }

        // Optional fallback, e.g. for graduates
        return redirect()->intended(route('graduate.dashboard'));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
