<?php

namespace App\Livewire;

use App\Models\Order;
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

    public function render()
    {
        return view('livewire.order-view', [
            'orders' => Order::orderByRaw("
                CASE
                    WHEN type = 'surPlace' THEN created_at
                    WHEN type = 'emporter' THEN delivery_time
                END DESC
                ")->get(),
        ]);
    }

}
