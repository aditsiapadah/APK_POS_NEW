@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Judul + Tombol --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540]">
            Data Produk
        </h1>
        <a href="{{ route('produk.create') }}"
            class="bg-[#0A2540] hover:bg-[#12395f]
            text-white px-6 py-3 rounded-xl
            shadow-lg transition
            font-semibold">
            <i class="fa-solid fa-box mr-2"></i>
            Tambah Produk
        </a>
    </div>
    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-5 bg-green-100 border border-green-300
            text-green-700 px-5 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Search --}}
    <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('produk.index') }}">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass
                    absolute left-4 top-4 text-gray-400"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk..."
                    class="w-full border border-gray-300
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">
                        Foto
                    </th>
                    <th class="px-8 py-5">
                        Nama Produk
                    </th>
                    <th class="px-8 py-5">
                        Harga Beli
                    </th>
                    <th class="px-8 py-5">
                        Harga Jual
                    </th>
                    <th class="px-8 py-5">
                        Stok
                    </th>
                    <th class="px-8 py-5 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $index => $item)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-8 py-5">
                        {{ $produk->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-5">
                        @if($item->foto)
                        <img src="{{ asset('images/produk/'.$item->foto) }}"
                            class="w-14 h-14 rounded-lg object-cover">
                        @else
                        <span class="text-gray-400">
                            Tidak ada
                        </span>
                        @endif
                    </td>
                    <td class="px-8 py-5 font-semibold">
                        {{ $item->nama }}
                    </td>
                    <td class="px-8 py-5">
                        Rp {{ number_format($item->harga_beli) }}
                    </td>
                    <td class="px-8 py-5">
                        Rp {{ number_format($item->harga_jual) }}
                    </td>
                    <td class="px-8 py-5">
                        {{ $item->stok }}
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('produk.show',$item->id) }}"
                                    class="w-10 h-10 rounded-lg
                                    bg-blue-500 hover:bg-blue-600
                                    flex items-center justify-center
                                    text-white">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('produk.edit',$item->id) }}"
                                    class="w-10 h-10 rounded-lg
                                    bg-yellow-400 hover:bg-yellow-500
                                    flex items-center justify-center
                                    text-white">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('produk.destroy',$item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Hapus produk ini?')"
                                        class="w-10 h-10 rounded-lg
                                        bg-red-500 hover:bg-red-600
                                        text-white">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7"
                        class="text-center py-10 text-gray-500">
                        Tidak ada data produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $produk->links() }}
    </div>
</div>

@endsection