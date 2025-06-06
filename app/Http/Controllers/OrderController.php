<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController
{
    public function destroy($id)
    {
        Order::destroy($id);
        $data = [
            'page' => 'dashboard/index',
            'title' => 'En cours',
            'orders' => Order::all(),
        ];
        return view('blank', $data);
    }

    public function validateOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->state = 'terminer';
        $order->save();

        return redirect()->back()->with('success', 'Commande validée avec succès.');
    }

    public function update($id)
    {

    }


}
