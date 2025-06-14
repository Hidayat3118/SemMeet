<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordOtpController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password-otp');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = random_int(100000, 999999);

        $user->update([
            'reset_otp' => $otp,
            'reset_otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        session(['reset_email' => $user->email]);
        return redirect()->route('password.otp.verify')->with('status', 'OTP telah dikirim ke email Anda.');
    }

    public function showVerifyOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        // Tambahkan ini untuk debug:
        // dd([
        //     'email_session' => session('reset_email'),
        //     'otp_input' => $request->otp,
        //     'user_found' => User::where('email', session('reset_email'))->first(),
        // ]);

        $user = User::where('email', session('reset_email'))
            ->where('reset_otp', $request->otp)
            ->where('reset_otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'OTP tidak valid atau kadaluarsa.']);
        }

        session(['otp_verified_email' => $user->email]);
        return redirect()->route('password.reset.form');
    }

    public function showResetForm()
    {
        return view('auth.reset-password-with-otp');
    }



    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::where('email', session('otp_verified_email'))->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Email tidak valid.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'reset_otp' => null,
            'reset_otp_expires_at' => null,
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil diubah.');
    }
}
