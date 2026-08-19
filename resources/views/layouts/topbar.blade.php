<div class="h-16 bg-white dark:bg-slate-800 shadow-md border-b border-slate-200 dark:border-slate-700 px-4 md:px-8 flex items-center justify-between">

    {{-- Kiri --}}
    <div class="flex items-center gap-3 min-w-0">
        <button type="button"
                id="sidebar-toggle"
                title="Perkecil / perbesar sidebar"
                class="w-11 h-11 shrink-0 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition text-slate-700 dark:text-slate-200">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white truncate">
            @yield('title')
        </h1>
    </div>

    {{-- Kanan --}}
    <div class="flex items-center gap-4">

        {{-- Jam --}}
        <div class="hidden md:flex items-center gap-2 text-slate-600 dark:text-slate-300">
            <i class="far fa-clock"></i>
            <span id="clock"></span>
        </div>

        {{-- Notifikasi --}}
        <div class="relative">

            <button
                id="notifBtn"
                class="relative w-11 h-11 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">

                <i class="far fa-bell text-lg"></i>

                @if($totalNotif > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px] rounded-full flex items-center justify-center">
                        {{ $totalNotif }}
                    </span>
                @endif

            </button>

            {{-- Dropdown --}}
            <div
                id="notifMenu"
                class="hidden absolute right-0 top-14 w-[360px] bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 z-50 overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b dark:border-slate-700">

                    <h3 class="font-bold flex items-center gap-2">
                        🔔 Notifikasi
                    </h3>

                    <span class="text-xs text-slate-500">
                        {{ $totalNotif }} Notifikasi
                    </span>

                </div>

                {{-- Isi Notifikasi --}}
                <div class="max-h-80 overflow-y-auto">

                    @forelse($stokRendah as $produk)

                        <a href="{{ route('produk.index') }}"
                            class="flex gap-3 px-5 py-4 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition">

                            <div
                                class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                <i class="fas fa-exclamation"></i>
                            </div>

                            <div class="flex-1">

                                <div class="font-semibold text-yellow-600">
                                    Stok Rendah
                                </div>

                                <div class="text-sm text-slate-600 dark:text-slate-300">
                                    {{ $produk->nama }}
                                </div>

                                <small class="text-slate-500">
                                    Sisa {{ $produk->stok }}
                                </small>

                            </div>

                        </a>

                    @empty
                    @endforelse

                    @foreach($stokHabis as $produk)

                        <a href="{{ route('produk.index') }}"
                            class="flex gap-3 px-5 py-4 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition">

                            <div
                                class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                <i class="fas fa-times"></i>
                            </div>

                            <div class="flex-1">

                                <div class="font-semibold text-red-600">
                                    Stok Habis
                                </div>

                                <div class="text-sm text-slate-600 dark:text-slate-300">
                                    {{ $produk->nama }}
                                </div>

                            </div>

                        </a>

                    @endforeach

                    @if($transaksiOpen>0)

                        <a href="{{ route('penjualan.index') }}"
                            class="flex gap-3 px-5 py-4 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition">

                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <i class="fas fa-file-invoice"></i>
                            </div>

                            <div class="flex-1">

                                <div class="font-semibold text-blue-600">
                                    Transaksi OPEN
                                </div>

                                <div class="text-sm text-slate-600 dark:text-slate-300">
                                    Ada {{ $transaksiOpen }} transaksi belum selesai
                                </div>

                            </div>

                        </a>

                    @endif

                    @if($totalNotif==0)

                        <div class="py-10 text-center text-slate-500">

                            <i class="far fa-bell-slash text-3xl mb-2"></i>

                            <div>Tidak ada notifikasi</div>

                        </div>

                    @endif

                </div>

                {{-- Footer --}}
                <div
                    class="px-4 py-3 bg-slate-50 dark:bg-slate-900 border-t dark:border-slate-700 text-center">

                    <small class="text-slate-500">

                        Menampilkan maksimal 5 data

                    </small>

                </div>

            </div>

        </div>

        {{-- Dark Mode --}}
        <button
            id="theme-toggle"
            class="w-11 h-11 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">

            <i id="theme-icon" class="fas fa-moon"></i>

        </button>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ==========================
    // JAM REALTIME
    // ==========================

    function updateClock() {

        const now = new Date();

        const jam = now.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit"
        });

        const clock = document.getElementById("clock");

        if (clock) {
            clock.innerHTML = jam + " WIB";
        }

    }

    updateClock();
    setInterval(updateClock, 1000);


    // ==========================
    // DARK MODE
    // ==========================

    const html = document.documentElement;
    const themeBtn = document.getElementById("theme-toggle");
    const themeIcon = document.getElementById("theme-icon");

    function setTheme(theme) {

        if (theme === "dark") {

            html.classList.add("dark");

            if (themeIcon) {
                themeIcon.classList.remove("fa-moon");
                themeIcon.classList.add("fa-sun");
            }

        } else {

            html.classList.remove("dark");

            if (themeIcon) {
                themeIcon.classList.remove("fa-sun");
                themeIcon.classList.add("fa-moon");
            }

        }

    }

    setTheme(localStorage.getItem("theme") || "light");

    if (themeBtn) {

        themeBtn.addEventListener("click", function () {

            const dark = html.classList.contains("dark");

            if (dark) {

                localStorage.setItem("theme", "light");
                setTheme("light");

            } else {

                localStorage.setItem("theme", "dark");
                setTheme("dark");

            }

        });

    }


    // ==========================
    // DROPDOWN NOTIFIKASI
    // ==========================

    const notifBtn = document.getElementById("notifBtn");
    const notifMenu = document.getElementById("notifMenu");

    if (notifBtn && notifMenu) {

        notifBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            notifMenu.classList.toggle("hidden");

        });

        notifMenu.addEventListener("click", function (e) {

            e.stopPropagation();

        });

        document.addEventListener("click", function () {

            notifMenu.classList.add("hidden");

        });

        document.addEventListener("keydown", function (e) {

            if (e.key === "Escape") {
                notifMenu.classList.add("hidden");
            }

        });

    }

});
</script>