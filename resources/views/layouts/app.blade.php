<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        @yield('title', 'POS System')
    </title>



    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>


    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>




    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">






    {{-- Dark Mode --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {

            document.documentElement.classList.add('dark');

        }
    </script>





    <style>
        body {
            font-family: 'Inter', sans-serif;
        }



        .menu-active {
            background: #1E3A8A;
        }




        .sidebar {

            width: 260px;

            position: fixed;

            left: 0;

            top: 0;

            height: 100vh;

            z-index: 50;

        }






        .content {

            margin-left: 260px;

            width: calc(100% - 260px);

            min-height: 100vh;

        }







        .topbar {

            position: fixed;

            top: 0;

            left: 260px;

            right: 0;

            height: 64px;

            z-index: 40;

        }







        .page {

            padding: 95px 32px 32px;

        }





        /* CARD HOVER ANIMATION */

        .card-hover {

            transition: all 0.3s ease;

        }


        .card-hover:hover {

            transform: translateY(-8px);

            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

        }




        /* TABLE CARD HOVER */

        .table-hover {

            transition: all 0.3s ease;

        }


        .table-hover:hover {

            transform: translateY(-8px);

            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

        }
    </style>


</head>







<body class="bg-slate-100 dark:bg-slate-900">






    @if(auth()->check())



    {{-- Sidebar --}}

    <div class="sidebar">

        @include('layouts.sidebar')

    </div>







    {{-- Content --}}

    <div class="content">





        {{-- Topbar --}}

        <div class="topbar">

            @include('layouts.topbar')

        </div>








        {{-- Isi Halaman --}}

        <div class="page">

            @yield('content')

        </div>







    </div>







    @else



    {{-- Halaman Login --}}

    @yield('content')



    @endif







    {{-- SweetAlert Notification --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>






    @if(session('success'))

    <script>
        Swal.fire({

            title: 'Berhasil!',

            text: "{{ session('success') }}",

            icon: 'success',

            confirmButtonColor: '#0A2540',

            confirmButtonText: 'OK',

            timer: 2500,

            timerProgressBar: true

        });
    </script>

    @endif







    @if(session('error'))

    <script>
        Swal.fire({

            title: 'Gagal!',

            text: "{{ session('error') }}",

            icon: 'error',

            confirmButtonColor: '#0A2540',

            confirmButtonText: 'OK'

        });
    </script>

    @endif





</body>


</html>