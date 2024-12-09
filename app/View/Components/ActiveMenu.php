<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class ActiveMenu extends Component
{
    public $totalProducts;

    public function __construct()
    {
        // Get total number of active products
        $this->totalProducts = Product::count();

    }

    public function render()
    {
        return view('components.active-menu', [
            'totalProducts' => $this->totalProducts,
        ]);
    }
}