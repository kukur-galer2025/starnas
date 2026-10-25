<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pekerjaan' => 'nullable|string|max:255',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'nomor_handphone' => 'nullable|string|max:15',
            'provinsi' => 'nullable|string|max:255',
            'institusi' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_handphone' => $request->nomor_handphone,
            'provinsi' => $request->provinsi,
            'institusi' => $request->institusi,
            'password' => Hash::make($request->password),
            'role' => 'peserta',
        ]);

        Auth::login($user);
        return redirect()->route('peserta.beranda'); 
    }
}