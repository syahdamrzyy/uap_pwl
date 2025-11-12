@extends('layouts.user')

@section('content')
<div class="text-center text-white">
    <h1 class="text-3xl font-bold mb-4">Dashboard Admin</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda masuk sebagai <b>Admin</b>.</p>
</div>
@endsection
