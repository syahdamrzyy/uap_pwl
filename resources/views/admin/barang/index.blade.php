@extends('admin.layout')

@section('title', 'Manajemen Inventaris')

@section('content')

<div class="bg-gray-50 min-h-screen p-6">

    {{-- CARD UTAMA --}}
    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-200">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-indigo-700 tracking-wide mb-1">
                    Manajemen Inventaris
                </h2>
                <p class="text-gray-500 text-sm">
                    Kelola semua barang inventaris kampus.
                </p>
            </div>

            <a href="{{ route('admin.barang.create') }}"
               class="mt-3 md:mt-0 px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-full shadow-lg 
                      hover:bg-indigo-700 transition-all duration-200">
                + Tambah Inventaris
            </a>
        </div>

        {{-- SEARCH --}}
        <div class="mb-4 flex justify-end">
            <input id="searchInput" type="text"
                   placeholder="Cari nama, deskripsi, atau stok..."
                   class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-full shadow-sm
                          focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
        </div>

        {{-- TABEL --}}
        <div class="overflow-x-auto rounded-2xl shadow-md border border-gray-200">
            <table class="w-full text-left" id="barangTable">
                <thead class="bg-indigo-600 text-white uppercase text-sm tracking-wide">
                    <tr>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($barang as $b)
                    <tr class="border-b hover:shadow-md transition transform hover:-translate-y-0.5">

                        {{-- NAMA --}}
                        <td class="p-3 font-medium text-gray-800 search-target">
                            {{ $b->nama_barang }}
                        </td>

                        {{-- DESKRIPSI (MODAL) --}}
                        <td class="p-3 search-target">
                            <button onclick="openModal('modal-{{ $b->id }}')"
                                    class="px-4 py-1.5 bg-indigo-500 text-white rounded-full shadow 
                                           hover:bg-indigo-600 transition">
                                Lihat
                            </button>
                        </td>

                        {{-- STOK --}}
                        <td class="p-3 font-semibold text-gray-700 search-target">
                            {{ $b->stok }}
                        </td>

                        {{-- AKSI --}}
                        <td class="p-3 flex justify-center gap-3">

                            {{-- EDIT --}}
                            <a href="{{ route('admin.barang.edit', $b->id) }}"
                               class="px-4 py-1.5 bg-yellow-400 text-white rounded-full shadow 
                                      hover:bg-yellow-500 transition">
                                Edit
                            </a>

                            {{-- HAPUS --}}
                            <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus barang ini?')"
                                        class="px-4 py-1.5 bg-red-500 text-white rounded-full shadow 
                                               hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- =========================
     MODAL DETAIL BARANG
========================= --}}
@foreach($barang as $b)
<div id="modal-{{ $b->id }}"
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white w-96 p-5 rounded-2xl shadow-xl relative">

        {{-- CLOSE --}}
        <button onclick="closeModal('modal-{{ $b->id }}')"
                class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">
            ×
        </button>

        {{-- FOTO --}}
        <div class="w-full h-52 bg-gray-100 rounded-lg mb-3 overflow-hidden flex items-center justify-center">
            @if($b->foto)
                <img src="{{ asset('storage/'.$b->foto) }}"
                     class="w-full h-full object-contain p-2">
            @else
                <span class="text-gray-400 italic">Tidak ada foto</span>
            @endif
        </div>

        {{-- NAMA --}}
        <h3 class="text-lg font-bold text-gray-800 mb-1">
            {{ $b->nama_barang }}
        </h3>

        {{-- DESKRIPSI --}}
        <p class="text-sm text-gray-600 mb-2">
            {{ $b->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>

        {{-- STOK --}}
        <p class="text-sm font-semibold text-indigo-700">
            Stok: {{ $b->stok }}
        </p>

    </div>
</div>
@endforeach

{{-- =========================
     SCRIPT MODAL & SEARCH
========================= --}}
<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

document.getElementById("searchInput").addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll("#barangTable tbody tr");

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
    });
});
</script>

@endsection
