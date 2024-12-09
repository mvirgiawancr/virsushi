<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use DB;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        try {
            // Ubah format penyimpanan data produk
            $productIds = [];
            foreach ($cart as $id => $item) {
                $productIds[] = [
                    'id' => (int) $id,
                    'quantity' => (int) $item['quantity']  // Simpan quantity
                ];
            }

            $subtotal = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            $tax = $subtotal * 0.1;
            $total_amount = $subtotal + $tax;

            // Debug untuk melihat data yang akan disimpan
            // \Log::info('Product IDs:', $productIds);

            $transaction = Transactions::create([
                'user_id' => auth()->id(),
                'product_id' => json_encode($productIds),  // Simpan array dengan ID dan quantity
                'total_amount' => $total_amount,
                'status' => 'pending',
            ]);

            session()->forget('cart');

            return redirect()->route('dashboard')
                ->with('success', 'Order berhasil! Order ID: ' . $transaction->id);

        } catch (\Exception $e) {
            \Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }

    public function history()
    {
        $transactions = Transactions::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('transactions'));
    }

}
