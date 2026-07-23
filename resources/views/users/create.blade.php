@extends('layouts.app')

@section('content')


<div class="bg-white p-8 rounded-2xl shadow">


<h1 class="text-2xl font-bold text-[#0A2540] mb-5">
Tambah User
</h1>



<form action="{{route('admin.users.store')}}" method="POST">

@csrf


<input name="name"
placeholder="Nama"
class="border rounded-xl p-3 w-full mb-3">



<input name="email"
placeholder="Email"
class="border rounded-xl p-3 w-full mb-3">



<input type="password"
name="password"
placeholder="Password"
class="border rounded-xl p-3 w-full mb-3">



<select name="role_id"
class="border rounded-xl p-3 w-full mb-3">


@foreach($roles as $role)

<option value="{{$role->id}}">
{{$role->name}}
</option>

@endforeach


</select>




<div class="flex gap-3">


    <a href="{{ route('admin.users') }}"
       class="bg-gray-500 text-white px-5 py-3 rounded-xl
       hover:bg-gray-600 transition">

        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali

    </a>



    <button
    class="bg-[#0A2540] text-white px-5 py-3 rounded-xl
    hover:bg-[#12395f] transition">

        <i class="fa-solid fa-save mr-2"></i>
        Simpan

    </button>


</div>



</form>


</div>


@endsection