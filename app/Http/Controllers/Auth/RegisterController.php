<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => [
            'required',
            'regex:/^[0-9]+$/',
            'min:10',
            'max:15'
        ],
            'tanggal_lahir' => 'required|date',
            'password' => [
            'required',
            'min:8',
            'confirmed'
        ],
        'password.min' =>
        'Password minimal harus 8 karakter.',

        'no_hp.regex' =>
            'Nomor telepon hanya boleh berisi angka.',

        'no_hp.digits_between' =>
            'Nomor telepon harus terdiri dari 10 sampai 15 digit.',
        ]);

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'role' => 'pasien',
                'status' => 'aktif',
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->route('pasien.dashboard');
    }
}