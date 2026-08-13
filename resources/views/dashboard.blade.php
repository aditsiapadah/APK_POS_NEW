@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<x-page-header
    title="Ringkasan Hari Ini"
    subtitle="{{ $tanggalHariIni->translatedFormat('l, d F Y') }}"
    label="Dashboard Overview"
    icon="fa-chart-line"
/>
<br>
{{-- KARTU STATISTIK --}}
@if(auth()->user()->role->name == 'Admin')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Penjualan -->
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl p-6
        shadow-xl
        card-hover
        border border-slate-100 dark:border-slate-700
        flex items-center justify-between">
        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">
                Total Penjualan Hari Ini
            </p>
            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">
                Rp {{ number_format($ringkasan->total_pendapatan ?? 0,0,',','.') }}
            </p>
        </div>
        <div class="
            w-16 h-16
            bg-blue-100 dark:bg-blue-900/40
            rounded-2xl
            flex items-center justify-center
            text-4xl
            flex-shrink-0 ml-4
        ">
            💰
        </div>
    </div>
    <!-- Jumlah Transaksi -->
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl p-6
        shadow-xl
        card-hover
        border border-slate-100 dark:border-slate-700
        flex items-center justify-between
    ">
        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">
                Jumlah Transaksi
            </p>
            <p class="text-3xl font-bold text-[#0A2540] dark:text-white mt-2">
                {{ $ringkasan->total_transaksi ?? 0 }}
            </p>
        </div>
        <div class="
            w-16 h-16
            bg-emerald-100 dark:bg-emerald-900/40
            rounded-2xl
            flex items-center justify-center
            text-4xl
            flex-shrink-0 ml-4">
            📊
        </div>
    </div>
    <!-- Cash -->
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl p-6
        shadow-xl
        card-hover
        border border-slate-100 dark:border-slate-700
        flex items-center justify-between">
        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">
                Total Pembayaran Tunai
            </p>
            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">
                Rp {{ number_format($ringkasan->total_cash ?? 0,0,',','.') }}
            </p>
        </div>
        <div class="
            w-16 h-16
            bg-amber-100 dark:bg-amber-900/40
            rounded-2xl
            flex items-center justify-center
            text-4xl
            flex-shrink-0 ml-4">
            💵
        </div>
    </div>




    <!-- Non Tunai -->
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl p-6
        shadow-xl
        card-hover
        border border-slate-100 dark:border-slate-700
        flex items-center justify-between
    ">


        <div>

            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">

                Total Pembayaran Non-Tunai

            </p>


            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">

                Rp {{ number_format($ringkasan->total_non_tunai ?? 0,0,',','.') }}

            </p>


        </div>



        <div class="
            w-16 h-16
            bg-purple-100 dark:bg-purple-900/40
            rounded-2xl
            flex items-center justify-center
            text-4xl
            flex-shrink-0 ml-4
        ">

            💳

        </div>


    </div>



</div>


@endif

{{-- Critical Inventory --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">


    {{-- STOK RENDAH --}}
        <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl
        shadow-xl
        p-8
        transition-all
        duration-300
        hover:-translate-y-2
        hover:shadow-2xl
    ">


        <h3 class="
            text-xl font-semibold
            text-[#0A2540] dark:text-white
            mb-6
            flex items-center gap-3
        ">

            <span class="text-orange-500">
                ⚠️
            </span>

            Daftar Produk Stok Rendah

        </h3>



        <div class="
            overflow-x-auto
            border border-slate-100 dark:border-slate-700
            rounded-2xl
        ">


            <table class="w-full min-w-[500px]">


                <thead>

                    <tr class="
                        border-b
                        border-slate-200
                        dark:border-slate-700
                    ">


                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            #
                        </th>


                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Nama Produk
                        </th>


                        <th class="
                            text-center
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Stok
                        </th>


                    </tr>

                </thead>



                <tbody class="
                    text-slate-700
                    dark:text-slate-200

                    divide-y
                    divide-slate-200
                    dark:divide-slate-700
                ">


                    @forelse($produkStokRendah as $index => $produk)


                    <tr>


                        <td class="py-4 px-6">

                            {{ $produkStokRendah->firstItem() + $index }}

                        </td>


                        <td class="py-4 px-6">

                            {{ $produk->nama }}

                        </td>


                        <td class="
                            text-center
                            py-4 px-6
                            font-semibold
                            text-orange-600
                        ">

                            {{ $produk->stok }}

                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="3"
                            class="
                            text-center
                            py-8
                            text-slate-400
                            dark:text-slate-500
                        ">

                            Tidak ada produk stok rendah

                        </td>

                    </tr>


                    @endforelse


                </tbody>


            </table>


        </div>



        @if($produkStokRendah->hasPages())


        <div class="
            flex
            justify-between
            items-center
            mt-6
        ">


            <div class="
                text-sm
                text-slate-500
                dark:text-slate-400
            ">
                Menampilkan
                {{ $produkStokRendah->firstItem() }}
                -
                {{ $produkStokRendah->lastItem() }}
                dari
                {{ $produkStokRendah->total() }}
                produk
            </div>
            <div>
                {{ $produkStokRendah->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
    {{-- STOK HABIS --}}
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl
        shadow-xl
        p-8
        transition-all
        duration-300
        hover:-translate-y-2
        hover:shadow-2xl
    ">
        <h3 class="
            text-xl font-semibold
            text-[#0A2540] dark:text-white
            mb-6
            flex items-center gap-3
        ">
            <span class="text-red-500">
                ⛔
            </span>
            Daftar Produk Habis
        </h3>
        <div class="
            overflow-x-auto
            border border-slate-100 dark:border-slate-700
            rounded-2xl
        ">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="
                        border-b
                        border-slate-200
                        dark:border-slate-700
                    ">
                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            #
                        </th>
                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Nama Produk
                        </th>
                        <th class="
                            text-center
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Stok
                        </th>
                    </tr>
                </thead>
                <tbody class="
                    text-slate-700
                    dark:text-slate-200
                    divide-y
                    divide-slate-200
                    dark:divide-slate-700
                ">
                    @forelse($produkStokHabis as $index => $produk)
                    <tr>
                        <td class="py-4 px-6">
                            {{ $index + 1 }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $produk->nama }}
                        </td>
                        <td class="
                            text-center
                            py-4 px-6
                            font-semibold
                            text-red-600
                        ">
                            {{ $produk->stok }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"
                            class="
                            text-center
                            py-8
                            text-slate-400
                            dark:text-slate-500
                        ">
                            Tidak ada produk habis stok
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
{{-- BEST SELLER --}}
<div class="
    bg-white dark:bg-[#162033]
    rounded-3xl
    shadow-xl
    p-8
    transition-all
    duration-300
    hover:-translate-y-2
    hover:shadow-2xl
">
    <h3 class="
        text-xl
        font-semibold
        text-[#0A2540]
        dark:text-white
        mb-6
        flex
        items-center
        gap-3
    ">
        🏆 Best Seller Products Hari Ini
    </h3>
    <div class="
        overflow-x-auto
        border border-slate-100
        dark:border-slate-700
        rounded-2xl
    ">
        <table class="w-full min-w-[600px]">
            <thead>
                <tr class="
                    border-b
                    border-slate-200
                    dark:border-slate-700
                ">
                    <th class="
                        text-left
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Nama Produk
                    </th>
                    <th class="
                        text-center
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Stok Saat Ini
                    </th>
                    <th class="
                        text-center
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Unit Terjual
                    </th>
                </tr>
            </thead>
            <tbody class="
                text-slate-700
                dark:text-slate-200
                divide-y
                divide-slate-200
                dark:divide-slate-700
            ">
                @forelse($produkTerlaris as $produk)
                <tr>
                    <td class="
                        py-4
                        px-6
                        font-medium
                    ">
                        {{ $produk->nama }}
                    </td>
                    <td class="
                        text-center
                        py-4
                        px-6
                    ">
                        {{ $produk->stok }}
                    </td>
                    <td class="
                        text-center
                        py-4
                        px-6
                        font-semibold
                        text-emerald-600
                    ">
                        {{ $produk->total_terjual ?? 0 }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"
                        class="
                        text-center
                        py-8
                        text-slate-400
                        dark:text-slate-500">
                        Belum ada penjualan hari ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection