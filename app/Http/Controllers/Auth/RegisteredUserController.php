<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail; // Gantilah sesuai nama file Mailable OTP kamu

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:peserta,pembicara,moderator,penitia,keuangan'],
        ]);

        // Generate OTP dan simpan ke user
        $otp = random_int(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'is_verified' => false,
        ]);

        // Assign role dari input
        $user->assignRole($request->role);

        // Isi tabel relasi berdasarkan role
        switch ($request->role) {
            case 'peserta':
                $user->peserta()->create();
                break;
            case 'pembicara':
                $user->pembicara()->create();
                break;
            case 'moderator':
                $user->moderator()->create();
                break;
                // case 'penitia':
                //     $user->penitia()->create();
                //     break;
                // case 'keuangan':
                //     $user->keuangan()->create();
                //     break;
        }

        // Kirim email OTP
        Mail::to($user->email)->send(new OtpMail($otp));

        // Login dulu dan redirect ke halaman verifikasi OTP
        Auth::login($user);
        session(['email' => $user->email]);
        return redirect()->route('otp.verifikasi')->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }
}
