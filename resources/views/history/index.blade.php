<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($orders->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 text-center border border-gray-100">
                    <div class="bg-gray-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Belum ada pesanan</h3>
                    <p class="text-gray-500 mt-1">Kamu belum pernah belanja apapun.</p>
                    <a href="{{ route('search') }}"
                        class="mt-4 inline-block text-indigo-600 font-semibold hover:underline">Mulai Belanja</a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div
                                class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Nomor Order</p>
                                    <p class="text-gray-900 font-mono font-bold">
                                        #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Tanggal Pembelian
                                    </p>
                                    <p class="text-gray-900">
                                        {{ \Carbon\Carbon::parse($order->date)->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $order->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <ul class="divide-y divide-gray-100">
                                    @php $totalPrice = 0; @endphp
                                    @foreach ($order->orderItems as $item)
                                        @php
                                            // Hitung total harga per item (karena di DB tidak disimpan)
                                            $subtotal = $item->product->price * $item->quantity;
                                            $totalPrice += $subtotal;
                                        @endphp
                                        <li class="py-4 flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-lg">
                                                    {{ substr($item->product->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-800">{{ $item->product->name }}</h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $item->quantity }} x Rp
                                                        {{ number_format($item->product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="font-bold text-gray-900">
                                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end items-center gap-4">
                                    <span class="text-sm text-gray-500 font-medium">TOTAL PEMBAYARAN</span>
                                    <span class="text-xl font-black text-indigo-700">Rp
                                        {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
