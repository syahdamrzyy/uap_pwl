@extends('layouts.loginregister')

@section('title', 'Login')

@section('content')
    <!-- Left Section -->
    <div class="text-white font-extrabold spaced-text text-5xl md:text-6xl md:w-1/2 text-center md:text-left mb-10 md:mb-0 leading-snug">
        <p>LOGIN</p>
        <p>ACCOUNT</p>
    </div>

    <!-- Right Section (Form) -->
    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-1">Selamat Datang Kembali</h2>
        <p class="text-gray-400 mb-6 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
        
        <!-- ✅ Flash Message -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md relative animate-fade-in-down">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md relative animate-fade-in-down">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md relative animate-fade-in-down">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- ✅ End Flash Message -->

        <!-- Tabs -->
        <div class="flex border-b mb-6 text-base">
            <span class="w-1/2 text-center py-2 font-medium text-indigo-600 border-b-2 border-indigo-500">Masuk</span>
            <a href="{{ route('register') }}" class="w-1/2 text-center py-2 font-medium text-gray-500 hover:text-indigo-500 transition">Daftar</a>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-5 py-3 rounded-md bg-gray-100 border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-5 py-3 rounded-md bg-gray-100 border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>
            <button type="submit"
                class="w-full py-3 rounded-md bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium hover:opacity-90 transition text-lg">
                Masuk
            </button>
        </form>
    </div>

    <!-- Animasi kecil -->
    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.3s ease-out;
        }
    </style>

    <script>
        // Auto hide flash message setelah 4 detik
        setTimeout(() => {
            document.querySelectorAll('.animate-fade-in-down').forEach(el => el.remove());
        }, 4000);
    </script>
@endsection
