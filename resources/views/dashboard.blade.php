<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                    <p class="text-green-700 font-medium">{{ session('status') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            @endif


            <div class="flex items-center justify-between">
                <div>
                </div>
                <a href="{{ route('search') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Buka Katalog Pencarian </a>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Status Akun</h3>
                        @if (Auth::user()->is_seller)
                            <div class="flex items-center gap-3 mb-4">
                                <span class="bg-green-100 text-green-700 p-2 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                                <div>
                                    <p class="font-bold text-gray-900">Seller Terverifikasi</p>
                                    <p class="text-xs text-gray-500">Anda dapat menjual produk.</p>
                                </div>
                            </div>
                            <a href="{{ route('products.create') }}"
                                class="block w-full text-center bg-indigo-600 text-white font-bold py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                                + Tambah Produk Baru
                            </a>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-600 mb-4">Anda belum terdaftar sebagai penjual.</p>
                                <form action="{{ route('become.seller') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-indigo-700 transition w-full">
                                        Aktifkan Fitur Seller
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-full">
                        <h3 class="font-bold text-gray-900 mb-6">Manajemen Produk Anda</h3>

                        @if (Auth::user()->is_seller)
                            @if (Auth::user()->products->isEmpty())
                                <div
                                    class="text-center py-10 bg-gray-50 rounded-lg border-dashed border-2 border-gray-200">
                                    <p class="text-gray-400">Belum ada produk yang dijual.</p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr
                                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                                                <th class="px-4 py-3">Nama Produk</th>
                                                <th class="px-4 py-3">Harga</th>
                                                <th class="px-4 py-3">Stok</th>
                                                <th class="px-4 py-3 text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-100">
                                            @foreach (Auth::user()->products as $product)
                                                <tr class="text-gray-700 hover:bg-gray-50 transition">
                                                    <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                                                    <td class="px-4 py-3">Rp {{ number_format($product->price) }}</td>
                                                    <td class="px-4 py-3">
                                                        <span
                                                            class="px-2 py-1 text-xs font-semibold leading-tight {{ $product->stock > 0 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                                            {{ $product->stock }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-right">
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @else
                            <p class="text-gray-500 italic">Aktifkan status seller untuk melihat panel ini.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
