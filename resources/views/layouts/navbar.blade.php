<nav class="fixed top-0 left-0 right-0 bg-[#0A2540] shadow-lg z-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center h-16">

            <!-- Logo + Nama -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 text-white text-xl font-bold">

                <img src="{{ asset('images/logo-sekolah.png') }}"
                     class="w-10 h-10 rounded-full object-cover"
                     alt="Logo Sekolah">

                <span>
                    POS ADITYA
                </span>

            </a>


            <!-- Menu -->
            <div class="flex gap-8 ml-auto mr-8">

                <a href="{{ route('dashboard') }}"
                   class="text-white hover:text-gray-300">
                    Dashboard
                </a>


                <a href="{{ route('admin.users') }}"
                   class="text-white hover:text-gray-300">
                    Users
                </a>


                <a href="{{ route('produk.index') }}"
                   class="text-white hover:text-gray-300">
                    Produk
                </a>


                <a href="{{ route('penjualan.index') }}"
                   class="text-white hover:text-gray-300">
                    Penjualan
                </a>

            </div>


            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit"
                    class="bg-white text-[#0A2540] px-5 py-2 rounded-xl font-semibold">

                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout

                </button>

            </form>


        </div>

    </div>
</nav>