@extends('layouts.app')

@section('title', 'Data Jenis Produk')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Data Jenis Produk
        </h1>
        <a href="{{ route('jenis-produk.create') }}"
            class="bg-[#0A2540] hover:bg-[#12395f]
            text-white px-6 py-3 rounded-xl
            shadow-lg transition
            font-semibold">
            <i class="fa-solid fa-tags mr-2"></i>
            Tambah Jenis Produk
        </a>
    </div>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('jenis-produk.index') }}">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass 
                absolute left-4 top-4 
                text-gray-400 dark:text-gray-500"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari jenis produk..."
                    class="
                    w-full 
                    border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400
                    rounded-xl
                    py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none"
                >
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr class="text-left text-gray-500 dark:text-gray-200">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">Nama Jenis</th>
                    <th class="px-8 py-5">Deskripsi</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisProduks as $index => $item)
                <tr class="
                border-t border-gray-200
                dark:border-slate-700
                hover:bg-gray-50
                dark:hover:bg-slate-700
                transition">

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $jenisProduks->firstItem() + $index }}
                    </td>

                    <td class="
                    px-8 py-5
                    font-semibold
                    text-gray-900
                    dark:text-white">
                        {{ $item->nama }}
                    </td>

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ Str::limit($item->deskripsi, 50) ?? '-' }}
                    </td>

                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('jenis-produk.edit', $item->id) }}"
                                class="
                                w-10 h-10 rounded-lg
                                bg-yellow-400 hover:bg-yellow-500
                                flex items-center justify-center
                                text-white transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jenis-produk.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="
                                    w-10 h-10 rounded-lg
                                    bg-red-500 hover:bg-red-600
                                    text-white transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4"
                        class="
                        text-center py-10
                        text-gray-500
                        dark:text-gray-300">
                        Tidak ada data jenis produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $jenisProduks->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    confirmButtonColor: '#0A2540'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Tidak dapat dihapus',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33'
});
</script>
@endif

<script>
document.querySelectorAll('.delete-form').forEach(function(form){
    form.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Hapus Jenis Produk?',
            text: 'Apakah Anda yakin ingin menghapus jenis produk ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });
    });
});
</script>

@endsection
