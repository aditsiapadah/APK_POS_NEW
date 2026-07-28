<div class="fixed top-0 left-0 h-screen bg-[#0A2540] text-white shadow-xl z-50"
     style="width:260px;">

    <!-- Logo -->
    <div class="flex items-center gap-3 p-6 border-b border-blue-900">
        <img src="{{ asset('images/logo-sekolah.png') }}"
             class="w-12 h-12 rounded-full object-cover"
             alt="Logo">

        <div>
            <h1 class="font-bold text-lg tracking-wide">
                POS ADITYA
            </h1>
            <small class="text-gray-300">
                Point Of Sale
            </small>
        </div>
    </div>

    <!-- Menu -->
    <div class="mt-6 px-4">

        <p class="text-xs text-gray-400 uppercase mb-3 px-3">
            Menu Utama
        </p>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
           hover:bg-[#1E3A8A]
           {{ request()->routeIs('dashboard') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-house w-5"></i>
            <span>Dashboard</span>
        </a>

        <!-- Users -->
        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
           hover:bg-[#1E3A8A]
           {{ request()->routeIs('admin.users') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-users w-5"></i>
            <span>Users</span>
        </a>

        <!-- Produk -->
        <a href="{{ route('produk.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
           hover:bg-[#1E3A8A]
           {{ request()->routeIs('produk.*') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-box w-5"></i>
            <span>Produk</span>
        </a>

        <!-- Penjualan -->
        <a href="{{ route('penjualan.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
           hover:bg-[#1E3A8A]
           {{ request()->routeIs('penjualan.*') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-cart-shopping w-5"></i>
            <span>Penjualan</span>
        </a>

        <!-- Riwayat Transaksi -->
        <a href="{{ route('riwayat.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
           hover:bg-[#1E3A8A]
           {{ request()->routeIs('riwayat.*') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-clock-rotate-left w-5"></i>
            <span>Riwayat Transaksi</span>
        </a>

        <!-- Pengaturan -->
        <a href="{{ route('pengaturan.index') }}"
        class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl transition
        hover:bg-[#1E3A8A]
        {{ request()->routeIs('pengaturan.*') ? 'bg-[#1E3A8A]' : '' }}">
            <i class="fa-solid fa-gear w-5"></i>
            <span>Pengaturan</span>
        </a>

        

    </div>

    <!-- User Profile -->
    <div class="absolute bottom-0 left-0 right-0 p-5">

        <div class="border-t border-blue-800 pt-4 mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-white text-[#0A2540]
                            flex items-center justify-center shadow">
                    <i class="fa-solid fa-user text-lg"></i>
                </div>

                <div class="overflow-hidden">
                    <p class="font-semibold truncate">
                        {{ Auth::user()->name }}
                    </p>
                    <small class="text-gray-300">
                        {{ Auth::user()->role->name ?? '-' }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full bg-white text-[#0A2540]
                    rounded-xl py-3 font-semibold
                    hover:bg-gray-200 transition">
                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                Logout
            </button>
        </form>

    </div>

</div>