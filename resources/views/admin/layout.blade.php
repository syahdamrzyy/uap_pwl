<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- ✅ SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <aside class="w-64 bg-white shadow-md flex flex-col justify-between">
        <div>
            <div class="p-6 font-bold text-xl text-indigo-600">PERKEDEL</div>

            <nav class="mt-4 flex flex-col gap-1">

                <a href="/admin"
                   class="block py-3 px-6 rounded-r-full font-medium
                   {{ Request::is('admin') || Request::is('admin/dashboard') 
                        ? 'bg-blue-600 text-white' 
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.barang.index') }}"
                   class="block py-3 px-6 rounded-r-full font-medium
                   {{ Request::is('admin/barang*') 
                        ? 'bg-blue-600 text-white' 
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Manajemen Inventaris
                </a>

                <a href="{{ route('admin.peminjaman.index') }}"
                   class="block py-3 px-6 rounded-r-full font-medium
                   {{ (Request::is('admin/peminjaman') || Request::is('admin/peminjaman/*')) && !Request::is('admin/peminjaman/dikembalikan') 
                        ? 'bg-blue-600 text-white' 
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Permintaan Peminjaman
                </a>

                <a href="{{ route('admin.peminjaman.dikembalikan') }}"
                   class="block py-3 px-6 rounded-r-full font-medium
                   {{ Request::is('admin/peminjaman/dikembalikan') 
                        ? 'bg-blue-600 text-white' 
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Barang Dikembalikan
                </a>

            </nav>
        </div>

        <div class="p-6">
            <div class="text-sm text-gray-600 mb-2">
                {{ Auth::user()->name }}<br>
                <span class="text-xs text-gray-400">Administrator</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="block w-full bg-red-600 text-white py-2 px-4 rounded text-center
                               hover:bg-red-700 transition">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

{{-- ✅ POPUP GLOBAL ADMIN --}}
@if(session('approve_sukses'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Disetujui ✅',
    text: "{{ session('approve_sukses') }}",
    confirmButtonColor: '#16a34a'
});
</script>
@endif

@if(session('reject_gagal'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Ditolak ❌',
    text: "{{ session('reject_gagal') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif

{{-- ✅ FUNGSI TOLAK + ALASAN --}}
<script>
function tolakPeminjaman(id) {
    Swal.fire({
        title: 'Tolak Peminjaman',
        input: 'textarea',
        inputLabel: 'Alasan Penolakan',
        inputPlaceholder: 'Masukkan alasan penolakan...',
        showCancelButton: true,
        confirmButtonText: 'Tolak',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#dc2626',
        inputValidator: (value) => {
            if (!value) return 'Alasan penolakan wajib diisi!'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('form-tolak-' + id);
            form.querySelector('input[name="alasan_ditolak"]').value = result.value;
            form.submit();
        }
    });
}
</script>

</body>
</html>
