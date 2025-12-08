@extends('admin.layout')

@section('title', 'Manajemen Peminjaman')

@section('content')

<div class="bg-gray-50 min-h-screen p-6">

    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-200">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-indigo-700 tracking-wide mb-1">Manajemen Peminjaman</h2>
                <p class="text-gray-500 text-sm">Kelola semua peminjaman barang dengan mudah.</p>
            </div>
        </div>

        <div class="mb-4 flex justify-end">
            <input id="searchInput" type="text" placeholder="Cari user, barang, atau tanggal..."
                   class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-full shadow-sm
                          focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
        </div>

        <div class="overflow-x-auto rounded-2xl shadow-md border border-gray-200">
            <table class="w-full text-left" id="peminjamanTable">
                <thead class="bg-indigo-600 text-white uppercase text-sm tracking-wide">
                    <tr>
                        <th class="p-3">User</th>
                        <th class="p-3">Barang</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $p)
                    <tr class="border-b hover:shadow-md transition transform hover:-translate-y-0.5">

                        <td class="p-3 font-medium text-gray-800 search-target">
                            {{ $p->user->name }}
                        </td>

                        <td class="p-3 search-target">
                            {{ $p->barang->nama_barang }}
                        </td>

                        <td class="p-3 search-target">
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            @php
                                $statusColors = [
                                    'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => '⚠️'],
                                    'dipinjam' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => '⏳'],
                                    'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => '❌'],
                                    'dikembalikan' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '✅'],
                                ];
                                $statusKey = strtolower($p->status);
                                $color = $statusColors[$statusKey];
                            @endphp

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $color['bg'] }} {{ $color['text'] }}">
                                {{ $color['icon'] }} <span class="ml-1">{{ $p->status }}</span>
                            </span>
                        </td>

                        <td class="p-3 flex justify-center gap-3">

                            @if(strtolower($p->status) == 'menunggu')

                                {{-- APPROVE --}}
                                <form action="{{ route('admin.peminjaman.approve', $p->id) }}" method="POST">
                                    @csrf
                                    <button class="px-5 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-full shadow-lg hover:from-green-600 hover:to-green-700 transition">
                                        Approve
                                    </button>
                                </form>

                                {{-- REJECT + ALASAN --}}
                                <form id="form-tolak-{{ $p->id }}"
                                      action="{{ route('admin.peminjaman.reject', $p->id) }}"
                                      method="POST">
                                    @csrf
                                    <input type="hidden" name="alasan_ditolak">

                                    <button type="button"
                                        onclick="tolakPeminjaman({{ $p->id }})"
                                        class="px-5 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-full shadow-lg hover:from-red-600 hover:to-red-700 transition">
                                        Reject
                                    </button>
                                </form>

                            @else
                                <span class="text-gray-400 italic">Selesai</span>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
