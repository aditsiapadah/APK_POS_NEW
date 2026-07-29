<div class="fixed top-0 right-0 h-16
            bg-white dark:bg-slate-900
            border-b border-gray-200 dark:border-slate-700
            shadow-sm
            flex items-center justify-between
            px-6 z-40"
     style="left:260px;">

    <!-- Judul Halaman -->
    <div>
        <h2 class="text-xl font-semibold text-[#0A2540] dark:text-white">
            @yield('title')
        </h2>
    </div>

    <!-- Dark Mode -->
    <button id="theme-toggle"
        class="w-11 h-11 rounded-full
               bg-slate-100 hover:bg-slate-200
               dark:bg-slate-700 dark:hover:bg-slate-600
               transition duration-300
               flex items-center justify-center">

        <i id="theme-icon"
            class="fa-solid fa-moon text-lg text-[#0A2540] dark:text-yellow-300"></i>

    </button>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const html = document.documentElement;
    const btn = document.getElementById('theme-toggle');
    const icon = document.getElementById('theme-icon');

    function setTheme(theme){

        if(theme === 'dark'){

            html.classList.add('dark');

            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');

        }else{

            html.classList.remove('dark');

            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');

        }

    }

    setTheme(localStorage.getItem('theme') || 'light');

    btn.onclick = function(){

        if(html.classList.contains('dark')){

            localStorage.setItem('theme','light');
            setTheme('light');

        }else{

            localStorage.setItem('theme','dark');
            setTheme('dark');

        }

    }

});
</script>   