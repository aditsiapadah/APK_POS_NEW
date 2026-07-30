@extends('layouts.app')

@section('title', 'Edit Pengaturan')

@section('content')

<div class="space-y-6">


{{-- Judul --}}
<div class="flex justify-between items-center mb-8">

    <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
        Edit Pengaturan
    </h1>


    <a href="{{ route('pengaturan.index') }}"
       class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl
       font-medium transition flex items-center gap-2">

        <i class="fa-solid fa-arrow-left"></i>

        Kembali

    </a>

</div>



{{-- Error --}}
@if($errors->any())

<div class="bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700
text-red-700 dark:text-red-200 px-5 py-3 rounded-xl">

<ul class="list-disc pl-5">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif




<form action="{{ route('pengaturan.update') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')



{{-- INFORMASI TOKO --}}
<div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">


<div class="flex items-center gap-3 mb-8">

<div class="w-10 h-10 bg-[#0A2540] rounded-xl flex items-center justify-center text-white">

<i class="fa-solid fa-store"></i>

</div>


<h2 class="text-xl font-semibold text-gray-800 dark:text-white">
Informasi Toko
</h2>


</div>



<div class="grid grid-cols-1 md:grid-cols-2 gap-6">



{{-- Nama Toko --}}
<div class="md:col-span-2">

<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
Nama Toko
</label>


<input type="text"
name="nama_toko"
value="{{ old('nama_toko',$setting->nama_toko) }}"

class="w-full rounded-xl border border-gray-300
dark:border-slate-600
bg-white dark:bg-slate-700
text-gray-900 dark:text-white
px-4 py-3 focus:ring-2 focus:ring-[#0A2540]"
required>

</div>





{{-- Alamat --}}
<div class="md:col-span-2">

<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
Alamat
</label>


<textarea name="alamat"
rows="3"
class="w-full rounded-xl border border-gray-300
dark:border-slate-600
bg-white dark:bg-slate-700
text-gray-900 dark:text-white
px-4 py-3">{{ old('alamat',$setting->alamat) }}</textarea>


</div>




{{-- Telepon --}}
<div>

<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
Telepon / WhatsApp
</label>


<input type="text"
name="telepon"
value="{{ old('telepon',$setting->telepon) }}"

class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">

</div>





{{-- Email --}}
<div>

<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
Email
</label>


<input type="email"
name="email"
value="{{ old('email',$setting->email) }}"

class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">

</div>




{{-- Logo --}}
<div class="md:col-span-2">

<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
Logo Toko
</label>


@if($setting->logo)

<img src="{{ asset('storage/'.$setting->logo) }}"
class="w-24 h-24 rounded-full object-cover mb-4">


@endif


<input type="file"
name="logo"
accept="image/*"

class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">


<p class="text-xs text-gray-500 mt-2">
Format JPG PNG WEBP maksimal 2MB
</p>


</div>


</div>


</div>

{{-- TENTANG APLIKASI --}}
<div class="mt-10">


<div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">



<div class="flex items-center gap-3 mb-6">


<div class="w-10 h-10 bg-[#0A2540] rounded-xl flex items-center justify-center text-white">

<i class="fa-solid fa-circle-info"></i>

</div>


<h2 class="text-xl font-semibold text-gray-800 dark:text-white">

Tentang Aplikasi

</h2>


</div>





<div class="grid grid-cols-1 md:grid-cols-2 gap-6">





{{-- Nama Aplikasi --}}
<div>


<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">

Nama Aplikasi

</label>


<input type="text"

name="nama_aplikasi"

value="{{ old('nama_aplikasi',$setting->nama_aplikasi ?? 'POS ADITYA') }}"


class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">


</div>





{{-- Versi --}}
<div>


<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">

Versi Aplikasi

</label>


<input type="text"

name="versi_aplikasi"

value="{{ old('versi_aplikasi',$setting->versi_aplikasi ?? '1.0.0') }}"


class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">


</div>





{{-- Deskripsi --}}
<div class="md:col-span-2">


<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">

Deskripsi Aplikasi

</label>



<textarea

name="deskripsi_aplikasi"

rows="4"

class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">{{ old('deskripsi_aplikasi',$setting->deskripsi_aplikasi ?? 'Aplikasi kasir berbasis web untuk membantu pengelolaan transaksi, produk, stok, dan laporan penjualan.') }}</textarea>



</div>





{{-- Developer --}}
<div class="md:col-span-2">


<label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">

Developer

</label>



<input type="text"

name="developer"

value="{{ old('developer',$setting->developer ?? 'Aditya Dwi Saputra') }}"


class="w-full rounded-xl border
dark:border-slate-600
bg-white dark:bg-slate-700
dark:text-white
px-4 py-3">


</div>




</div>


</div>


</div>





{{-- Tombol Simpan --}}
<div class="mt-10 flex justify-end gap-3">


<a href="{{ route('pengaturan.index') }}"

class="bg-gray-200 hover:bg-gray-300
text-gray-700 px-6 py-3 rounded-xl font-semibold">

Batal

</a>



<button type="submit"

class="bg-[#0A2540] hover:bg-[#12395f]
text-white px-8 py-3 rounded-xl
font-semibold shadow-lg">


<i class="fa-solid fa-save mr-2"></i>

Simpan Perubahan


</button>


</div>




</form>


</div>


@endsection