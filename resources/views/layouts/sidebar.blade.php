<div class="fixed top-0 left-0 h-screen z-50 text-white shadow-2xl"
     style="width: 270px;
            background: linear-gradient(180deg, #0A2540 0%, #0B1220 100%);
            border-right: 1px solid rgba(255,255,255,0.08);">

    <!-- Logo -->
    <div class="flex items-center gap-3 p-6 border-b border-white/10">
        <div class="relative">
            <div class="absolute inset-0 bg-white/20 rounded-full blur-md"></div>
            <img src="{{ asset('images/logo-sekolah.png') }}"
                 class="relative w-12 h-12 rounded-full object-cover ring-2 ring-white/20 shadow-lg"
                 alt="Logo">
        </div>

        <div>
            <h1 class="font-bold text-lg tracking-wide text-white">
                POS ADITYA
            </h1>
            <p class="text-xs text-white/50">
                Sistem Kasir Digital
            </p>
        </div>
    </div>

    <!-- Menu -->
    <div class="mt-6 px-4 space-y-1">

        <p class="text-[11px] text-white/40 uppercase tracking-wider mb-3 px-3 font-medium">
            Menu Utama
        </p>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('dashboard') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-house text-sm"></i>
            </div>
            <span class="font-medium text-sm">Dashboard</span>
        </a>

        <!-- Users (hanya Admin) -->
        @if(Auth::user()->role_id == 1)
        <a href="{{ route('admin.users') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('admin.users*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('admin.users*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-users text-sm"></i>
            </div>
            <span class="font-medium text-sm">Users</span>
        </a>
        @endif

        <!-- Produk -->
        <a href="{{ route('produk.index') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('produk.*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('produk.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-box text-sm"></i>
            </div>
            <span class="font-medium text-sm">Produk</span>
        </a>

        <!-- Distributor -->
        <a href="{{ route('distributor.index') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
        {{ request()->routeIs('distributor.*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                {{ request()->routeIs('distributor.*') 
                    ? 'bg-white/20' 
                    : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-truck text-sm"></i>
            </div>
            <span class="font-medium text-sm">
                Distributor
            </span>
        </a>

        <!-- Penjualan -->
        <a href="{{ route('penjualan.index') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('penjualan.*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('penjualan.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-cart-shopping text-sm"></i>
            </div>
            <span class="font-medium text-sm">Penjualan</span>
        </a>

        <!-- Riwayat Transaksi -->
        <a href="{{ route('riwayat.index') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('riwayat.*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('riwayat.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-clock-rotate-left text-sm"></i>
            </div>
            <span class="font-medium text-sm">Riwayat Transaksi</span>
        </a>

        <!-- Pengaturan -->
        <a href="{{ route('pengaturan.index') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           {{ request()->routeIs('pengaturan.*') 
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40' 
                : 'hover:bg-white/10' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center
                 {{ request()->routeIs('pengaturan.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fa-solid fa-gear text-sm"></i>
            </div>
            <span class="font-medium text-sm">Pengaturan</span>
        </a>

    </div>

    <!-- User Profile + Logout -->
    <div class="absolute bottom-0 left-0 right-0 p-5">

        <div class="border-t border-white/10 pt-5 mb-4">
            <div class="flex items-center gap-3 px-2">
                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-[#1E3A8A] to-[#2563eb]
                            flex items-center justify-center shadow-lg ring-2 ring-white/10">
                    <i class="fa-solid fa-user text-sm"></i>
                </div>

                <div class="overflow-hidden flex-1">
                    <p class="font-semibold text-sm truncate text-white">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-white/50 truncate">
                        {{ Auth::user()->role->name ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2
                           bg-white/10 hover:bg-white/15 
                           border border-white/10
                           text-white rounded-xl py-3 text-sm font-medium
                           transition-all duration-200 hover:shadow-lg">
                <i class="fa-solid fa-right-from-bracket text-sm"></i>
                Logout
            </button>
        </form>
    </div>
</div>