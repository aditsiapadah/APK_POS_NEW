<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login POS ADITYA</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>


<body class="min-h-screen flex items-center justify-center 
             bg-gradient-to-br from-[#0A2540] via-[#12395f] to-[#1E3A8A]">


    <div class="w-full max-w-md">


        <!-- Card Login -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">


            <!-- Logo -->
            <div class="flex justify-center mb-5">

                <img src="{{ asset('images/logo-sekolah.png') }}"
                    class="w-20 h-20 rounded-full object-cover shadow-md"
                    alt="Logo Sekolah">

            </div>



            <!-- Judul -->
            <div class="text-center mb-6">

                <h1 class="text-2xl font-bold text-[#0A2540]">
                    POS ADITYA
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Sistem Kasir Digital
                </p>

            </div>



            <!-- Login -->
            <form action="{{ route('auth') }}" method="POST">

                @csrf


                <!-- Email -->
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>


                    <div class="relative">

                        <i class="fa-solid fa-envelope 
                    absolute left-4 top-3.5 text-gray-400"></i>


                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full pl-11 pr-4 py-3
                           rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-[#0A2540]
                           focus:border-[#0A2540]
                           outline-none"
                            placeholder="Masukkan email">


                    </div>

                </div>



                <!-- Password -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>


                    <div class="relative">

                        <i class="fa-solid fa-lock 
                    absolute left-4 top-3.5 text-gray-400"></i>


                        <input type="password"
                            name="password"
                            class="w-full pl-11 pr-4 py-3
                           rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-[#0A2540]
                           focus:border-[#0A2540]
                           outline-none"
                            placeholder="Masukkan password">


                    </div>

                </div>



                <!-- Button -->
                <button type="submit"
                    class="w-full py-3 rounded-xl
                bg-[#0A2540]
                text-white font-semibold
                hover:bg-[#12395f]
                transition duration-300">

                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login

                </button>


            </form>


        </div>



        <!-- Footer -->
        <p class="text-center text-white text-sm mt-5">
            © {{ date('Y') }} POS ADITYA
        </p>


    </div>


</body>

</html>