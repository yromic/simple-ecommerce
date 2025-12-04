<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('dashboard') }}"
                        class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                        Update Produk
                    </button>
                </div>
            </form>

            <div class="mt-8 border-t pt-4">
                <h3 class="text-sm font-bold text-red-600 mb-2">Danger Zone</h3>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                    onsubmit="return confirm('Hapus produk ini permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded w-full">
                        Hapus Produk Ini
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
