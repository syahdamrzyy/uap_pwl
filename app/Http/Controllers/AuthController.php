<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $token = Str::random(64);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'remember_token' => $token, // ← simpan token di sini!
    ]);

    // Kirim email verifikasi
    Mail::send('auth.verify', compact('user', 'token'), function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Verifikasi Email - PERKEDEL');
    });

    return redirect('/login')->with('success', 'Kami telah mengirim link verifikasi ke email kamu.');
}
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->with('error', 'Email atau password salah.');
    }


    if (Auth::user()->email_verified_at === null) {
        Auth::logout();
        return redirect('/login')->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
    }

    return redirect('/home')->with('success', 'Berhasil login.');
}
    public function verifyUser($token)
{
    $user = User::where('remember_token', $token)->first();

    if (!$user) {
        return redirect('/login')->with('error', 'Token tidak valid atau sudah digunakan.');
    }

    $user->email_verified_at = now();
    $user->remember_token = null; // kosongkan token setelah digunakan
    $user->save();

    return redirect('/login')->with('success', 'Email kamu berhasil diverifikasi!');
}
}
