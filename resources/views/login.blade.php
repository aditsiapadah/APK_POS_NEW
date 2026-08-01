<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login POS ADITYA</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255,255,255,.25);
            box-shadow: 0 25px 50px rgba(0,0,0,.25);
            animation: show .7s ease;
        }

        @keyframes show {
            from {
                opacity:0;
                transform:translateY(30px) scale(.95);
            }
            to {
                opacity:1;
                transform:translateY(0) scale(1);
            }
        }

        .input-field:focus {
            box-shadow:0 0 0 3px rgba(10,37,64,.2);
        }

        .btn-login {
            background:linear-gradient(135deg,#0A2540,#1E3A8A);
            transition:.3s;
        }

        .btn-login:hover {
            transform:translateY(-2px);
            box-shadow:0 15px 30px rgba(30,58,138,.45);
        }

        .blob {
            position:absolute;
            border-radius:50%;
            filter:blur(80px);
            opacity:.5;
            animation:move 12s infinite alternate ease-in-out;
        }

        .blob-one {
            width:350px;
            height:350px;
            background:#2563eb;
            top:-120px;
            left:-100px;
        }

        .blob-two {
            width:420px;
            height:420px;
            background:#1e40af;
            right:-120px;
            bottom:-150px;
            animation-delay:3s;
        }

        .blob-three {
            width:250px;
            height:250px;
            background:#38bdf8;
            top:40%;
            left:65%;
            animation-delay:6s;
        }

        @keyframes move {
            0% {
                transform:translate(0,0) scale(1);
            }
            50% {
                transform:translate(70px,-40px) scale(1.15);
            }
            100% {
                transform:translate(-50px,50px) scale(.9);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#020617] via-[#0A2540] to-[#1E3A8A] p-4 overflow-hidden relative">

<div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="blob blob-one"></div>
    <div class="blob blob-two"></div>
    <div class="blob blob-three"></div>
</div>

<div class="w-full max-w-md relative z-10">

    <div class="glass-card rounded-3xl p-8 sm:p-10 border border-white/30">

        <div class="flex justify-center mb-6">
            <div class="relative">
                <div class="absolute inset-0 bg-white/30 rounded-full blur-xl"></div>

                <img src="{{ asset('images/logo-sekolah.png') }}"
                    class="relative w-24 h-24 rounded-full object-cover shadow-xl ring-4 ring-white/40"
                    alt="Logo Sekolah">
            </div>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">
                POS ADITYA
            </h1>

            <p class="text-white/80 text-sm mt-2 font-medium">
                Sistem Kasir Digital
            </p>
        </div>


        <form action="{{ route('auth') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-white mb-2">
                    Email Address
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="w-6 h-6 rounded-full bg-[#0A2540]/10 flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-[#0A2540] text-xs"></i>
                        </div>
                    </div>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/40 bg-white/85 text-[#0A2540] placeholder:text-gray-400 outline-none transition"
                        placeholder="Masukkan email anda">
                </div>
            </div>


            <div>
                <label class="block text-sm font-semibold text-white mb-2">
                    Password
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="w-6 h-6 rounded-full bg-[#0A2540]/10 flex items-center justify-center">
                            <i class="fa-solid fa-lock text-[#0A2540] text-xs"></i>
                        </div>
                    </div>

                    <input type="password"
                        name="password"
                        required
                        class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/40 bg-white/85 text-[#0A2540] placeholder:text-gray-400 outline-none transition"
                        placeholder="Masukkan password">
                </div>
            </div>


            <button type="submit"
                class="btn-login w-full py-3.5 rounded-xl text-white font-semibold text-[15px] flex items-center justify-center gap-2">

                <i class="fa-solid fa-right-to-bracket"></i>

                <span>Masuk</span>

            </button>

        </form>

    </div>


    <p class="text-center text-white/80 text-sm mt-6 font-medium">
        © {{ date('Y') }} POS ADITYA.
    </p>

</div>

</body>
</html>