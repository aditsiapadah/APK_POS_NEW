@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-page-header
        title="Laporan Penjualan"
        subtitle="Ringkasan hasil penjualan berdasarkan periode."
        label="Sales Report"
        icon="fa-chart-column" />


    {{-- =========================================================
        PILIH PERIODE
    ========================================================== --}}
    <div class="bg-white dark:bg-slate-800
                rounded-3xl shadow-lg
                border border-gray-100 dark:border-slate-700
                p-6">

        <div class="flex flex-wrap gap-3 mb-6">

            {{-- Harian --}}
            <a
                href="{{ route('laporan.index', [
                    'jenis' => 'harian',
                    'tanggal' => now()->format('Y-m-d')
                ]) }}"
                class="px-5 py-3 rounded-xl
                       font-semibold text-sm
                       transition-all duration-200
                       {{ $jenis === 'harian'
                            ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] text-white shadow-lg shadow-blue-900/30'
                            : 'bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-600'
                       }}">
                <i class="fa-solid fa-calendar-day mr-2"></i>
                Harian
            </a>


            {{-- Mingguan --}}
            <a
                href="{{ route('laporan.index', [
                    'jenis' => 'mingguan',
                    'tanggal' => now()->format('Y-m-d')
                ]) }}"
                class="px-5 py-3 rounded-xl
                       font-semibold text-sm
                       transition-all duration-200
                       {{ $jenis === 'mingguan'
                            ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] text-white shadow-lg shadow-blue-900/30'
                            : 'bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-600'
                       }}">
                <i class="fa-solid fa-calendar-week mr-2"></i>
                Mingguan
            </a>


            {{-- Bulanan --}}
            <a
                href="{{ route('laporan.index', [
                    'jenis' => 'bulanan',
                    'bulan' => now()->format('Y-m')
                ]) }}"
                class="px-5 py-3 rounded-xl
                       font-semibold text-sm
                       transition-all duration-200
                       {{ $jenis === 'bulanan'
                            ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] text-white shadow-lg shadow-blue-900/30'
                            : 'bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-600'
                       }}">
                <i class="fa-solid fa-calendar-days mr-2"></i>
                Bulanan
            </a>

        </div>


        {{-- Filter --}}
        <form
            action="{{ route('laporan.index') }}"
            method="GET"
            class="flex flex-col md:flex-row md:items-end gap-4">

            <input
                type="hidden"
                name="jenis"
                value="{{ $jenis }}">


            @if($jenis === 'bulanan')

            <div class="w-full md:w-72">

                <label
                    class="block text-sm font-semibold
                               text-gray-700 dark:text-gray-300 mb-2">
                    Pilih Bulan
                </label>

                <input
                    type="month"
                    name="bulan"
                    value="{{ $bulan }}"
                    class="w-full rounded-xl
                               border border-gray-300
                               dark:border-slate-600
                               bg-white dark:bg-slate-700
                               text-gray-800 dark:text-white
                               px-4 py-3
                               focus:ring-2
                               focus:ring-[#1E3A8A]
                               focus:border-[#1E3A8A]
                               outline-none">

            </div>

            @else

            <div class="w-full md:w-72">

                <label
                    class="block text-sm font-semibold
                               text-gray-700 dark:text-gray-300 mb-2">
                    Pilih Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    class="w-full rounded-xl
                               border border-gray-300
                               dark:border-slate-600
                               bg-white dark:bg-slate-700
                               text-gray-800 dark:text-white
                               px-4 py-3
                               focus:ring-2
                               focus:ring-[#1E3A8A]
                               focus:border-[#1E3A8A]
                               outline-none">

            </div>

            @endif


            <button
                type="submit"
                class="px-6 py-3 rounded-xl
                       bg-[#0A2540]
                       hover:bg-[#12395f]
                       text-white
                       font-semibold
                       transition
                       shadow-lg">
                <i class="fa-solid fa-filter mr-2"></i>
                Tampilkan Laporan
            </button>

        </form>

    </div>


    {{-- =========================================================
    PERIODE AKTIF
========================================================== --}}
<div class="bg-white dark:bg-slate-800
            rounded-3xl
            p-6
            border border-blue-100 dark:border-slate-700
            shadow-lg">

    <div class="flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-5">

        {{-- Informasi Periode --}}
        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl
                        bg-blue-50 dark:bg-blue-900/30
                        flex items-center justify-center">

                @if($jenis === 'harian')

                    <i class="fa-solid fa-calendar-day
                              text-2xl
                              text-[#2563eb]
                              dark:text-blue-400"></i>

                @elseif($jenis === 'mingguan')

                    <i class="fa-solid fa-calendar-week
                              text-2xl
                              text-[#2563eb]
                              dark:text-blue-400"></i>

                @else

                    <i class="fa-solid fa-calendar-days
                              text-2xl
                              text-[#2563eb]
                              dark:text-blue-400"></i>

                @endif

            </div>


            <div>

                <p class="text-sm font-medium
                          text-gray-500
                          dark:text-gray-400">

                    Periode Laporan

                </p>

                <h2 class="text-2xl md:text-3xl
                           font-bold
                           text-[#0A2540]
                           dark:text-white
                           mt-1">

                    {{ $periode }}

                </h2>

            </div>

        </div>


        {{-- Jenis Laporan --}}
        <div class="flex items-center gap-3
                    bg-gray-50 dark:bg-slate-700/60
                    rounded-2xl
                    px-5 py-3
                    border border-gray-100
                    dark:border-slate-600">

            <div class="w-10 h-10 rounded-xl
                        bg-blue-100 dark:bg-blue-900/40
                        flex items-center justify-center">

                <i class="fa-solid fa-chart-column
                          text-blue-600
                          dark:text-blue-400"></i>

            </div>

            <div>

                <p class="text-xs font-medium
                          text-gray-400
                          dark:text-gray-400">

                    Jenis Laporan

                </p>

                <p class="font-bold
                          text-[#0A2540]
                          dark:text-white">

                    {{ ucfirst($jenis) }}

                </p>

            </div>

        </div>

    </div>

</div>


    {{-- =========================================================
        STATISTIK UTAMA
    ========================================================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Total Transaksi --}}
        <div class="bg-white dark:bg-slate-800
                    rounded-3xl
                    shadow-lg
                    border border-gray-100
                    dark:border-slate-700
                    p-6">

            <div class="flex items-center
                        justify-between">

                <div>

                    <p class="text-sm font-medium
                              text-gray-500 dark:text-gray-400">
                        Total Transaksi
                    </p>

                    <h3 class="text-3xl font-bold
                               text-[#0A2540]
                               dark:text-white mt-2">
                        {{ number_format(
                            $totalTransaksi,
                            0,
                            ',',
                            '.'
                        ) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl
                            bg-blue-100 dark:bg-blue-900/40
                            flex items-center justify-center">

                    <i class="fa-solid fa-receipt
                              text-blue-600
                              dark:text-blue-400"></i>

                </div>

            </div>

        </div>


        {{-- Pendapatan --}}
        <div class="bg-white dark:bg-slate-800
                    rounded-3xl
                    shadow-lg
                    border border-gray-100
                    dark:border-slate-700
                    p-6">

            <div class="flex items-center
                        justify-between">

                <div>

                    <p class="text-sm font-medium
                              text-gray-500 dark:text-gray-400">
                        Total Pendapatan
                    </p>

                    <h3 class="text-2xl md:text-3xl
                               font-bold
                               text-[#0A2540]
                               dark:text-white mt-2">

                        Rp {{ number_format(
                            $totalPendapatan,
                            0,
                            ',',
                            '.'
                        ) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl
                            bg-green-100 dark:bg-green-900/40
                            flex items-center justify-center">

                    <i class="fa-solid fa-money-bill-wave
                              text-green-600
                              dark:text-green-400"></i>

                </div>

            </div>

        </div>


        {{-- Produk Terjual --}}
        <div class="bg-white dark:bg-slate-800
                    rounded-3xl
                    shadow-lg
                    border border-gray-100
                    dark:border-slate-700
                    p-6">

            <div class="flex items-center
                        justify-between">

                <div>

                    <p class="text-sm font-medium
                              text-gray-500 dark:text-gray-400">
                        Produk Terjual
                    </p>

                    <h3 class="text-3xl font-bold
                               text-[#0A2540]
                               dark:text-white mt-2">

                        {{ number_format(
                            $totalProdukTerjual,
                            0,
                            ',',
                            '.'
                        ) }}

                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl
                            bg-purple-100 dark:bg-purple-900/40
                            flex items-center justify-center">

                    <i class="fa-solid fa-box-open
                              text-purple-600
                              dark:text-purple-400"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        METODE PEMBAYARAN
    ========================================================== --}}
    <div class="bg-white dark:bg-slate-800
                rounded-3xl shadow-lg
                border border-gray-100
                dark:border-slate-700
                p-6">

        <div class="mb-6">

            <h2 class="text-xl font-bold
                       text-[#0A2540]
                       dark:text-white">

                Metode Pembayaran

            </h2>

            <p class="text-sm text-gray-500
                      dark:text-gray-400 mt-1">

                Ringkasan transaksi berdasarkan metode pembayaran.

            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- CASH --}}
            <div class="rounded-2xl
                        border border-green-100
                        dark:border-green-900
                        bg-green-50
                        dark:bg-green-900/20
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                                bg-green-100
                                dark:bg-green-900/40
                                flex items-center justify-center">

                        <i class="fa-solid fa-money-bill
                                  text-green-600
                                  dark:text-green-400"></i>

                    </div>

                    <div>

                        <p class="font-semibold
                                  text-gray-800
                                  dark:text-white">

                            Cash

                        </p>

                        <p class="text-xs text-gray-500
                                  dark:text-gray-400">

                            {{ $jumlahCash }} transaksi

                        </p>

                    </div>

                </div>

                <p class="text-xl font-bold
                          text-green-700
                          dark:text-green-400 mt-4">

                    Rp {{ number_format(
                        $totalCash,
                        0,
                        ',',
                        '.'
                    ) }}

                </p>

            </div>


            {{-- TRANSFER --}}
            <div class="rounded-2xl
                        border border-yellow-100
                        dark:border-yellow-900
                        bg-yellow-50
                        dark:bg-yellow-900/20
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                                bg-yellow-100
                                dark:bg-yellow-900/40
                                flex items-center justify-center">

                        <i class="fa-solid fa-building-columns
                                  text-yellow-600
                                  dark:text-yellow-400"></i>

                    </div>

                    <div>

                        <p class="font-semibold
                                  text-gray-800
                                  dark:text-white">

                            Transfer

                        </p>

                        <p class="text-xs text-gray-500
                                  dark:text-gray-400">

                            {{ $jumlahTransfer }} transaksi

                        </p>

                    </div>

                </div>

                <p class="text-xl font-bold
                          text-yellow-700
                          dark:text-yellow-400 mt-4">

                    Rp {{ number_format(
                        $totalTransfer,
                        0,
                        ',',
                        '.'
                    ) }}

                </p>

            </div>


            {{-- QRIS --}}
            <div class="rounded-2xl
                        border border-blue-100
                        dark:border-blue-900
                        bg-blue-50
                        dark:bg-blue-900/20
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                                bg-blue-100
                                dark:bg-blue-900/40
                                flex items-center justify-center">

                        <i class="fa-solid fa-qrcode
                                  text-blue-600
                                  dark:text-blue-400"></i>

                    </div>

                    <div>

                        <p class="font-semibold
                                  text-gray-800
                                  dark:text-white">

                            QRIS

                        </p>

                        <p class="text-xs text-gray-500
                                  dark:text-gray-400">

                            {{ $jumlahQris }} transaksi

                        </p>

                    </div>

                </div>

                <p class="text-xl font-bold
                          text-blue-700
                          dark:text-blue-400 mt-4">

                    Rp {{ number_format(
                        $totalQris,
                        0,
                        ',',
                        '.'
                    ) }}

                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PRODUK TERLARIS
    ========================================================== --}}
    <div class="bg-white dark:bg-slate-800
                rounded-3xl shadow-lg
                border border-gray-100
                dark:border-slate-700
                overflow-hidden">

        <div class="px-6 py-5
                    border-b border-gray-100
                    dark:border-slate-700">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-orange-100
                            dark:bg-orange-900/30
                            flex items-center justify-center">

                    <i class="fa-solid fa-ranking-star
                              text-orange-600
                              dark:text-orange-400"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold
                               text-[#0A2540]
                               dark:text-white">

                        Produk Terlaris

                    </h2>

                    <p class="text-sm text-gray-500
                              dark:text-gray-400">

                        5 produk dengan penjualan tertinggi.

                    </p>

                </div>

            </div>

        </div>


        @if($produkTerlaris->count() > 0)

        <div class="divide-y
                        divide-gray-100
                        dark:divide-slate-700">

            @foreach($produkTerlaris as $index => $produk)

            <div class="px-6 py-4
                                flex items-center
                                justify-between
                                gap-4">

                <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-xl
                                        bg-gray-100
                                        dark:bg-slate-700
                                        flex items-center
                                        justify-center
                                        font-bold
                                        text-gray-600
                                        dark:text-gray-300">

                        {{ $index + 1 }}

                    </div>

                    <div>

                        <p class="font-semibold
                                          text-gray-800
                                          dark:text-white">

                            {{ $produk['nama'] }}

                        </p>

                        <p class="text-xs
                                          text-gray-500
                                          dark:text-gray-400">

                            Produk terjual

                        </p>

                    </div>

                </div>


                <div class="text-right">

                    <p class="font-bold
                                      text-[#0A2540]
                                      dark:text-white">

                        {{ number_format(
                                    $produk['jumlah'],
                                    0,
                                    ',',
                                    '.'
                                ) }}

                    </p>

                    <p class="text-xs
                                      text-gray-500
                                      dark:text-gray-400">

                        pcs

                    </p>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="px-6 py-12 text-center">

            <div class="w-14 h-14 rounded-full
                            bg-gray-100
                            dark:bg-slate-700
                            flex items-center
                            justify-center
                            mx-auto mb-4">

                <i class="fa-solid fa-box-open
                              text-gray-400 text-xl"></i>

            </div>

            <p class="font-semibold
                          text-gray-600
                          dark:text-gray-300">

                Belum ada data penjualan

            </p>

            <p class="text-sm
                          text-gray-400 mt-1">

                Belum ada produk yang terjual
                pada periode ini.

            </p>

        </div>

        @endif

    </div>


    {{-- =========================================================
        CATATAN
    ========================================================== --}}
    <div class="bg-blue-50 dark:bg-blue-950/30
                border border-blue-100
                dark:border-blue-900
                rounded-2xl p-5">

        <div class="flex gap-3">

            <i class="fa-solid fa-circle-info
                      text-blue-600
                      dark:text-blue-400 mt-1"></i>

            <div>

                <p class="font-semibold
                          text-blue-800
                          dark:text-blue-300">

                    Informasi Laporan

                </p>

                <p class="text-sm
                          text-blue-700
                          dark:text-blue-400 mt-1">

                    Laporan hanya menghitung transaksi
                    dengan status <strong>COMPLETED</strong>.
                    Transaksi yang masih OPEN tidak
                    dimasukkan ke dalam laporan.

                </p>

            </div>

        </div>

    </div>

</div>

@endsection