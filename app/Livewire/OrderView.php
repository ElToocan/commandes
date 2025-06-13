<?php

namespace App\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderView extends Component
{
    public $orderStateExpected = 'en_attente';

    public bool $paid;

    public function orderStateExpectedWaiting()
    {
        $this->orderStateExpected = 'en_attente';
    }
    public function orderStateExpectedFinish()
    {
        $this->orderStateExpected = 'terminer';
    }


    public function togglePayment($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->paid = !$order->paid;
            $order->save();
            // Recharger les commandes pour refléter le changement
            $this->orders = Order::where('state', 'terminer')->get();
        }
    }

    //AI

    public function render()
    {
        $now = Carbon::now();
        $fourHoursAgo = $now->copy()->subHours(4);
        $today = Carbon::today();

        $orders = Order::select('*')
            ->selectRaw("
            CASE
                WHEN type = 'emporter' THEN DATE_SUB(delivery_time, INTERVAL 15 MINUTE)
                ELSE created_at
            END AS sort_time
        ")
            ->whereRaw("
            DATE(
                CASE
                    WHEN type = 'emporter' THEN DATE_SUB(delivery_time, INTERVAL 15 MINUTE)
                    ELSE created_at
                END
            ) = ?
        ", [$today->toDateString()])
            ->whereRaw("
            (
                CASE
                    WHEN type = 'emporter' THEN DATE_SUB(delivery_time, INTERVAL 15 MINUTE)
                    ELSE created_at
                END
            ) >= ?
        ", [$fourHoursAgo->toDateTimeString()])
            ->orderBy('sort_time', 'asc')
            ->get();

        return view('livewire.order-view', [
            'orders' => $orders,
        ]);
    }




}
