<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('products.index');
        }

        return back()
            ->with('error', 'Username atau password salah.')
            ->withInput(['username' => $request->username]);
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'username'     => 'required|string|max:50|unique:users,username',
            'password'     => 'required|string|min:6|confirmed',
            'no_hp'        => 'nullable|string|max:15',
            'alamat'       => 'nullable|string',
        ]);

        // Generate id_user otomatis
        $count = User::count() + 1;
        $id_user = 'USR' . str_pad($count, 12, '0', STR_PAD_LEFT);

        User::create([
            'id_user'      => $id_user,
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'username'     => $request->username,
            'password'     => $request->password,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        // Langsung login setelah register
        Auth::attempt($request->only('username', 'password'));
        $request->session()->regenerate();
        return redirect()->route('products.index');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}