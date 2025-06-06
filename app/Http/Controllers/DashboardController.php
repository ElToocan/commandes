<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PHPUnit\Framework\ExecutionOrderDependency;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'dashboard/index',
            'title' => 'En cours',
            'orders' => Order::all(),
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

    public function finish()
    {
        $data = [
            'page' => 'dashboard/finish',
            'title' => 'Commande terminier',
            'orders' => Order::all(),
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
