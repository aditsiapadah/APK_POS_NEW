@extends('layouts.app')

@section('title', 'Pembayaran QRIS')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow p-6 text-center">

    <h1 class="text-2xl font-bold text-slate-800 mb-5">
        Pembayaran QRIS
    </h1>

    <p class="text-gray-500">
        Total Pembayaran
    </p>

    <h2 class="text-3xl font-bold text-blue-700 mb-6">
        Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
    </h2>

    {{-- QRIS ASLI --}}
    <div class="flex justify-center mb-6">
        <div class="bg-white p-3 rounded-xl border shadow-sm">
            <img
                src="{{ asset('images/qris.png') }}"
                alt="QRIS GoPay"
                class="w-[250px] h-[250px] object-contain"
            >
        </div>
    </div>

    <p class="text-sm text-gray-500 mb-2">
        Silakan scan QRIS
    </p>

    <p class="text-xs text-gray-400 mb-5">
        Masukkan nominal pembayaran sesuai total transaksi di atas.
    </p>

    <form
        action="{{ route('penjualan.bayar', $penjualan->id) }}"
        method="POST"
    >

        @csrf

        <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition"
        >
            ✓ Konfirmasi Pembayaran
        </button>

    </form>

</div>

@endsection