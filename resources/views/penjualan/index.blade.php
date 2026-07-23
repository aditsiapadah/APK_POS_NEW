@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Judul + Tombol Tambah --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540]">
            Data Penjualan
        </h1>

        <a href="{{ route('penjualan.create') }}"
            class="bg-[#0A2540] hover:bg-[#12395f]
            text-white px-6 py-3 rounded-xl
            shadow-lg transition
            font-semibold flex items-center">
            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Penjualan
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-5 bg-green-100 border border-green-300
            text-green-700 px-5 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error / Warning --}}
    @if(session('errors') || session('error'))
        <div class="mb-5 bg-red-100 border border-red-300
            text-red-700 px-5 py-3 rounded-xl">
            {{ session('errors') ?? session('error') }}
        </div>
    @endif

    {{-- Search Bar --}}
    <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('penjualan.index') }}">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass
                    absolute left-4 top-4 text-gray-400"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari transaksi / kasir..."
                    class="w-full border border-gray-300
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>
        </form>
    </div>

    {{-- Table Container --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">Tanggal Transaksi</th>
                    <th class="px-8 py-5">Kasir</th>
                    <th class="px-8 py-5">Total Pembayaran</th>
                    <th class="px-8 py-5">Metode</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($penjualan as $index => $item)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-8 py-5">
                        {{ $penjualan->firstItem() + $index }}
                    </td>

                    <td class="px-8 py-5">
                        {{ $item->tanggal_transaksi ?? $item->created_at }}
                    </td>

                    <td class="px-8 py-5 font-semibold">
                        {{ $item->user->name ?? $item->user->nama ?? '-' }}
                    </td>

                    <td class="px-8 py-5">
                        Rp {{ number_format($item->total_pembayaran ?? $item->total ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ ($item->metode_pembayaran ?? $item->metode) == 'CASH' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $item->metode_pembayaran ?? $item->metode ?? '-' }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ ($item->status ?? '') == 'COMPLETED' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $item->status ?? 'OPEN' }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">
                            {{-- Detail (Tampil untuk Admin & Kasir) --}}
                            <a href="{{ route('penjualan.show', $item->id) }}"
                                class="w-10 h-10 rounded-lg bg-blue-500 hover:bg-blue-600
                                flex items-center justify-center text-white transition" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            {{-- Tombol Edit & Hapus (Hanya Tampil untuk Admin) --}}
                            @if(auth()->user()->role->name == 'Admin')
                                {{-- Edit --}}
                                <a href="{{ route('penjualan.edit', $item->id) }}"
                                    class="w-10 h-10 rounded-lg bg-yellow-400 hover:bg-yellow-500
                                    flex items-center justify-center text-white transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Hapus data penjualan ini?')"
                                        class="w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600
                                        flex items-center justify-center text-white transition" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-500">
                        Tidak ada data penjualan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $penjualan->links() }}
    </div>

</div>

@endsection