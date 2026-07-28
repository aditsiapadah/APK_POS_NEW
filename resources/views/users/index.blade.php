@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
                Data Users
            </h1>
        </div>

        <a href="{{ route('admin.users.create') }}"
            class="bg-[#0A2540] hover:bg-[#12395f]
                   text-white px-5 py-3 rounded-xl
                   font-semibold shadow transition">
            <i class="fa-solid fa-user-plus mr-2"></i>
            Tambah User
        </a>
    </div>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">

        <form method="GET"
            action="{{ route('admin.users') }}"
            class="relative w-full md:w-80">

            <i class="fa-solid fa-search absolute left-4 top-3.5 text-gray-400 dark:text-gray-500"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama user..."
                class="w-full pl-11 py-3 rounded-xl
                       border border-gray-300 dark:border-slate-600
                       bg-white dark:bg-slate-700
                       text-gray-800 dark:text-white
                       placeholder-gray-400 dark:placeholder-gray-400
                       focus:ring-2 focus:ring-[#0A2540]
                       focus:outline-none">
        </form>

    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr class="text-left text-gray-500 dark:text-gray-200">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">Nama</th>
                    <th class="px-8 py-5">Email</th>
                    <th class="px-8 py-5">Role</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $index => $user)

                <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                    <td class="px-8 py-5 text-gray-700 dark:text-gray-200">
                        {{ $users->firstItem() + $index }}
                    </td>

                    <td class="px-8 py-5 font-semibold text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </td>

                    <td class="px-8 py-5 text-gray-600 dark:text-gray-300">
                        {{ $user->email }}
                    </td>

                    <td class="px-8 py-5">
                        @if($user->role->name == 'Admin')
                            <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 px-4 py-1 rounded-full text-sm">
                                Admin
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 px-4 py-1 rounded-full text-sm">
                                Kasir
                            </span>
                        @endif
                    </td>

                    <td class="px-8 py-5">

                        <div class="flex justify-center gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="w-10 h-10 rounded-lg
                                       bg-yellow-400 hover:bg-yellow-500
                                       flex items-center justify-center
                                       text-white transition">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-10 h-10 rounded-lg
                                           bg-red-500 hover:bg-red-600
                                           flex items-center justify-center
                                           text-white transition">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-10 text-gray-500 dark:text-gray-300">

                        Tidak ada data user

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-8 dark:text-white">
        {{ $users->links() }}
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
    title: 'Gagal',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33'
});
</script>
@endif

<script>
document.querySelectorAll('.delete-form').forEach(function(form) {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Hapus User?',
            text: 'Apakah Anda yakin ingin menghapus user ini?',
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

    });

});
</script>

@endsection