<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if (!$request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
        }
    
        $user = $request->user();
    
        // Redirect berdasarkan role
        if ($user->hasRole('peserta')) {
            return redirect()->route('peserta');
        } elseif ($user->hasRole('pembicara')) {
            return redirect()->route('pembicaraTes');
        } elseif ($user->hasRole('moderator')) {
            return redirect()->route('moderatorTes');
        } elseif ($user->hasRole('panitia')) {
            return redirect()->route('panitia.dashboard');
        } elseif ($user->hasRole('keuangan')) {
            return redirect()->route('keuangan.dashboard');
        }
    
        // Fallback
        return redirect('/?verified=1');
    }
    
}
