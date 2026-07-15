<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PakarController extends Controller
{

public function index(Request $request)
{
    $query = User::where('role', 'pakar');

    if ($request->filled('search')) {

        $keyword = $request->search;

        $query->where(function ($q) use ($keyword) {

            $q->where('name', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%")
              ->orWhere('no_hp', 'like', "%{$keyword}%");

        });

    }

    $pakar = $query
        ->latest()
        ->paginate(5)
        ->withQueryString();

    return view(
        'pakar.data-pakar',
        compact('pakar')
    );
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email',
        'no_hp' => 'required|regex:/^[0-9]+$/|min:10|max:15',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
        'role' => 'pakar',
        'status' => 'aktif',
    ]);

    return back()->with(
    'success',
    'Data pakar berhasil ditambahkan.'
);
}

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email,' . $id,
        'no_hp' => 'required|max:20',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;

    // jika password diisi
    if ($request->filled('password')) {

        $request->validate([
            'password' => 'confirmed|min:8'
        ]);

        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Data pakar berhasil diupdate.');
}

    public function destroy($id)
    {
        $pakar = User::findOrFail($id);

        // Tidak boleh menghapus akun sendiri
        if ($pakar->id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Minimal harus ada satu pakar
        if (User::where('role', 'pakar')->count() == 1) {
            return back()->with('error', 'Minimal harus ada satu akun pakar.');
        }

        $pakar->delete();

        return back()->with('success', 'Akun pakar berhasil dihapus.');
    }
}