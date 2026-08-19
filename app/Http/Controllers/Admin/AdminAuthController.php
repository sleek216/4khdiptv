<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    /**
     * Show dedicated Admin Login portal
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Authenticate Admin User
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip() . '|admin_login');

        // Brute force protection: Lock out after 5 attempts for 20 minutes (1200s)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            session()->flash('lockout_seconds', $seconds);
            return back()->withErrors([
                'email' => "Portal access locked due to 5 failed attempts. Please wait {$minutes} minute(s) before trying again.",
            ])->onlyInput('email');
        }

        if (Auth::validate($credentials)) {
            $user = User::where('email', $credentials['email'])->first();

            // Strict check: Only Admin accounts (is_admin = true) are permitted
            if (!$user || !$user->isAdmin()) {
                $attempts = RateLimiter::hit($throttleKey, 1200);
                if ($attempts >= 5) {
                    $seconds = RateLimiter::availableIn($throttleKey);
                    session()->flash('lockout_seconds', $seconds);
                    return back()->withErrors([
                        'email' => "Too many failed attempts. Portal access is now locked for 20 minutes.",
                    ])->onlyInput('email');
                }

                $remaining = 5 - $attempts;
                $warning = $attempts > 2 ? " (Warning: {$remaining} " . ($remaining === 1 ? 'attempt' : 'attempts') . " remaining before 20-minute lockout)" : "";

                return back()->withErrors([
                    'email' => 'Access denied. You do not have administrator permissions for this portal.' . $warning,
                ])->onlyInput('email');
            }

            RateLimiter::clear($throttleKey);

            // Handle Two-Factor Authentication if enabled
            if ($user->google2fa_enabled) {
                session()->put([
                    '2fa_user_id' => $user->id,
                    '2fa_remember' => $request->boolean('remember'),
                ]);

                return redirect()->route('2fa.show');
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            // Update login timestamp
            $user->update(['last_login_at' => now()]);

            $defaultRoute = $user->defaultAdminRouteName() ?: 'admin.dashboard';
            return redirect()->intended(route($defaultRoute));
        }

        // Increment failed attempt counter with 20-minute decay (1200 seconds)
        $attempts = RateLimiter::hit($throttleKey, 1200);

        if ($attempts >= 5) {
            $seconds = RateLimiter::availableIn($throttleKey);
            session()->flash('lockout_seconds', $seconds);
            return back()->withErrors([
                'email' => "Too many failed login attempts. Portal access is now locked for 20 minutes.",
            ])->onlyInput('email');
        }

        $remaining = 5 - $attempts;
        $warning = $attempts > 2 
            ? " (Warning: {$remaining} " . ($remaining === 1 ? 'attempt' : 'attempts') . " remaining before 20-minute lockout)"
            : "";

        return back()->withErrors([
            'email' => 'Invalid administrator credentials.' . $warning,
        ])->onlyInput('email');
    }

    /**
     * Securely Log out Administrator
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been securely logged out from the Admin Portal.');
    }
}
