<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Transactions;
use Carbon\Carbon;

class TodayOrders extends Component
{
    public $todayOrders;
    public $totalAmount;
    public $pendingOrders;
    public $completedOrders;

    public function __construct()
    {
        // Get today's start and end timestamps
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        // Query for today's orders
        $this->todayOrders = Transactions::whereBetween('created_at', [$today, $tomorrow])->count();

        // Get total amount for today
        $this->totalAmount = Transactions::whereBetween('created_at', [$today, $tomorrow])
            ->sum('total_amount') ?? 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.today-orders', [
            'todayOrders' => $this->todayOrders,
            'totalAmount' => $this->totalAmount,
        ]);
    }
}