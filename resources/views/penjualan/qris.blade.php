@extends('layouts.app')

@section('title','Pembayaran QRIS')


@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow p-6 text-center">


<h1 class="text-2xl font-bold text-slate-800 mb-5">
    Pembayaran QRIS
</h1>


<p class="text-gray-500">
    Total Pembayaran
</p>


<h2 class="text-3xl font-bold text-blue-700 mb-6">
Rp {{ number_format($penjualan->total_pembayaran,0,',','.') }}
</h2>



<div class="flex justify-center mb-6">

{!! QrCode::size(250)->generate(
'POS ADITYA TRANSAKSI '.$penjualan->id
) !!}

</div>



<p class="text-sm text-gray-500 mb-5">
Silakan scan QR Code
</p>



<form action="{{ route('penjualan.bayar',$penjualan->id) }}"
method="POST">

@csrf

<button
class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold">

✓ Konfirmasi Pembayaran

</button>


</form>


</div>

@endsection