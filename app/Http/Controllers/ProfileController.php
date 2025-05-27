<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function editExtended(Request $request): View
    {
        $user = $request->user()->load(['peserta', 'pembicara', 'moderator']);
        return view('profile.edit', compact('user'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateExtended(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validasi manual sesuai kebutuhan
        $request->validate([
            'foto' => 'nullable|image|max:2048',
            'alamat' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'pengalaman' => 'nullable|string',
        ]);

        // // Update instansi (di tabel users)
        // if ($request->has('instansi')) {
        //     $user->instansi = $request->instansi;
        // }

        if ($request->filled('instansi')) {
            if ($user->hasRole('peserta')) {
                $user->peserta()->update([
                    'instansi' => $request->instansi,
                ]);
            }

            if ($user->hasRole('pembicara')) {
                $user->pembicara()->update([
                    'instansi' => $request->instansi,
                ]);
            }

            if ($user->hasRole('moderator')) {
                $user->moderator()->update([
                    'instansi' => $request->instansi,
                ]);
            }
        }

        // // Update foto profil (jika diupload)
        // if ($request->hasFile('foto')) {
        //     $path = $request->file('foto')->store('profile_photos', 'public');
        //     $user->profile_photo = $path;
        // }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profile_photos', 'public');

            if ($user->hasRole('peserta')) {
                $user->peserta()->update([
                    'foto' => $path,
                ]);
            }

            if ($user->hasRole('pembicara')) {
                $user->pembicara()->update([
                    'foto' => $path,
                ]);
            }

            if ($user->hasRole('moderator')) {
                $user->moderator()->update([
                    'foto' => $path,
                ]);
            }
        }

        // Update alamat (jika peserta)
        if ($user->hasRole('peserta')) {
            $user->peserta()->update([
                'alamat' => $request->alamat,
            ]);
        }

        // Update bio, linkedin, pengalaman (jika pembicara atau moderator)
        if ($user->hasRole('pembicara')) {
            $user->pembicara()->update([
                'bio' => $request->bio,
                'linkedin' => $request->linkedin,
                'pengalaman' => $request->pengalaman,
            ]);
        } elseif ($user->hasRole('moderator')) {
            $user->moderator()->update([
                'bio' => $request->bio,
                'linkedin' => $request->linkedin,
                'pengalaman' => $request->pengalaman,
            ]);
        }

        $user->save();

        // return Redirect::back()->with('status', 'Profil berhasil diperbarui.');
        return Redirect::route('profile.editExtended')->with('status', 'profile-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
