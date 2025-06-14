<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureOtpIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kalau belum login, redirect ke login
        if (!$user) {
            return redirect()->route('login');
        }

        // Kalau belum verifikasi OTP, redirect ke form OTP
        if (!$user->is_verified) {
            return redirect()->route('otp.verifikasi')->with('status', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        return $next($request);
    }
}
