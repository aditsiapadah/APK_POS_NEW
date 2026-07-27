<div class="fixed top-0 left-0 h-screen bg-[#0A2540] text-white shadow-xl z-50"
     style="width:260px;">

    <!-- Logo -->
    <div class="flex items-center gap-3 p-6 border-b border-blue-900">

        <img src="{{ asset('images/logo-sekolah.png') }}"
             class="w-12 h-12 rounded-full"
             alt="Logo">

        <div>
            <h1 class="font-bold text-lg">POS ADITYA</h1>
            <small class="text-gray-300">Point Of Sale</small>
        </div>

    </div>

    <!-- Menu -->
    <div class="mt-6 px-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1E3A8A] {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1E3A8A]">
            <i class="fa-solid fa-users"></i>
            Users
        </a>

        <a href="{{ route('produk.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1E3A8A]">
            <i class="fa-solid fa-box"></i>
            Produk
        </a>

        <a href="{{ route('penjualan.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1E3A8A]">
            <i class="fa-solid fa-cart-shopping"></i>
            Penjualan
        </a>

    </div>

    <!-- Profil + Logout -->
    <div class="absolute bottom-0 left-0 right-0 p-5">

        <div class="border-t border-blue-800 pt-4 mb-4">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-full bg-white text-[#0A2540] flex items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div>
                    <p class="font-semibold">
                        {{ Auth::user()->name }}
                    </p>

                    <small class="text-gray-300">
                        {{ Auth::user()->role->name ?? '-' }}
                    </small>
                </div>

            </div>

        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                class="w-full bg-white text-[#0A2540] rounded-xl py-3 font-semibold hover:bg-gray-200">

                <i class="fa-solid fa-right-from-bracket"></i>
                Logout

            </button>
        </form>

    </div>

</div>