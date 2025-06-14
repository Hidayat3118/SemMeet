<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showForm()
    {
        return view('auth.otp-verifikasi');
    }

    public function verifikasiOtp(Request $request)
    {
        //    dd($request->all()); // ⬅️ Tambahkan ini dulu
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'OTP salah atau sudah kadaluarsa.']);
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'is_verified' => true,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'OTP berhasil diverifikasi.');
    }
}
