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
    <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-xl flex items-center gap-4">

        {{-- FOTO BARANG --}}
        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 border">
            @if ($barangDipilih->foto)
                <img src="{{ asset('storage/'.$barangDipilih->foto) }}"
                     class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                    No Image
                </div>
            @endif
        </div>

        <div>
            <p class="font-semibold text-lg text-purple-700">{{ $barangDipilih->nama_barang }}</p>
            <p class="text-gray-600 text-sm">Stok tersedia: {{ $barangDipilih->stok }}</p>
        </div>
    </div>

    {{-- FORM PEMINJAMAN --}}
    <form id="formPinjam" action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        {{-- Pilih Barang --}}
        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Pilih Barang</label>

            <select name="barang_id" id="barangSelect"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500">

                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}"
                        data-foto="{{ $barang->foto }}"
                        data-stok="{{ $barang->stok }}"
                        {{ $barang->id == $barangDipilih->id ? 'selected' : '' }}>

                        {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Preview Barang --}}
        <div id="previewContainer" class="mb-6 hidden">
            <div class="w-full h-40 rounded-lg overflow-hidden bg-gray-100 border mb-2 flex items-center justify-center">
                <img id="previewImage" class="w-full h-full object-cover hidden">
                <span id="noImageText" class="text-gray-400">Tidak ada foto</span>
            </div>

            <p id="stokInfo" class="text-sm text-gray-700"></p>
        </div>

        {{-- Keperluan --}}
        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Keperluan</label>
            <input 
                type="text"
                name="keperluan"
                id="keperluanInput"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500"
                placeholder="Contoh: Untuk presentasi kelas"
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
    const barangSelect = document.getElementById("barangSelect");
    const preview = document.getElementById("previewContainer");
    const previewImg = document.getElementById("previewImage");
    const noImg = document.getElementById("noImageText");
    const stokInfo = document.getElementById("stokInfo");
    const keperluanInput = document.getElementById("keperluanInput");
    const btnOpenModal = document.getElementById("btnOpenModal");

    const modal = document.getElementById("modalConfirm");
    const btnCancel = document.getElementById("btnCancel");

    function updatePreview() {
        const selected = barangSelect.options[barangSelect.selectedIndex];

        const foto = selected.dataset.foto;
        const stok = selected.dataset.stok;

        preview.classList.remove("hidden");

        if (foto) {
            previewImg.src = "/storage/" + foto;
            previewImg.classList.remove("hidden");
            noImg.classList.add("hidden");
        } else {
            previewImg.classList.add("hidden");
            noImg.classList.remove("hidden");
        }

        stokInfo.textContent = "Stok tersedia: " + stok;
        validateForm();
    }

    function validateForm() {
        btnOpenModal.disabled = keperluanInput.value.trim() === "";
    }

    barangSelect.addEventListener("change", updatePreview);
    keperluanInput.addEventListener("input", validateForm);

    // MODAL
    btnOpenModal.addEventListener("click", () => modal.classList.remove("hidden"));
    btnCancel.addEventListener("click", () => modal.classList.add("hidden"));

    updatePreview(); // initial load
});
</script>

@endsection
