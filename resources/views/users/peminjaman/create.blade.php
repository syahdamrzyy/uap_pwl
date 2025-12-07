@extends('layouts.user')

@section('title', 'Form Peminjaman | PERKEDEL')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Peminjaman Barang</h2>

    {{-- Error Handling --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Informasi Barang --}}
    <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-xl flex items-center gap-6">

        {{-- FOTO BARANG (BESAR & PANJANG) --}}
        <div class="w-56 h-36 rounded-lg overflow-hidden bg-gray-100 border shadow">
            @if ($barangDipilih->foto)
                <img src="{{ asset('storage/'.$barangDipilih->foto) }}"
                     class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                    No Image
                </div>
            @endif
        </div>

        <div class="flex-1">
            <p class="font-semibold text-xl text-purple-700">{{ $barangDipilih->nama_barang }}</p>
            <p class="text-gray-600 text-sm mb-2">Stok tersedia: {{ $barangDipilih->stok }}</p>

            {{-- DESKRIPSI --}}
            @if ($barangDipilih->deskripsi)
                <p class="text-gray-700 text-sm leading-snug">
                    {{ $barangDipilih->deskripsi }}
                </p>
            @else
                <p class="text-gray-400 text-sm italic">Tidak ada deskripsi.</p>
            @endif
        </div>
    </div>

    {{-- FORM PEMINJAMAN --}}
    <form id="formPinjam" action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        {{-- Hidden barang_id (auto terpilih dari dashboard) --}}
        <input type="hidden" name="barang_id" value="{{ $barangDipilih->id }}">

        {{-- Keperluan --}}
        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Keperluan</label>
            <input 
                type="text"
                name="keperluan"
                id="keperluanInput"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500"
                placeholder="Contoh: Untuk presentasi kelas"
                required
            >
        </div>

        {{-- Tanggal Mulai --}}
        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
            <input 
                type="date" 
                name="tanggal_mulai" 
                id="tanggalMulai"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500"
                required
            >
        </div>

        {{-- Tanggal Selesai --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
            <input 
                type="date" 
                name="tanggal_selesai" 
                id="tanggalSelesai"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500"
                required
            >
        </div>

        {{-- Tombol Ajukan --}}
        <button type="button" id="btnOpenModal"
            class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow w-full disabled:opacity-50"
            disabled>
            Ajukan Peminjaman
        </button>

        {{-- Modal Konfirmasi --}}
        <div id="modalConfirm" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center">
            <div class="bg-white p-6 rounded-xl shadow-xl w-80">
                <h3 class="text-lg font-semibold mb-2">Konfirmasi</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Apakah Anda yakin ingin mengajukan peminjaman barang ini?
                </p>

                <div class="flex justify-end gap-3">
                    <button type="button" id="btnCancel"
                        class="px-4 py-1 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-1 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Ya, Ajukan
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const keperluanInput = document.getElementById("keperluanInput");
    const tanggalMulai = document.getElementById("tanggalMulai");
    const tanggalSelesai = document.getElementById("tanggalSelesai");
    const btnOpenModal = document.getElementById("btnOpenModal");

    const modal = document.getElementById("modalConfirm");
    const btnCancel = document.getElementById("btnCancel");

    function validateForm() {
        const valid =
            keperluanInput.value.trim() !== "" &&
            tanggalMulai.value !== "" &&
            tanggalSelesai.value !== "" &&
            tanggalSelesai.value >= tanggalMulai.value;

        btnOpenModal.disabled = !valid;
    }

    keperluanInput.addEventListener("input", validateForm);
    tanggalMulai.addEventListener("change", validateForm);
    tanggalSelesai.addEventListener("change", validateForm);

    btnOpenModal.addEventListener("click", () => modal.classList.remove("hidden"));
    btnCancel.addEventListener("click", () => modal.classList.add("hidden"));
});
</script>

@endsection
