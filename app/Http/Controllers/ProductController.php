<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function search(Request $request)
    {
        $query = $request->input('query');
       
        /* $products = Product::where('name', 'like', "%{$query}%")->get(); */
         $products = Product::whereRaw("name LIKE '%$query%'")->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $request->user()->products()->create($validated);

        return redirect()->route('dashboard')->with('status', 'Produk ditambahkan!');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($validated);

        return redirect()->route('dashboard')->with('status', 'Produk diperbarui!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('update', $product);
        $product->delete();
        return redirect()->route('dashboard')->with('status', 'Produk berhasil dihapus.');
    }

    public function checkout(Request $request, Product $product)
    {
        if ($product->stock < 1) {
            return back()->with('error', 'Stok habis!');
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'date' => now(),
            'status' => 'paid'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $product->decrement('stock');

        return redirect()->route('dashboard')->with('status', 'Pembelian berhasil!');
    }

    public function history()
    {

        $orders = Order::where('user_id', auth()->id())
                    ->with('orderItems.product')
                    ->orderBy('date', 'desc')
                    ->get();

        return view('history.index', compact('orders'));
    }
}
