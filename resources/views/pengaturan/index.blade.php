@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol Edit --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Pengaturan
        </h1>

        <a href="{{ route('pengaturan.edit') }}"
           class="bg-[#0A2540] hover:bg-[#12395f] text-white px-6 py-3 rounded-xl
           font-semibold transition shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-pen"></i>
            Edit
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700
            text-green-700 dark:text-green-200 px-5 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Informasi Toko --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-8">
            Informasi Toko
        </h2>

        <div class="flex flex-col md:flex-row gap-8 items-start">

            <div class="flex-shrink-0">
                @if($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}"
                         alt="Logo Toko"
                         class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 dark:border-slate-600 shadow">
                @else
                    <div class="w-32 h-32 rounded-full bg-[#0A2540] flex items-center justify-center text-white text-4xl font-bold shadow">
                        {{ strtoupper(substr($setting->nama_toko ?? 'P', 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="flex-1 space-y-5">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Nama Toko</p>
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $setting->nama_toko ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Alamat</p>
                    <p class="text-gray-800 dark:text-gray-200">
                        {{ $setting->alamat ?: '-' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Telepon / WhatsApp</p>
                        <p class="text-gray-800 dark:text-gray-200">
                            {{ $setting->telepon ?: '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Email</p>
                        <p class="text-gray-800 dark:text-gray-200">
                            {{ $setting->email ?: '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengaturan Tampilan --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">
            Pengaturan Tampilan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Bahasa</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ $setting->bahasa == 'en' ? 'English' : 'Indonesia' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Mata Uang</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ $setting->mata_uang ?? 'IDR' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Data per Halaman</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ $setting->per_page ?? 10 }} data
                </p>
            </div>

        </div>
    </div>

</div>

@endsection