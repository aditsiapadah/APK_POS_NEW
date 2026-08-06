@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="space-y-6">

    {{-- Judul --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Riwayat Transaksi
        </h1>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="mb-5 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700
            text-green-700 dark:text-green-200 px-5 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('errors') || session('error'))
    <div class="mb-5 bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700
            text-red-700 dark:text-red-200 px-5 py-3 rounded-xl">
        {{ session('errors') ?? session('error') }}
    </div>
    @endif

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('riwayat.index') }}" class="flex flex-col md:flex-row gap-4">

            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-400 dark:text-gray-500"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari ID transaksi / kasir..."
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400 dark:placeholder-gray-400
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>

            <div class="relative">
                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    rounded-xl py-3 px-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>

            <button type="submit"
                class="bg-[#0A2540] hover:bg-[#12395f] text-white px-6 py-3 rounded-xl
                font-semibold transition shadow-lg">
                Cari
            </button>

        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr class="text-left text-gray-500 dark:text-gray-200">
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

                @forelse($transaksi as $index => $item)

                <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $transaksi->firstItem() + $index }}
                    </td>

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{
                            $item->created_at
                                ? $item->created_at->format('d-m-Y H:i')
                                : ($item->tanggal_transaksi
                                    ? \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y H:i')
                                    : '-')
                        }}
                    </td>

                    <td class="px-8 py-5 font-semibold text-gray-900 dark:text-white">
                        {{ $item->user->name ?? $item->user->nama ?? '-' }}
                    </td>

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        Rp {{ number_format($item->total_pembayaran ?? $item->total ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{
                            ($item->metode_pembayaran ?? $item->metode) == 'CASH'
                            ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200'
                            : (($item->metode_pembayaran ?? $item->metode) == 'TRANSFER'
                            ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200'
                            : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200')
                            }}">
                            {{ $item->metode_pembayaran ?? $item->metode ?? '-' }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ ($item->status ?? 'COMPLETED') == 'COMPLETED'
                                ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200'
                                : 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200' }}">
                            {{ $item->status ?? 'COMPLETED' }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">

                            {{-- Detail --}}
                            <a href="{{ route('riwayat.show', $item->id) }}"
                                class="w-10 h-10 rounded-lg bg-blue-500 hover:bg-blue-600
                                flex items-center justify-center text-white transition"
                                title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            {{-- Cetak (opsional, hapus jika route belum ada) --}}
                            {{-- 
                            <a href="{{ route('riwayat.cetak', $item->id) }}"
                                target="_blank"
                                class="w-10 h-10 rounded-lg bg-green-500 hover:bg-green-600
                                flex items-center justify-center text-white transition"
                                title="Cetak">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            --}}

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7"
                        class="text-center py-10 text-gray-500 dark:text-gray-300">
                        Tidak ada data transaksi
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $transaksi->links() }}
    </div>

</div>

@endsection