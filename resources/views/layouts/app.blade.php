<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    </style>

</head>

<body class="bg-slate-100 dark:bg-slate-900">

@if(auth()->check())

    <div class="sidebar">
        @include('layouts.sidebar')
    </div>

    <div class="content">

        <div class="topbar">
            @include('layouts.topbar')
        </div>

        <div class="page">
            @yield('content')
        </div>

    </div>

@else

    @yield('content')

@endif

</body>

</html>