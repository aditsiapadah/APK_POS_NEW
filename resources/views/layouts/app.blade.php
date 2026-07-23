<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'POS System')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        .navy-dark {
            background-color: #0A2540;
        }

        .navy-accent {
            background-color: #1E3A8A;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 
            0 20px 25px -5px rgb(0 0 0 / 0.1),
            0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
    </style>

</head>


<body class="bg-slate-50">


    {{-- Navbar hanya muncul jika sudah login --}}
    @if(auth()->check())
        @include('layouts.navbar')
    @endif



    {{-- Jarak atas hanya jika navbar muncul --}}
    <div class="min-h-screen {{ auth()->check() ? 'pt-16' : '' }}">

        <div class="max-w-7xl mx-auto px-6 py-8">

            @yield('content')

        </div>

    </div>


</body>

</html>