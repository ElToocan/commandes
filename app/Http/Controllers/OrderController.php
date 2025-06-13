<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController
{
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect('/view')->with('success', 'Commande supprimée avec succès');
    }

    public function validateOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->state = 'terminer';
        $order->save();

        return redirect()->back()->with('success', 'Commande validée avec succès.');
    }



}
