<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    /* =========================
     *  REGISTER
     * ========================= */
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $token = Str::random(64);

            $user = User::create([
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
                'remember_token' => $token,
            ]);

            // Kirim email verifikasi
            Mail::send('auth.verify', compact('user', 'token'), function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verifikasi Email - PERKEDEL')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info("User registered: {$user->email}, email verifikasi terkirim.");

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi akun.');

        } catch (Exception $e) {
            // Catat error di log Laravel
            Log::error('Gagal mengirim email verifikasi: ' . $e->getMessage());

            return redirect('/login')->with('error', 'Pendaftaran berhasil, tapi gagal mengirim email verifikasi.');
        }
    }

    /* =========================
     *  LOGIN
     * ========================= */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->with('error', 'Email atau password salah.');
    }

    $user = Auth::user();

    if (is_null($user->email_verified_at)) {
        Auth::logout();
        return redirect('/login')->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
    }

    // ✅ Arahkan sesuai role
    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin')->with('success', 'Selamat datang, Admin!');
    }

    return redirect()->route('dashboard.user')->with('success', 'Berhasil login!');
}

    /* =========================
     *  LOGOUT
     * ========================= */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    /* =========================
     *  VERIFIKASI EMAIL
     * ========================= */
    public function verifyUser($token)
    {
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Token tidak valid atau sudah digunakan.');
        }

        $user->update([
            'email_verified_at' => now(),
            'remember_token'    => null,
        ]);

        Log::info("User verified: {$user->email}");

        return redirect('/login')->with('success', 'Email kamu berhasil diverifikasi! Silakan login.');
    }
}
