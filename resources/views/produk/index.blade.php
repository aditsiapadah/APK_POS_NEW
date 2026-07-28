@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">
                Data Produk
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">
                Kelola seluruh data produk yang tersedia.
            </p>
        </div>

        <a href="{{ route('produk.create') }}"
            class="inline-flex items-center px-4 py-2 bg-[#0A2540] hover:bg-[#12395f] text-white rounded-lg shadow transition">
            <i class="bi bi-plus-circle mr-2"></i>
            Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700">

        <div class="p-5 border-b border-slate-200 dark:border-slate-700">
            <form method="GET" action="{{ route('produk.index') }}">
                <div class="flex flex-col md:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau jenis produk..."
                        class="flex-1 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500">

                    <button
                        type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>

                    <a href="{{ route('produk.index') }}"
                        class="px-5 py-2 bg-slate-500 hover:bg-slate-600 text-white rounded-lg">
                        Reset
                    </a>

                </div>
            </form>
        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">

                <thead class="bg-slate-100 dark:bg-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Foto</th>
                        <th class="px-4 py-3 text-left">Nama Produk</th>
                        <th class="px-4 py-3 text-left">Jenis</th>
                        <th class="px-4 py-3 text-right">Harga Beli</th>
                        <th class="px-4 py-3 text-right">Harga Jual</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @forelse ($produk as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">

                        <td class="px-4 py-3">
                            {{ $produk->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-3">
                            @if($item->foto)
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-16 h-16 object-cover rounded-lg border">
                            @else
                                <div class="w-16 h-16 flex items-center justify-center bg-slate-200 rounded-lg text-slate-500">
                                    <i class="bi bi-image text-xl"></i>
                                </div>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">
                            {{ $item->nama }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                {{ $item->jenis_produk }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-right">
                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3 text-right">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($item->stok <= 5)
                                <span class="px-2 py-1 rounded bg-red-100 text-red-700 font-semibold">
                                    {{ $item->stok }}
                                </span>
                            @elseif($item->stok <= 20)
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold">
                                    {{ $item->stok }}
                                </span>
                            @else
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold">
                                    {{ $item->stok }}
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('produk.show', $item) }}"
                                    class="px-3 py-2 rounded-lg bg-sky-500 hover:bg-sky-600 text-white">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('produk.edit', $item) }}"
                                    class="px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form
                                    action="{{ route('produk.destroy', $item) }}"
                                    method="POST"
                                    class="form-hapus inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center py-10 text-slate-500">
                            Belum ada data produk.
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-5 py-4 border-t border-slate-200 dark:border-slate-700">

            <div class="text-sm text-slate-500 dark:text-slate-400">
                Menampilkan
                <span class="font-semibold">{{ $produk->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold">{{ $produk->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold">{{ $produk->total() }}</span>
                produk
            </div>

            {{ $produk->links() }}

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-hapus').forEach(function (form) {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Produk yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });

    });

});
</script>
@endpush