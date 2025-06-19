<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderView extends Component
{

    public Order $order;

    public bool $paid;


    public function toggleOrderLine($orderLineId)
    {
        $orderLine = OrderLine::find($orderLineId);
        $orderLine->toggle();
    }


    public function togglePayment()
    {
            $this->order->paid = !$this->order->paid;
            $this->order->save();
    }

    public function render()
    {
        return view('livewire.order-view');
    }




}
