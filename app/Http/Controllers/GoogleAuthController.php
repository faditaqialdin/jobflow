<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    use DispatchesJobs;

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/gmail.readonly',
                'https://www.googleapis.com/auth/userinfo.email'
            ])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        /** @var User $user */
        $user = auth()->user();
        $user->update(['gmail' => $googleUser->email]);
        $user->googleToken()->updateOrCreate([], [
            'access_token' => $googleUser->token,
            'refresh_token' => $googleUser->refreshToken,
            'expires_at' => now()->addSeconds($googleUser->expiresIn),
        ]);

        return redirect()->route('sync')->with('success', 'Google connected! Sync started.');
    }

    public function logout(): RedirectResponse
    {
        user()?->googleToken()->delete();
        return redirect()->route('sync')->with('success', 'Disconnected from Google successfully.');
    }
}
