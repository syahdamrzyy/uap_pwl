@extends('admin.layout')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-indigo-700 tracking-wide">
            Manajemen Inventaris
        </h2>

        <a href="{{ route('admin.barang.create') }}" 
           class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl shadow 
                  hover:bg-indigo-700 transition-all duration-200">
           + Tambah Inventaris
        </a>
    </div>

    {{-- Pencarian --}}
    <div class="mb-4">
        <input id="searchInput" type="text" placeholder="Cari barang..."
               class="w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 shadow">
        <table class="w-full text-left" id="barangTable">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="p-3">Nama Inventaris</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($barang as $b)
                <tr class="border-t hover:bg-gray-50 transition">

                    {{-- NAMA INVENTARIS --}}
                    <td class="p-3 font-semibold text-gray-800 search-target">
                        {{ $b->nama_barang }}
                    </td>

                    {{-- DESKRIPSI (Modal) --}}
                    <td class="p-3 search-target">
                        <button 
                            onclick="openModal('modal-{{ $b->id }}')" 
                            class="px-4 py-1.5 bg-indigo-500 text-white rounded-lg shadow 
                                   hover:bg-indigo-600 transition">
                            Lihat
                        </button>

                        {{-- Modal --}}
                        <div id="modal-{{ $b->id }}" 
                             class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

                            <div class="bg-white w-96 p-5 rounded-xl shadow-xl relative">

                                {{-- Close --}}
                                <button onclick="closeModal('modal-{{ $b->id }}')" 
                                        class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">
                                    ×
                                </button>

                                {{-- Foto --}}
                                <div class="w-full h-52 bg-gray-100 rounded-lg mb-3 overflow-hidden flex items-center justify-center">
                                    @if($b->foto)
                                        <img src="{{ asset('storage/'.$b->foto) }}" 
                                             class="w-full h-full object-contain p-2">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada foto</span>
                                    @endif
                                </div>

                                {{-- Nama --}}
                                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $b->nama_barang }}</h3>

                                {{-- Deskripsi --}}
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ $b->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </p>

                                {{-- Stok --}}
                                <p class="text-sm font-semibold text-indigo-700">
                                    Stok: {{ $b->stok }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- STOK --}}
                    <td class="p-3 font-semibold text-gray-700 search-target">
                        {{ $b->stok }}
                    </td>

                    {{-- AKSI --}}
                    <td class="p-3 flex justify-center gap-3">

                        {{-- Edit --}}
                        <a href="{{ route('admin.barang.edit', $b->id) }}"
                            class="px-4 py-1.5 bg-yellow-400 text-white rounded-lg shadow 
                                   hover:bg-yellow-500 transition">
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')"
                                class="px-4 py-1.5 bg-red-500 text-white rounded-lg shadow 
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

{{-- Script Modal --}}
<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>

{{-- Live Search Script --}}
<script>
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
