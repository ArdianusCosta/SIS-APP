<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('google_login'), 
                    'status' => 1,
                ]);
            }

            if ($user->status == 0) {
                return redirect()->route('auth.login')->withErrors([
                    'email' => 'Akun anda telah dibanned. Hubungi Admin untuk bantuan lebih lanjut.',
                ]);
            }

            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google');
        }
    }

}
