<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Redirect pengguna ke halaman autentikasi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Tangani callback dari Google OAuth.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari user berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                // 2. Jika belum ada google_id, cari berdasarkan email
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Update user yang sudah ada dengan google_id
                    $user->update([
                        'google_id' => $googleUser->getId()
                    ]);
                } else {
                    // 3. Buat akun baru jika belum terdaftar
                    $user = User::create([
                        'nama_lengkap' => $googleUser->getName() ?: 'Peserta STARNAS',
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'password' => null,
                        'role' => 'peserta',
                    ]);
                }
            }

            Auth::login($user, true);
            request()->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'peserta') {
                return redirect()->intended(route('peserta.beranda'));
            }

            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal masuk melalui Google. Silakan coba lagi atau gunakan login email.',
            ]);
        }
    }

    /**
     * Tangani permintaan login yang masuk.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // LOGIKA PENGECKAN ROLE DAN REDIRECTION DIPUSATKAN DI SINI
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'peserta') {
                // REDIRECTION PESERTA KE PESERTA.BERANDA
                return redirect()->intended(route('peserta.beranda')); 
            }
            
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}