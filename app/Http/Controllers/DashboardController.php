<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PHPUnit\Framework\ExecutionOrderDependency;

class DashboardController extends Controller
{

    public function blank()
    {
        $data = [
            'page' =>'blank',
        ];
    }
    public function view()
    {
        $data = [
            'page' => 'dashboard/order-view',
            'title' => 'Commandes',
        ];
        return view('blank', $data);
    }



    public function add()
    {
        $data = [
            'page' => 'dashboard/add',
            'title' => 'Ajouter une commande',
        ];
        return view('blank', $data);
    }


    public function update($id)
    {
        $data = [
            'page' => 'dashboard/update',
            'title' => 'Modifier la commande n°'.Order::find($id)->id,
            'order' => Order::find($id),
        ];

        return view('blank', $data);
    }

}
