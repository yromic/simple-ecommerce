<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SecureMart') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-900 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Animated Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div
            class="absolute top-0 left-1/4 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-1/3 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
        </div>
    </div>

    <div class="relative min-h-screen flex flex-col justify-between">

        <!-- Navbar -->
        <nav class="flex items-center justify-between p-6 lg:px-12">
            <div class="flex items-center gap-2">
                <div class="bg-gray-900 text-white p-2 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">SecureMart</span>
            </div>

            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-indigo-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-indigo-600 transition">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="hidden sm:block px-5 py-2.5 bg-gray-900 text-white font-semibold rounded-full hover:bg-gray-800 transition shadow-lg shadow-gray-300/50">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center px-6">
            <div class="max-w-4xl w-full text-center space-y-8">



                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 leading-tight">
                    Belanja Aman, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        Tanpa Cemas.
                    </span>
                </h1>


                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="{{ route('search') }}"
                        class="w-full sm:w-auto px-8 py-4 bg-gray-900 text-white rounded-full font-bold text-lg shadow-xl hover:bg-indigo-600 hover:shadow-indigo-200 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Mulai Belanja
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto px-8 py-4 bg-white text-gray-900 border border-gray-200 rounded-full font-bold text-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 transition-all duration-300">
                            Masuk Akun
                        </a>
                    @endguest
                </div>

            </div>
        </main>

    </div>
</body>

</html>
