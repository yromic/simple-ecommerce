<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Katalog Produk') }}
            </h2>

            <form action="{{ route('search') }}" method="GET" class="w-full md:w-auto flex gap-2">
                <div class="relative w-full md:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="query" placeholder="Cari nama barang..."
                        value="{{ request('query') }}"
                        class="pl-10 block w-full rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <button type="submit"
                    class="bg-gray-900 text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-gray-800 transition shadow-lg">
                    Cari
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (request('query'))
                <div class="mb-8 flex items-center gap-2">
                    <a href="{{ route('search') }}" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <p class="text-gray-600 text-lg">Hasil pencarian: <span
                            class="font-bold text-indigo-600">"{{ request('query') }}"</span></p>
                </div>
            @endif

            @if ($products->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-gray-50 p-6 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mt-2 max-w-sm">Maaf, kami tidak dapat menemukan barang yang Anda cari. Coba
                        kata kunci lain.</p>
                    <a href="{{ route('search') }}"
                        class="mt-6 px-6 py-2 bg-indigo-50 text-indigo-700 font-bold rounded-full hover:bg-indigo-100 transition">
                        Reset Pencarian
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col relative overflow-hidden hover:-translate-y-1">

                            <div
                                class="h-32 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center relative">
                                <div class="absolute inset-0 opacity-10"
                                    style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 10px 10px;">
                                </div>

                                <span class="text-4xl font-black text-white opacity-90 tracking-widest uppercase">
                                    {{ substr($product->name, 0, 2) }}
                                </span>

                                <div class="absolute top-3 right-3">
                                    @if ($product->stock > 0)
                                        <span
                                            class="bg-white/90 backdrop-blur text-green-700 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                            Ready
                                        </span>
                                    @else
                                        <span
                                            class="bg-white/90 backdrop-blur text-red-600 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-5 flex flex-col flex-grow">
                                <h3
                                    class="font-bold text-lg text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-500 text-sm mb-4 line-clamp-2 leading-relaxed h-10">
                                    {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                                </p>

                                <div class="mt-auto border-t border-gray-50 pt-4">
                                    <div class="flex items-end justify-between mb-4">
                                        <div>
                                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Harga
                                            </p>
                                            <p class="text-lg font-black text-gray-900">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Sisa
                                            </p>
                                            <p class="text-sm font-bold text-gray-700">{{ $product->stock }} Item</p>
                                        </div>
                                    </div>

                                    @auth
                                        <form action="{{ route('checkout', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-full py-3 rounded-xl font-bold text-sm shadow-md transition-all transform active:scale-95 flex items-center justify-center gap-2
                                                {{ $product->stock > 0
                                                    ? 'bg-gray-900 text-white hover:bg-indigo-600 hover:shadow-indigo-200'
                                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed shadow-none' }}"
                                                {{ $product->stock < 1 ? 'disabled' : '' }}>

                                                @if ($product->stock > 0)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z">
                                                        </path>
                                                    </svg>
                                                    Beli Sekarang
                                                @else
                                                    Stok Habis
                                                @endif
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="block w-full text-center py-3 rounded-xl font-bold text-sm border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white transition-colors">
                                            Login
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
