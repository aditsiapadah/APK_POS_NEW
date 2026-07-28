@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
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

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('produk.index') }}">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-400 dark:text-gray-500"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk..."
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr class="text-left text-gray-500 dark:text-gray-200">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">Foto</th>
                    <th class="px-8 py-5">Nama Produk</th>
                    <th class="px-8 py-5">Jenis Produk</th>
                    <th class="px-8 py-5">Harga Beli</th>
                    <th class="px-8 py-5">Harga Jual</th>
                    <th class="px-8 py-5">Stok</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($produk as $index => $item)

                <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                    {{-- Nomor --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $produk->firstItem() + $index }}
                    </td>

                    {{-- Foto --}}
                    <td class="px-8 py-5">
                        @if($item->foto)
<<<<<<< HEAD
<<<<<<< HEAD
                        <img 
=======
                        <img
>>>>>>> 49def9d (update projek)
                            src="{{ asset('storage/'.$item->foto) }}"
                            class="w-14 h-14 rounded-lg object-cover border dark:border-slate-600">
=======
                            <img
                                src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                class="w-14 h-14 rounded-lg object-cover border dark:border-slate-600">
>>>>>>> e5fa7ac (Update fitur baru)
                        @else
                            <span class="text-gray-400 dark:text-gray-500">
                                Tidak ada
                            </span>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td class="px-8 py-5 font-semibold text-gray-900 dark:text-white">
                        {{ $item->nama }}
                    </td>

                    {{-- Jenis Produk --}}
                    <td class="px-8 py-5">

                        <span class="
                            px-3 py-1 rounded-full text-xs font-semibold

                            @if($item->jenis_produk == 'Makanan')
                                bg-orange-100 text-orange-700

                            @elseif($item->jenis_produk == 'Minuman')
                                bg-blue-100 text-blue-700

                            @elseif($item->jenis_produk == 'Elektronik')
                                bg-purple-100 text-purple-700

                            @else
                                bg-gray-100 text-gray-700
                            @endif">

                            {{ $item->jenis_produk }}

                        </span>

                    </td>

                    {{-- Harga Beli --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        Rp {{ number_format($item->harga_beli) }}
                    </td>

                    {{-- Harga Jual --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        Rp {{ number_format($item->harga_jual) }}
                    </td>

                    {{-- Stok --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $item->stok }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-8 py-5">

                        <div class="flex justify-center gap-2">

                            {{-- Detail --}}
                            <a href="{{ route('produk.show', $item->id) }}"
                                class="w-10 h-10 rounded-lg bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white transition">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('produk.edit', $item->id) }}"
                                class="w-10 h-10 rounded-lg bg-yellow-400 hover:bg-yellow-500 flex items-center justify-center text-white transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            {{-- Delete --}}
<<<<<<< HEAD
                            <form action="{{ route('produk.destroy',$item->id) }}"
<<<<<<< HEAD
                                method="POST">
=======
                            <form action="{{ route('produk.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form">

>>>>>>> e5fa7ac (Update fitur baru)
                                @csrf
                                @method('DELETE')

                                <button
<<<<<<< HEAD
                                    onclick="return confirm('Hapus produk ini?')"
                                    class="w-10 h-10 rounded-lg
                                    bg-red-500 hover:bg-red-600
                                    text-white transition">
=======
                                method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-10 h-10 rounded-lg
                                bg-red-500 hover:bg-red-600
                                text-white transition">
>>>>>>> 49def9d (update projek)
=======
                                    type="submit"
                                    class="w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">

>>>>>>> e5fa7ac (Update fitur baru)
                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center py-10 text-gray-500 dark:text-gray-300">

                        Tidak ada data produk

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $produk->links() }}
    </div>

</div>

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> e5fa7ac (Update fitur baru)
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
<<<<<<< HEAD
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        confirmButtonColor: '#0A2540'
    });
=======
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    confirmButtonColor: '#0A2540'
});
>>>>>>> e5fa7ac (Update fitur baru)
</script>
@endif

@if(session('error'))
<script>
<<<<<<< HEAD
    Swal.fire({
        icon: 'error',
        title: 'Tidak dapat dihapus',
        text: "{{ session('error') }}",
        confirmButtonColor: '#d33'
    });
=======
Swal.fire({
    icon: 'error',
    title: 'Tidak dapat dihapus',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33'
});
>>>>>>> e5fa7ac (Update fitur baru)
</script>
@endif

<script>
<<<<<<< HEAD
    document.querySelectorAll('.delete-form').forEach(function(form) {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Apakah Anda yakin ingin menghapus produk ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
=======
document.querySelectorAll('.delete-form').forEach(function(form) {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Hapus Produk?',
            text: 'Apakah Anda yakin ingin menghapus produk ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }
>>>>>>> e5fa7ac (Update fitur baru)

        });

    });
<<<<<<< HEAD
</script>
>>>>>>> 49def9d (update projek)
=======

});
</script>

>>>>>>> e5fa7ac (Update fitur baru)
@endsection