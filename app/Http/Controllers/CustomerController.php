<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return view('dashboard', compact('product'));
    }

    public function tampil()
    {
        $customers = User::where('role', 'customer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }
}
