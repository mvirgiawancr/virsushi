<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Transactions::with(['user'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Transactions $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $transaction->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}