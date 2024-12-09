<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        $cart = session('cart', []);

        // Cek jika produk sudah ada dalam keranjang, tambahkan jumlahnya
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => base64_encode($product->image),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('dashboard');
    }

    public function updateCart($id, Request $request)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return redirect()->route('dashboard');
    }

    public function removeFromCart($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('dashboard');
    }
}