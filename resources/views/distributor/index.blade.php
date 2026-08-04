@extends('layouts.app')

@section('title', 'Data Distributor')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Data Distributor
        </h1>
        <a href="{{ route('distributor.create') }}"
            class="bg-[#0A2540] hover:bg-[#12395f]
            text-white px-6 py-3 rounded-xl
            shadow-lg transition
            font-semibold">
            <i class="fa-solid fa-truck mr-2"></i>
            Tambah Distributor
        </a>
    </div>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('distributor.index') }}">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass 
                absolute left-4 top-4 
                text-gray-400 dark:text-gray-500"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama distributor..."
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
                    <th class="px-8 py-5">Nama Distributor </th>
                    <th class="px-8 py-5">Perusahaan</th>
                    <th class="px-8 py-5">Telepon</th>
                    <th class="px-8 py-5">Email</th>
                    <th class="px-8 py-5">Alamat</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distributors as $index => $item)
                <tr class="
                border-t border-gray-200
                dark:border-slate-700
                hover:bg-gray-50
                dark:hover:bg-slate-700
                transition">
                
                    {{-- Nomor --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $distributors->firstItem() + $index }}
                    </td>

                    {{-- Nama Distributor --}}
                    <td class="
                    px-8 py-5
                    font-semibold
                    text-gray-900
                    dark:text-white">
                        {{ $item->nama_distributor }}
                    </td>

                    {{-- Perusahaan --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $item->nama_perusahaan ?? '-' }}
                    </td>

                    {{-- Telepon --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $item->telepon ?? '-' }}
                    </td>

                    {{-- Email --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $item->email ?? '-' }}
                    </td>

                    {{-- Alamat --}}
                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ Str::limit($item->alamat, 30) ?? '-' }}
                    </td>
                    
                    {{-- Aksi --}}
                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('distributor.edit', $item->id) }}"
                                class="
                                w-10 h-10 rounded-lg
                                bg-yellow-400 hover:bg-yellow-500
                                flex items-center justify-center
                                text-white transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('distributor.destroy', $item->id) }}"
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
                    <td colspan="7"
                        class="
                        text-center py-10
                        text-gray-500
                        dark:text-gray-300">
                        Tidak ada data distributor
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $distributors->links() }}
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
            title: 'Hapus Distributor?',
            text: 'Apakah Anda yakin ingin menghapus distributor ini?',
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