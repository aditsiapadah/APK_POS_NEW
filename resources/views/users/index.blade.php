@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="space-y-6">


    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-[#0A2540]">
                Data Users
            </h1>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="bg-[#0A2540] text-white px-5 py-3 rounded-xl
            font-semibold shadow hover:bg-[#12395f] transition">
            <i class="fa-solid fa-user-plus mr-2"></i>
            Tambah User
        </a>
    </div>

    <!-- Card Table -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <!-- Search -->
        <form method="GET" action="{{ route('admin.users') }}"
            class="relative w-80">
            <i class="fa-solid fa-search absolute left-4 top-3.5 text-gray-400"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama user..."
                class="w-full pl-11 py-3 rounded-xl border
        border-gray-300 focus:ring-2 focus:ring-[#0A2540]">
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500">
                    <th class="px-8 py-5">#</th>
                    <th class="px-8 py-5">
                        Nama
                    </th>
                    <th class="px-8 py-5">
                        Email
                    </th>
                    <th class="px-8 py-5">
                        Role
                    </th>
                    <th class="px-8 py-5 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-8 py-5">
                        {{ $users->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-5 font-semibold">
                        {{ $user->name }}
                    </td>
                    <td class="px-8 py-5 text-gray-600">
                        {{ $user->email }}
                    </td>
                    <td class="px-8 py-5">
                        @if($user->role->name == "Admin")
                        <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm">
                            Admin
                        </span>
                        @else
                        <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                            Kasir
                        </span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('admin.users.edit',$user->id) }}"
                                class="w-10 h-10 rounded-lg
                                bg-yellow-400 hover:bg-yellow-500
                                flex items-center justify-center
                                text-white">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('admin.users.destroy',$user->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Hapus user ini?')"
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
                    <td colspan="5"
                        class="text-center py-10 text-gray-500">
                        Tidak ada data user
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $users->links() }}
    </div>

    @endsection