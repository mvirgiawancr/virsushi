<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return view('landingpage', compact('product'));
    }
}
