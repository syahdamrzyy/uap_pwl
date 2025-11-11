<p>Halo {{ $user->name }},</p>

<p>Terima kasih sudah mendaftar di PERKEDEL.</p>

<p>Klik tautan berikut untuk verifikasi akun Anda:</p>

<a href="{{ url('/verify/' . $token) }}">Verifikasi Akun</a>