@extends('admin.layout')

@section('title', 'Barang Dikembalikan')

@section('content')

<div class="bg-gray-50 min-h-screen p-6">

    {{-- Card --}}
    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-200">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-indigo-700 tracking-wide mb-1">Barang Dikembalikan</h2>
                <p class="text-gray-500 text-sm">Daftar semua barang yang telah dikembalikan.</p>
            </div>
        </div>

        {{-- Pencarian --}}
        <div class="mb-4 flex justify-end">
            <input id="searchInput" type="text" placeholder="Cari user, barang, atau status..."
                   class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-full shadow-sm
                          focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto rounded-2xl shadow-md border border-gray-200">
            <table class="w-full text-left" id="peminjamanTable">
                <thead class="bg-indigo-600 text-white uppercase text-sm tracking-wide">
                    <tr>
                        <th class="p-3">User</th>
                        <th class="p-3">Barang</th>
                        <th class="p-3">Tanggal Kembali</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr class="border-b hover:shadow-md transition transform hover:-translate-y-0.5">

                        {{-- USER --}}
                        <td class="p-3 font-medium text-gray-800 search-target">{{ $p->user->name }}</td>

                        {{-- BARANG --}}
                        <td class="p-3 search-target">{{ $p->barang->nama_barang }}</td>

                        {{-- TANGGAL KEMBALI --}}
                        <td class="p-3 search-target">
                            {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="p-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                ✅ Dikembalikan
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-500">
                            Belum ada barang yang dikembalikan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Live Search Script --}}
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll("#peminjamanTable tbody tr");

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
    });
});
</script>

@endsection
