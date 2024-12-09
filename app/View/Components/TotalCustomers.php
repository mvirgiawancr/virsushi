<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class TotalCustomers extends Component
{
    public $totalCustomers;

    public function __construct()
    {
        // Get total number of customers
        $this->totalCustomers = User::where('role', 'customer')->count();
    }

    public function render()
    {
        return view('components.total-customers', [
            'totalCustomers' => $this->totalCustomers,
        ]);
    }
}