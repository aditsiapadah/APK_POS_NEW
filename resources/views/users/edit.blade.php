@extends('layouts.app')

@section('content')


<div class="bg-white p-8 rounded-2xl shadow">


<h1 class="text-2xl font-bold mb-5">
Edit User
</h1>


<form action="{{route('admin.users.update',$user->id)}}"
method="POST">


@csrf


<input 
name="name"
value="{{$user->name}}"
class="border p-3 rounded-xl w-full mb-3">



<input 
name="email"
value="{{$user->email}}"
class="border p-3 rounded-xl w-full mb-3">



<select name="role_id"
class="border p-3 rounded-xl w-full mb-3">


@foreach($roles as $role)

<option value="{{$role->id}}"
@if($user->role_id==$role->id)
selected
@endif>

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

        <i class="fa-solid fa-pen mr-2"></i>
        Update

    </button>


</div>


</form>


</div>


@endsection