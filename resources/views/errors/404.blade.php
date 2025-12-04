<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan</title>
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="fixed inset-0 -z-10">
        <div
            class="absolute top-10 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob">
        </div>
        <div
            class="absolute top-10 right-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000">
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center p-6 text-center">

        <h1
            class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 drop-shadow-sm">
            404
        </h1>

        <h2 class="text-3xl font-bold text-gray-900 mt-4">Halaman Tersesat?</h2>

        <p class="text-gray-600 mt-4 max-w-md mx-auto text-lg">
            Waduh, sepertinya halaman yang kamu cari sudah pindah atau tidak pernah ada di sini.
        </p>

        <a href="{{ url('/') }}"
            class="mt-8 px-8 py-3 bg-gray-900 text-white rounded-full font-bold shadow-lg hover:bg-indigo-600 hover:shadow-indigo-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Home
        </a>
    </div>
</body>

</html>
