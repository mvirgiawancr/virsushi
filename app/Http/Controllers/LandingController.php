<?php

namespace App\Http\Controllers;

use App\Models\Product;
class LandingController extends Controller
{


    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }
        return view('landing', [
            'product' => Product::all()
        ]);
    }
}
