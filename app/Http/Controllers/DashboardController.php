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
            'title' => 'Ajouter une commande'
        ];
        return view('blank', $data);
    }


}
