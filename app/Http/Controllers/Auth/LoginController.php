<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Login sebagai pakar
            if ($user->role === 'pakar') {
                return redirect()->route('pakar.dashboard');
            }

            // Login sebagai pasien
            if ($user->role === 'pasien') {
                return redirect()->route('pasien.dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return back()->withErrors([
                'email' => 'Role pengguna tidak dikenali.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
}